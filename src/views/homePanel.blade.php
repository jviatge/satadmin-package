@extends('satadmin::layout/layout')

@section('content')

<h2 class="text-center">Welcome to the backofice Satadmin</h2>

<div class="line"></div>

<div class="row">
    <div v-for="dataWidget in dataWidgets" class="col-xl-6">
        <graph :array="dataWidget"></graph>
    </div>
</div>


<script>
    function chart(name, col, value, ctx){

        let type   = ['line', 'bar','radar','pie','polarArea','bubble'];

        let option = {
            type: type[1],
            data: {
                labels: col,
                datasets: [{
                    data: value,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
        }

        let myChart = new Chart(ctx, option);
    }
    
    Vue.component('graph',{
        props: ['array'],
        template: `<div class="frame">
            <canvas ref="ctx" height="230vw"></canvas>
        </div>
        `,
        mounted:function(){
            let name = this.array.name

            let col = []             
            for (let i = 0; i < this.array.col.length; i++) {
                col.push(this.array.col[i])
            }

            let value = []             
            for (let i = 0; i < this.array.value.length; i++) {
                value.push(this.array.value[i])
            }
            
            chart(name, col, value, this.$refs.ctx)
        }
    })

    let app = new Vue({
        el:"#app",
        data: {
            dataWidgets: null
        },
        mounted:function(){
            this.WidgetsDatas()
        },
        methods: {
            WidgetsDatas (){
                axios.get('/api/test')
                .then(response => this.dataWidgets = response.data)
                .catch(function (error) { console.log(error); });
            }
        }
    })

</script>
    
@endsection