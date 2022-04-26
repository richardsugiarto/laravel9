<canvas id="mybarChart" width="200" height="200"></canvas>
<script>
$(function () {
    var ctx = document.getElementById("mybarChart").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ["User", "Article"],
            datasets: [{
                label: 'The number of User / The number of Article',
                data: [{{$user_count}}, {{$article_count}}],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)'
                ],
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }]
            }
        }
    });
});
</script>