$(document).ready(function() {
    getData().then(function(data) {
        console.log(data);
    }).catch(function(){
        console.log("we f'd it up");
    })
})

function getData() {
    let url = "http://localhost:8080/bc_notables/bc_ajax.php?start_date=2020-01-01&end_date=2020-12-31&tbl=chart";
    let request = new XMLHttpRequest;

    return new Promise(function(resolve, reject) {
        request.onload = function() {
            let output = request.response;
            if (request.status == 200) {
                resolve(output);
            } else {
                reject("Could not retrieve data");
            }
        }
        request.responseType = 'json';
        request.open('GET', url, true);
        request.send();
    })
}

Chart.defaults.global.maintainAspectRatio = false;

var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: ['Oct', 'Nov', 'Dec', 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'July'],
      datasets: [{ 
          data: [86,114,106,106,107,111,133,221,783,2478],
          label: "Electronic",
          borderColor: "#3e95cd",
          fill: false
        }, { 
          data: [282,350,411,502,635,809,947,1402,3700,5267],
          label: "Country",
          borderColor: "#8e5ea2",
          fill: false
        }, { 
          data: [168,170,178,190,203,276,408,547,675,734],
          label: "Western",
          borderColor: "#3cba9f",
          fill: false
        }, { 
          data: [40,20,10,16,24,38,74,167,508,784],
          label: "Indie",
          borderColor: "#e8c3b9",
          fill: false
        }, { 
          data: [6,3,2,2,7,26,82,172,312,433],
          label: "Jug Band",
          borderColor: "#c45850",
          fill: false
        }
      ]
    },
    options: {
      title: {
        display: true,
        text: 'Popularity by Genre'
      }
    }
});