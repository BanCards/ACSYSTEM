var ctx = document.getElementById('circle').getContext('2d');
var circle = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: Object.keys(data),
        datasets: [{
            data: Object.values(data),
            backgroundColor: [
                'rgba(76, 175, 80, 1)',
                'rgba(52, 152, 219, 1)',
                'rgba(231, 76, 60, 1)',
                'rgba(243, 156, 18, 1)',
                'rgba(155, 89, 182, 1)',
                'rgba(206, 4, 113, 1)'
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
        }
    }
});