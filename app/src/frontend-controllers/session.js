$.get('/api/user', (data) => {
    if(data.success === 'true') {
        $('nav').remove();
        $('header').prepend(`<nav>
                                <h1 id='logo'><a href="index.html"><img src="resources/pushPin_logo_black.png" alt="pushPin Logo"></a></h1>
                                <div>
                                    <a href="index.html" id="logout" class="navlink">LOGOUT</a>
                                    <a href="manage.html" class='navlink'>manage</a>
                                    <a href="upload.html" class='navlink'>upload</a>
                                </div>
                            </nav>`);
    }
    initializeTheme();
});

