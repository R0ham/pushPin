function showOverlay(e) {
    const overlay = $(e.target.parentElement).find('.overlay');
    overlay.css('opacity', '100%');
    overlay.css('visibility', 'visible');
}

function hideOverlay(e) {
    const overlay = $(e.target.parentElement).find('.overlay');
    if(!overlay.hasClass('overlay'))
        return;
    overlay.css('opacity', '0%');
    overlay.css('visibility', 'hidden');
}

function showDetails(e) {
    const poster = $(e.target).parent();
    poster.find('.overlay').css({'opacity': '0%', 'visibility': 'hidden'});
    poster.find('.poster-details').css('display', 'flex ');

    // resource: https://codepen.io/geoffgraham/pen/LogERe
    const scrollY = document.documentElement.style.getPropertyValue('--scroll-y');
    document.body.style.position = 'fixed';
    document.body.style.top = `-${scrollY}`;
}

function hideDetails() {
    $('.poster-details').hide();

    // resource: https://codepen.io/geoffgraham/pen/LogERe
    const scrollY = document.body.style.top;
    document.body.style.position = '';
    document.body.style.top = '';
    window.scrollTo(0, parseInt(scrollY || '0') * -1);
}

// resource: https://codepen.io/geoffgraham/pen/LogERe
window.addEventListener('scroll', () => {
  document.documentElement.style.setProperty('--scroll-y', `${window.scrollY}px`);
});
