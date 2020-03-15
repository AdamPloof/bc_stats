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

