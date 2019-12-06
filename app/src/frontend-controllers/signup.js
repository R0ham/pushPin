$(document).ready(function(){
    $('#submit').click(signup);
});

function signup() {
    $('.error').hide();

    const credentials = {}
    credentials.email = $('#email').val();
    credentials.password = $('#password').val();
    credentials.confirm = $('#confirm-password').val();

    if(credentials.password !== credentials.confirm) {
        $('#match-error').show();
        return;
    }
    if(credentials.password.length < 8) {
        $('#length-error').show();
        return;
    }
    if(credentials.email.indexOf('rpi.edu') === -1) {
        $('#email-error').show();
        return;
    }

    $.post('api/createuser.php', credentials, handleResponse).fail(() => { $('#exists-error').show(); });
}

function handleResponse(data, status) {
    if(status === 'success' && data.success) {
        window.location.replace('index.html');
    }
    else {
        console.log('error');
    }
}