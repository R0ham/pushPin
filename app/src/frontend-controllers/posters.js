let container;
$(document).ready(function() {
    container = $('#posters');
    loadPosters();
});

function loadPosters() {
    $.get('../api/posters_get.php', (posters) => {
        for(let i = 0; i < posters.length; i++)
            generatePoster(posters[i]);

        // add event listeners
        $('.poster').hover(showOverlay, hideOverlay);
        $('.overlay').click(showDetails);
        $('.close').click(hideDetails);
    });
}

function generatePoster(poster) {
    const post = $(`<div class="poster">
                        <img class="poster-image" src="resources/posters/${poster.image_file}"/>
                        <div class="overlay"></div>
                        <div class="poster-details">
                            <i class="close fas fa-times"></i>
                            <img class="poster-full" src="resources/posters/${poster.image_file}"/>
                            <div>
                                <h2 class="poster-title">${poster.title}</h2>
                                <h3 class="poster-date">${poster.event_date}</h3>
                                <p class="poster-description">${poster.description}</p>
                            </div>
                        </div>
                    </div>`);
    
    container.append(post);
}
