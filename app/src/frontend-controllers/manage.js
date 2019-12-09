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
                            <button class="edit-poster" onclick="editMode(this)">edit</button>
                            <button class="delete-poster" onclick="deletePoster(this)">delete</button>
                        </div>
                    </div>`);
    
    container.append(post);
}

function editMode(e) {
    const poster = $(e.parentElement);
    poster.find('.poster-title').replaceWith(`<input type="text" class="edit-title" placeholder="title" value="${poster.find('.poster-title').text()}"/>`);
    poster.find('.poster-date').replaceWith(`<label><input type="date" class="edit-date" value="${poster.find('.poster-date').text()}"/> event date</label>`);
    poster.find('.poster-takedown').replaceWith(`<label><input type="date" class="edit-takedown" value="${poster.find('.poster-takedown').text().substring(10)}"/> takedown date</label>`);
    poster.find('.poster-description').replaceWith(`<textarea class="edit-description" placeholder="description">${poster.find('.poster-description').text()}</textarea>`);
    poster.find('.edit-poster').replaceWith(`<button class="save-poster" onclick="savePoster(this)">save</button>`);
}

function viewMode(p) {
    const poster = $(p);
    poster.find('.edit-title').replaceWith(`<h2 class="info poster-title">${poster.find('.edit-title').val()}</h2>`);
    poster.find('.edit-date').replaceWith(`<h2 class="info poster-date">${poster.find('.edit-date').val()}</h2>`);
    poster.find('.edit-takedown').replaceWith(`<h3 class="info poster-takedown">Takedown: ${poster.find('.edit-takedown').val()}</h3>`);
    poster.find('.edit-description').replaceWith(`<p class="info poster-description">${ poster.find('.edit-description').val()}</p>`);
    poster.find('.save-poster').replaceWith(`<button class="edit-poster" onclick="editMode(this)">edit</button>`);
}

function savePoster(p) {
    const poster = $(p.parentElement);
    const posterData = {};

    posterData.pid = poster.attr('id').substring(7);
    posterData.title = poster.find('.edit-title').val();
    posterData.description = poster.find('.edit-description').val();
    posterData.eventDate = poster.find('.edit-date').val();
    posterData.takedown = poster.find('.edit-takedown').val();

    $.ajax({
        url: '/api/edit_poster.php',
        type: 'PUT',
        data: posterData,
        success: () => { viewMode(poster); }
    });
}

function deletePoster(e) {
    if(confirm('Are you sure you want to delete this poster')) {
        const id = e.parentElement.id.substring(7);
        $.ajax({
            url: '/api/delete_poster.php',
            type: 'DELETE',
            data: {'pid': id},
            success: function() {
                $(e.parentElement.parentElement).remove();
            }
        });
    }  
}