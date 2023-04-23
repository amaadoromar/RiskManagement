// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';


var xmlhttp = new XMLHttpRequest();
var nom;
var nombre;
var data;
var a;
var b;
var url = "api/tachecritique.php";
xmlhttp.open('GET', url, true);
xmlhttp.send(null);
xmlhttp.onreadystatechange = function (){
    data = JSON.parse(this.responseText);
    nom = data.map(function(elem){return elem.NOM;})
    nombre = data.map(function(elem){return elem.NOMBRE;})
    var ctx = document.getElementById("myTacheChart");

var myLineChart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: nom,
    datasets: [{
      label: "Taches critiques",
      backgroundColor: "#fd7e14",
      borderColor: "#fd7e14",
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

var xmlhttp2 = new XMLHttpRequest();
var nom;
var nombre;
var data;
var a;
var b;
var url = "api/tachecritique.php?idtype=1";
xmlhttp2.open('GET', url, true);
xmlhttp2.send(null);
xmlhttp2.onreadystatechange = function (){
    data = JSON.parse(this.responseText);
    nom = data.map(function(elem){return elem.NOM;})
    nombre = data.map(function(elem){return elem.NOMBRE;})
    var ctx = document.getElementById("myTacheChartTechnique");

var myLineChart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: nom,
    datasets: [{
      label: "Taches techniques critiques",
      backgroundColor: "#fd7e14",
      borderColor: "#fd7e14",
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

var xmlhttp3 = new XMLHttpRequest();
var nom;
var nombre;
var data;
var a;
var b;
var url = "api/tachecritique.php?idtype=2";
xmlhttp3.open('GET', url, true);
xmlhttp3.send(null);
xmlhttp3.onreadystatechange = function (){
    data = JSON.parse(this.responseText);
    nom = data.map(function(elem){return elem.NOM;})
    nombre = data.map(function(elem){return elem.NOMBRE;})
    var ctx = document.getElementById("myTacheChartHumaine");

var myLineChart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: nom,
    datasets: [{
      label: "Risques humaines critiques",
      backgroundColor: "#fd7e14",
      borderColor: "#fd7e14",
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

var xmlhttp4 = new XMLHttpRequest();
var nom;
var nombre;
var data;
var a;
var b;
var url = "api/tachecritique.php?idtype=3";
xmlhttp4.open('GET', url, true);
xmlhttp4.send(null);
xmlhttp4.onreadystatechange = function (){
    data = JSON.parse(this.responseText);
    nom = data.map(function(elem){return elem.NOM;})
    nombre = data.map(function(elem){return elem.NOMBRE;})
    var ctx = document.getElementById("myTacheChartJuridique");

var myLineChart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: nom,
    datasets: [{
      label: "Risques humaines critiques",
      backgroundColor: "#fd7e14",
      borderColor: "#fd7e14",
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

var xmlhttp5 = new XMLHttpRequest();
var nom;
var nombre;
var data;
var a;
var b;
var url = "api/tachecritique.php?idtype=4";
xmlhttp5.open('GET', url, true);
xmlhttp5.send(null);
xmlhttp5.onreadystatechange = function (){
    data = JSON.parse(this.responseText);
    nom = data.map(function(elem){return elem.NOM;})
    nombre = data.map(function(elem){return elem.NOMBRE;})
    var ctx = document.getElementById("myTacheChartDelais");

var myLineChart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: nom,
    datasets: [{
      label: "Risques du Delais critiques",
      backgroundColor: "#fd7e14",
      borderColor: "#fd7e14",
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

var xmlhttp5 = new XMLHttpRequest();
var nom;
var nombre;
var data;
var a;
var b;
var url = "api/tachecritique.php?idtype=5";
xmlhttp5.open('GET', url, true);
xmlhttp5.send(null);
xmlhttp5.onreadystatechange = function (){
    data = JSON.parse(this.responseText);
    nom = data.map(function(elem){return elem.NOM;})
    nombre = data.map(function(elem){return elem.NOMBRE;})
    var ctx = document.getElementById("myTacheChartIntrinseque");

var myLineChart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: nom,
    datasets: [{
      label: "Risques intrinsèques critiques",
      backgroundColor: "#fd7e14",
      borderColor: "#fd7e14",
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

