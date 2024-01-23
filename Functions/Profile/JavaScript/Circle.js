var ctx = document.getElementById('circle').getContext('2d');
var circle = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: Object.keys(data),
        datasets: [{
            data: Object.values(data),
            backgroundColor: [
                'rgba(0, 255, 0, 0.8)',
                'rgba(255, 0, 0, 0.8)',
                'rgba(255, 255, 0, 0.8)',
                'rgba(0, 255, 255, 0.8)',
                'rgba(0, 0, 255, 0.8)',
                'rgba(255, 0, 255, 0.8)'
            ],
        }],
    },
    options: {
        cutout: '70%',
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: true,
                position: 'bottom',
            },
            tooltip: {
                enabled: false
            },
            datalabels: {
                font: {
                    size: 15
                },
                formatter: function (value) {
                    return value.toString() + ' %';
                }
            },
        }
    },
    plugins: [
        ChartDataLabels,
    ]
});