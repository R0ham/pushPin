function checkLogin() {
    return new Promise(function(resolve, reject) {
        $.get('/api/user_get.php', (data) => {
            if(data.success === 'true') {
                resolve(data.username);
            }
            else {
                resolve(false);
            }
        });
    });
}

async function redirectIfLoggedIn() {
    if((await checkLogin()) !== false)
        window.location.replace('index.html');
}

async function redirectIfLoggedOut() {
    if((await checkLogin()) === false)
        window.location.replace('index.html');
}