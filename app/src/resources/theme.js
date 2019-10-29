$(document).ready(function(){
    $('#style-modes i').click(toggleTheme);
    initializeTheme();
});

function toggleTheme(e, theme) {
    if(!theme)
        theme = e.target.id;
    if(theme === 'lightmode') {
        document.documentElement.setAttribute('data-theme', 'light');
        $('#lightmode').removeClass('far').addClass('fas');
        $('#darkmode').removeClass('fas').addClass('far');
        window.localStorage.setItem('theme', 'lightmode');
    }
    if(theme === 'darkmode') {
        document.documentElement.setAttribute('data-theme', 'dark');
        $('#lightmode').removeClass('fas').addClass('far');
        $('#darkmode').removeClass('far').addClass('fas');
        window.localStorage.setItem('theme', 'darkmode');
    }
}

function initializeTheme() {
    t = window.localStorage.getItem('theme');
    if(!t)
        t = 'lightmode';
    toggleTheme(undefined, t);
}