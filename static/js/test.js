// Load json data received via ajax into table

var body = document.getElementById("test-body");

var clicker = document.getElementById("clicker");
clicker.addEventListener("click", function(e) {
    e.preventDefault();
    getJsonStats();
})

function getJsonStats() {
    let url = "http://localhost:8080/bc_notables/bc_json.php";
    let request = new XMLHttpRequest();

    request.responseType = "json";
    request.open('GET', url, true);

    request.onload = function() {
        let data = request.response;
        if (this.status == 200) {
            data.forEach(loadTable);
        } else {
            console.log("could not retrieve data");
        }
    }

    request.send();
}

function loadTable(row) {
    let new_row = document.createElement("tr");

    for (const cell in row) {
        if (cell == "link") {
            // if the cell is the link we don't want to create a td for it
            continue
        }

        let node = document.createElement("td");
        let text = document.createTextNode(row[cell]);

        if (cell == "title") {
            // append the link to the title
            let link = document.createElement("a");
            link.href = row["link"];
            link.appendChild(text);
            node.appendChild(link);
        } else {
            node.appendChild(text);
        }

        new_row.appendChild(node);
    }

    body.appendChild(new_row);
}