$(document).ready(function(){
    $('#submit').click(login);
});

function login() {
    const credentials = {}
    credentials.username = $('#username').val();
    credentials.password = $('#password').val();
    
    $.post('api/login_post.php', credentials, handleResponse);
}

function handleResponse(data, status) {
    console.log(data);
    if(status === 'success' && data.success === 'true') {
        window.location.replace('index.html');
    }
    else {
        $('.error').show();
    }
}