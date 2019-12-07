$.get('/api/user_get.php', (data) => {
    if(data.success === 'true') {
        if($('title').text() === 'Home') {
            $('nav').remove();
            $('header').prepend(`<nav>
                                    <h1 id='logo'><a href="index.html"><img src="resources/pushPin_logo_black.png" alt="pushPin Logo"></a></h1>
                                    <div>
                                        <a href="#" id="logout" class="navlink" onclick="logout()">LOGOUT</a>
                                        <a href="manage.html" class='navlink'>manage</a>
                                        <a href="upload.html" class='navlink'>upload</a>
                                    </div>
                                </nav>`);
            initializeTheme();
        }
    }
    else {
        if($('title').text() !== 'Home') {
            window.location.replace('index.html');
        }
    }
});

