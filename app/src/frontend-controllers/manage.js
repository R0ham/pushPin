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
                        <div class="poster" id="poster-${poster.poster_id}">
                            <img src="resources/posters/${poster.image_file}" class='image'></img>
                            <h2 class="info poster-title">${poster.title}</h2>
                            <h2 class="info poster-date">${poster.event_date}</h2>
                            <h3 class="info poster-takedown">Takedown: ${poster.takedown_date}</h3>
                            <p class="info poster-description">${poster.description}</p>
                            <button class="edit-poster" onclick="editPoster(this)">edit</button>
                            <button class="delete-poster" onclick="deletePoster(this)">delete</button>
                        </div>
                    </div>`);
    
    container.append(post);
}

function editPoster(e) {

}

function deletePoster(e) {
    if(confirm('Are you sure you want to delete this poster')) {
        const id = e.parentElement.id.substring(7);
        $.ajax({
            url: '/api/delete_poster.php',
            type: 'DELETE',
            data: {'id': id},
            success: function() {
                $(e.parentElement.parentElement).remove();
            }
        });
    }  
}