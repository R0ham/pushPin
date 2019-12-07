function logout() {
    $.ajax({
        url: '/api/logout.php',
        type: 'DELETE',
        success: function(result) {
            window.location.replace('index.html');
        }
    });
}