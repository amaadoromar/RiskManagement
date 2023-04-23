// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';



var xmlhttp = new XMLHttpRequest();
var nom;
var nombre;
var data;
var a;
var b;
var url = "yourlinkhere/api/persoperproj.php";
xmlhttp.open('GET', url, true);
xmlhttp.send(null);
xmlhttp.onreadystatechange = function (){
    data = JSON.parse(this.responseText);
    nom = data.map(function(elem){return elem.NOM;})
    nombre = data.map(function(elem){return elem.NOMBRE;})
    var ctx = document.getElementById("myBarChart");

var myLineChart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: nom,
    datasets: [{
      label: "Personnels",
      backgroundColor: "rgba(2,117,216,1)",
      borderColor: "rgba(2,117,216,1)",
      data: nombre,
    }],
  },
  options: {
    scales: {
      xAxes: [{
        time: {
          unit: 'Projets'
        },
        gridLines: {
          display: false
        },
        ticks: {
          maxTicksLimit: 6
        }
      }],
      yAxes: [{
        ticks: {
          min: 0,
          max: 10,
          maxTicksLimit: 5
        },
        gridLines: {
          display: true
        }
      }],
    },
    legend: {
      display: false
    }
  }
});
}


// Bar Chart Example

