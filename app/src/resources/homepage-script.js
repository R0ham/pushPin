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
    setTemplateWidth(poster.find('.template')); // purely for the demo
}

function hideDetails() {
    $('.poster-details').hide();
}
