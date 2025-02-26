function updateChapters() {
    let movieSelect = document.getElementById("movie_id");
    let chapterSelect = document.getElementById("chapter");
    let selectedMovie = movieSelect.options[movieSelect.selectedIndex];

    chapterSelect.innerHTML = '<option value="">Chọn tập</option>';

    if (selectedMovie.value) {
        let maxChapters = parseInt(selectedMovie.getAttribute("data-episodes"));
        let existingChapters = JSON.parse(selectedMovie.getAttribute("data-existing-chapters"));

        for (let i = 1; i <= maxChapters; i++) {
            if (!existingChapters.includes(i)) {
                let option = document.createElement("option");
                option.value = i;
                option.textContent = "Tập " + i;
                chapterSelect.appendChild(option);
            }
        }
    }
}



