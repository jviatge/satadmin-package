<?php

namespace Jviatge\Satadmin;

// use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Symfony\Component\Finder\Finder;

class Ressources
{

    /**
     *
     * @param  string  $directory
     * @return array
     */
    public static function resourcesIn()
    {
        $directory = app_path('Satadmin');
        $namespace = app()->getNamespace();
        $resources = [];

        foreach ((new Finder)->in($directory)->files() as $resource) {
            $resource = $namespace.str_replace(
                        ['/', '.php'],
                        ['\\', ''],
                        Str::after($resource->getPathname(), app_path().DIRECTORY_SEPARATOR));      
                
            array_push($resources, $resource);
        }

        $collection = collect($resources)->sort()->all();

        return $collection;
    }

} 