var container = document.getElementById('top-picks-scrubbar');
var scrollIncrement;
var scrollPosition = 0;

// Determine Button visibility onLoad
jQuery(document).ready(function() {
    determineButtonVisibility();
});

// Determine how far to scroll based on window width
function getScrollIncrement() {
    if (window.innerWidth >= 1400) {
        scrollIncrement = 400;
    } else {
        scrollIncrement = 270;
    }
}

// If scrolling is necessary, show automatic scroll buttons
function determineButtonVisibility() {
    if (container.scrollWidth === container.offsetWidth || usingMobile()) {
        document.getElementById('top-picks-leftscroll').style.display = 'none';
        document.getElementById('top-picks-rightscroll').style.display = 'none';
    } else {
        document.getElementById('top-picks-leftscroll').style.display = 'initial';
        document.getElementById('top-picks-rightscroll').style.display = 'initial';
    }
}

// Listen for window resize
window.addEventListener('resize', function(event) {
    determineButtonVisibility();
}, true);

// Left scroll button
function leftScroll() {
    getScrollIncrement();
    container.scrollTo({
        top: 0,
        left: (scrollPosition > 0
            ? scrollPosition -= scrollIncrement
            : 0),
        behavior: 'smooth'
    });
}

// Right scroll button
function rightScroll() {
    getScrollIncrement();
    container.scrollTo({
        top: 0,
        left: (scrollPosition < (container.scrollWidth - container.offsetWidth)
            ? scrollPosition += scrollIncrement
            : container.scrollWidth - container.offsetWidth),
        behavior: 'smooth'
    });
}