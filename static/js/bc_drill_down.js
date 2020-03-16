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
    dateItems[i].addEventListener('click', fetchGenre);
}

function fetchGenre(e) {
    e.preventDefault();

    // Constructing the URL
    let fetchDate = this.dataset.date;
    let url = new URL("http://localhost:8080/bc_notables/tables/genre_table.php");
    let date_params = new URLSearchParams();

    date_params.append('start_date', fetchDate);
    date_params.append('end_date', fetchDate);
    url.search = date_params.toString();

    // Create the request
    request = new XMLHttpRequest();
    request.responseType = 'text';
    request.open('GET', url.toString(), true);
    
    request.onload = function() {
        let tbl = document.getElementById('genre-table');
        let data = request.response;
        if (this.status == 200) {
            clearTable(tbl);
            tbl.innerHTML = data;
        } else {
            console.log("could not retrieve data");
        }
    }

    request.send();

    function clearTable(tbl) {
        // Clear the table of old data before refreshing with new
        while (tbl.firstChild) {
            tbl.firstChild.remove();
        }
    }
}