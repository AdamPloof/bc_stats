// Resize the tracks window of drill down table when user clicks and drags the title bar

const tracksResize = document.querySelector("#tracks");
const trackWindow = document.querySelector(".album-col");
const genreWindow = document.querySelector(".genre-col");

tracksResize.addEventListener("mousedown", mouseDown);

function mouseDown(e) {
    e.preventDefault();
    let currentY = e.clientY;
    window.addEventListener("mousemove", mouseMove);
    window.addEventListener("mouseup", mouseUp);

    function mouseMove(e) {
        e.preventDefault();
        const track_rect = trackWindow.getBoundingClientRect();
        const genre_rect = genreWindow.getBoundingClientRect();

        if (trackWindow.offsetHeight >= 25 && trackWindow.offsetHeight <= 462) {
            trackWindow.style.height = track_rect.height + (currentY - e.clientY) + "px";
            genreWindow.style.height = genre_rect.height - (currentY - e.clientY) + "px";
        }

        currentY = e.clientY;
    }
    
    function mouseUp() {
        window.removeEventListener("mousemove", mouseMove);
        window.removeEventListener("mouseup", mouseUp);

        // make sure the user hasn't dragged the window out of bounds
        // if so, move the window back in bounds
        if (trackWindow.offsetHeight <= 27) {
            trackWindow.style.height = "25px";
            genreWindow.style.height = "462px";
        } else if (trackWindow.offsetHeight >= 460) {
            trackWindow.style.height = "462px";
            genreWindow.style.height = "25px";
        }
    }
}

// Send ajax request to genre_table.php to repopulate table when user
// selects a date to drill down into
const dateItems = document.getElementsByClassName("list-group-item list-group-item-action");

for (let i = 0; i < dateItems.length; i++) {
    dateItems[i].addEventListener('click', fetchTableInfo);
}

function fetchTableInfo(e) {
    e.preventDefault();
    date = this.dataset.date
    initTables(date);
}


function initTables(date) {
    // Handles requests to bc_ajax.php and chains together promises to load them concurrently
    const tbl_obj = {
        fetch_date: date,
        genre_q: "genre",
        tracks_q: "tracks",
    }

    loadTable(tbl_obj.fetch_date, tbl_obj.genre_q)
        .then(function(data) {
            let tbl = document.getElementById("genre-body");
            clearTable(tbl);
            tbl.innerHTML = data;
        }).then(function() {
            loadTable(tbl_obj.fetch_date, tbl_obj.tracks_q)
                .then(function(data) {
                    let tbl = document.getElementById("tracks-body");
                    clearTable(tbl);
                    tbl.innerHTML = data;
                })
        }).catch(function(e) {
            console.log(e);
        })

}

function clearTable(tbl) {
    // Clear the table of old data before refreshing with new
    while (tbl.firstChild) {
        tbl.firstChild.remove();
    }
}


function loadTable(fetch_date, tbl_q) {

    // Constructing the URL
    let url = new URL("http://localhost:8080/bc_notables/bc_ajax.php");
    let params = new URLSearchParams();

    params.append('start_date', fetch_date);
    params.append('end_date', fetch_date);
    params.append('tbl', tbl_q);
    url.search = params.toString();

    // Create the request
    request = new XMLHttpRequest();

    return new Promise(function(resolve, reject) {
        // returns the response on success
        request.onload = function() {
            let data = request.response;
            if (this.status == 200) {
                resolve(data);
            } else {
                reject("Could not retrieve data");
            }
        }
    
        request.responseType = 'text';
        request.open('GET', url.toString(), true);
        request.send();
    });
}

// Load the email modal
let modalBtn = document.getElementById("modal-btn");
let addEmailBtn = document.getElementById("add-email");

modalBtn.addEventListener("click", function() {
    $('#email-modal').modal();
})

addEmailBtn.addEventListener("click", addEmailRecipient);

function addEmailRecipient() {
    // Add another input row to email recipipient form
    let emailInputs = document.getElementsByClassName("email-input");
    console.log(emailInputs.length);
    let lastInput = emailInputs[emailInputs.length - 1];
    let rec_num = parseInt(lastInput.dataset.rec_num) + 1;
    let newInput = document.createElement("div");
    newInput.className = "form-group";
    newInput.classList.add("email-input");
    newInput.dataset.rec_num = rec_num;

    let inputText = `<label for="recipient-name" class="col-form-label">Recipient ${rec_num}:</label>
                    <input type="text" class="form-control form-control-sm" id="recipient-name">`;

    newInput.innerHTML = inputText;

    if (emailInputs.length < 10) {
        // Cap the number of addresses at 10 for now
        lastInput.parentNode.insertBefore(newInput, lastInput.nextSibling);
    } 
}