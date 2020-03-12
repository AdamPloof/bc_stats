// Send async request to retrieve bc_charts

var container = document.getElementById("report_container");

let reports_link = document.getElementById("reports-link");
var report_url = reports_link.href;

reports_link.addEventListener("click", function(e) {
    console.log("button clicked");
    e.preventDefault();
    loadReports();
})

function loadReports() {
    let request = new XMLHttpRequest();

    request.open('GET', report_url, true);
    request.responseType = "text";

    request.onload = function() {
        let output = request.response;

        if (this.status == 200) {
            removeChildren(container);
            container.textContent = output;
        } else {
            console.log("Could not retrieve chart");
        }
    }

    request.send();
}

// Clears the current contents container
function removeChildren(parent) {
    while (parent.firstChild) {
        parent.firstChild.remove();
    }
}