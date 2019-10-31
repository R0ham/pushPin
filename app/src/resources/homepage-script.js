$(document).ready(function() {
    $('.poster').hover(showOverlay, hideOverlay);
    $('.overlay').click(showDetails);
    $('.close').click(hideDetails);
});

function showOverlay(e) {
    const overlay = $(e.target).find('.overlay');
    overlay.css('opacity', '100%');
    overlay.css('visibility', 'visible');
}

function hideOverlay(e) {
    const overlay = $(e.target);
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

// this won't be needed when we use actual images
function setTemplateWidth(template) {
    const height = template.height();
    const width = parseInt((8.5/11) * height);
    template.width(width);
    template.css('min-width', width + 'px');
}