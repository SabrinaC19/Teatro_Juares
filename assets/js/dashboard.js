$(document).ready(function(){
    
    /*Grafico de pie */
    const ctx = document.getElementById('myPieChart').getContext('2d');

    const myChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Asientos Disponibles', 'Asientos vendidos'],
            datasets: [{
                label: 'Asientos',
                data: [20, 19],
                backgroundColor: [
                    '#2b9f3a',
                    '#e22222', 
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                display: false,
                }
            }
        },
    });
})