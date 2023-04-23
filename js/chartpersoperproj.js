// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';


var xmlhttp = new XMLHttpRequest();
var nom;
var nombre;
var data;
var a;
var b;
var url = "api/persoperproj.php";
xmlhttp.open('GET', url, true);
xmlhttp.send(null);
xmlhttp.onreadystatechange = function (){
    data = JSON.parse(this.responseText);
    nom = data.map(function(elem){return elem.NOM;})
    nombre = data.map(function(elem){return elem.NOMBRE;})
    var ctx = document.getElementById("myBarChart");

    var myPieChart = new Chart(ctx, {
      type: 'pie',
      data: {
        labels: nom,
        datasets: [{
          data: nombre,
          backgroundColor: ['#007bff', '#dc3545', '#ffc107', '#28a745'],
        }],
      },
    });
}


// Bar Chart Example

