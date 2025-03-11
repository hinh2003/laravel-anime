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

document.addEventListener("DOMContentLoaded", function () {
    let nameMovieInput = document.querySelector("#name_movie");
    let slugMovieInput = document.querySelector("#slug_movie");

    if (nameMovieInput && slugMovieInput) {
        nameMovieInput.addEventListener("input", function () {
            slugMovieInput.value = convertToSlug(this.value);
        });
    }
});

function convertToSlug(text) {
    return text.toLowerCase()
        .trim()
        .normalize("NFD").replace(/[\u0300-\u036f]/g, "")
        .replace(/đ/g, "d").replace(/Đ/g, "D")
        .replace(/\s+/g, '-')
        .replace(/[^a-z0-9-]/g, '')
        .replace(/-+/g, '-');
}


