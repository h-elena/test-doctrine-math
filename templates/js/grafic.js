google.charts.load('current', {'packages': ['corechart']});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {
    var s = $('#chart_points').html();
    console.log(JSON.parse($('#chart_points').html()));

    var data = google.visualization.arrayToDataTable(JSON.parse($('#chart_points').html()));

    var options = {
        title: '',
        hAxis: {title: 'X'},
        vAxis: {title: 'Y'},
        legend: 'none'
    };

    var chart = new google.visualization.ScatterChart(document.getElementById('chart_div'));

    chart.draw(data, options);
}