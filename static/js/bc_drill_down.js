// Resize the tracks window of drill down table when user clicks and drags the title bar

const tracksResize = document.querySelector("#tracks");
const trackWindow = document.querySelector(".album-col");
const genreWindow = document.querySelector(".genre-col");

tracksResize.addEventListener("mousedown", mouseDown);

function mouseDown(e) {
    let currentY = e.clientY;
    window.addEventListener("mousemove", mouseMove);
    window.addEventListener("mouseup", mouseUp);

    function mouseMove(e) {
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
    let fetch_date = this.dataset.date;
    let genre_q = "genre";
    let genre_id = "genre-body";
    let tracks_q = "tracks";
    let tracks_id= "tracks-body";

    loadGenres(fetch_date, genre_q, genre_id);
    // loadTracks(fetch_date, tracks_q, tracks_id);
}

function loadGenres(fetch_date, tbl_q, tbl_id) {

    // Constructing the URL
    let url = new URL("http://localhost:8080/bc_notables/bc_ajax.php");
    let params = new URLSearchParams();

    params.append('start_date', fetch_date);
    params.append('end_date', fetch_date);
    params.append('tbl', tbl_q);
    url.search = params.toString();

    // Create the request
    request = new XMLHttpRequest();
    request.responseType = 'text';
    request.open('GET', url.toString(), true);
    
    request.onload = function() {
        let tbl = document.getElementById(tbl_id);
        let data = request.response;
        if (this.status == 200) {
            clearTable(tbl);
            tbl.innerHTML = data;
        } else {
            console.log("could not retrieve data");
        }
    }

    function clearTable(tbl) {
        // Clear the table of old data before refreshing with new
        while (tbl.firstChild) {
            tbl.firstChild.remove();
        }
    }

    request.send();
}

// TODO: Combine the fetch functions into a single fetchTable function
function loadTracks(fetch_date, tbl_q, tbl_id) {

    // Constructing the URL
    let url = new URL("http://localhost:8080/bc_notables/bc_ajax.php");
    let params = new URLSearchParams();

    params.append('start_date', fetch_date);
    params.append('end_date', fetch_date);
    params.append('tbl', tbl_q);
    url.search = params.toString();

    // Create the request
    request = new XMLHttpRequest();
    request.responseType = 'text';
    request.open('GET', url.toString(), true);
    
    request.onload = function() {
        let tbl = document.getElementById(tbl_id);
        let data = request.response;
        if (this.status == 200) {
            clearTable(tbl);
            tbl.innerHTML = data;
        } else {
            console.log("could not retrieve data");
        }
    }

    function clearTable(tbl) {
        // Clear the table of old data before refreshing with new
        while (tbl.firstChild) {
            tbl.firstChild.remove();
        }
    }

    request.send();
}