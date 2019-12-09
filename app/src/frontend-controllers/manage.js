redirectIfLoggedOut();

async function getUsername() {
    let username = await checkLogin();
    if(!username)
        return;
    loadPosters(username);
}

let container;
$(document).ready(function() {
    container = $('#posters-container');
    getUsername();
});

function loadPosters(username) {
    $.get('/api/posters_get.php', {'user': username}, (posters) => {
        for(let i = 0; i < posters.length; i++)
            generatePoster(posters[i]);
    });
}

function generatePoster(poster) {
    const post = $(`<div class="poster-container">
                        <div class="poster">
                            <img src="resources/posters/${poster.image_file}" class='image'></img>
                            <h2 class="poster-title">${poster.title}</h2>
                            <h2 class="poster-date">${poster.event_date}</h2>
                            <p class="poster-description">${poster.description}</p>
                            <button class="edit-poster">edit</button>
                            <button class="delete-poster">delete</button>
                        </div>
                    </div>`);
    
    container.append(post);
}