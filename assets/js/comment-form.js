// Helper constants
const commentForm = document.getElementById('respond');
const replyTitle = document.getElementById('reply-title');
const commentList = document.querySelector('.comment-list');
const commentParentField = commentForm.querySelector('#comment_parent');
const replyButtons = document.querySelectorAll('.comment-reply-link');
const footer = document.querySelector('footer');
const rem = parseFloat(getComputedStyle(document.body).fontSize);

// State variables
let animationBlock = false;
let mobileView = false;

/*************************************************
 * Custom Dom Objects
 *************************************************/

// Cancel button
const cancelButton = document.createElement('button');
cancelButton.setAttribute('rel', 'nofollow');
cancelButton.setAttribute('id', 'cancel-comment-reply-link');
cancelButton.setAttribute('class', 'btn-orange')

// Join Discussion Button
const joinButtonContainer = document.createElement('div');
const joinButton = document.createElement('button');
joinButtonContainer.classList.add('d-grid', 'gap-2');
joinButton.setAttribute('id', 'join-discussion-link');
joinButton.setAttribute('class', 'btn btn-orange btn-lg btn-block');
joinButtonContainer.appendChild(joinButton);
joinButton.textContent = 'Join the Discussion!';

// Developer text
const devText = document.createElement('span');
devText.style = "color: white; position: fixed; top: 0px; right: 0px; " +
    "background-color: rgba(100, 100, 100, 0.8); z-index: 2;"
document.body.appendChild(devText);
devLog = text => { devText.textContent = text; }

/*************************************************
 * On Document Load
 *************************************************/
if (window.innerWidth <= 576) {
    mobileView = true;
    commentForm.style.visibility = 'hidden';
    resetCancelButtonStyles();
    commentList.appendChild(joinButtonContainer);
}

// Initialize Cancel Button Styles
resetCancelButtonStyles();

/*************************************************
 * Functions
 *************************************************/
function resetCancelButtonStyles() {
    if (mobileView) {
        cancelButton.classList.add('mobile-cancel');
        cancelButton.classList.remove('float-end', 'btn');
        cancelButton.textContent = 'X';
    } else {
        cancelButton.classList.add('btn', 'float-end');
        cancelButton.classList.remove('mobile-cancel');
        cancelButton.textContent = 'Cancel';
    }
}

// Show comment form
function showCommentForm(commentId) {

    // If not currently in an animation
    if (!animationBlock) {
        let comment = null;

        // If form is for a reply
        if (commentId !== "0") {
            comment = document.getElementById(`comment-${commentId}`);

            // Update the #reply-title heading with the author name
            const commentTitle = comment.querySelector('.comment-title');
            const authorName = commentTitle.childNodes[0].nodeValue.trim();
            replyTitle.innerHTML = `Leave a reply to <strong>${authorName}</strong>`;

            // Move the comment form element to be a child of the comment being replied to
            comment.parentNode.appendChild(commentForm);
        }

        // Update the comment_parent hidden field to the correct comment id
        commentParentField.value = commentId;

        // Animate if on mobile and adjust cancel button
        if (mobileView) {
            resetCancelButtonStyles();
            if (commentForm.style.visibility === 'hidden') {
                slideUp(commentForm, 1000);
                fadeOut(joinButtonContainer, 1000);
                setTimeout(() => {
                    commentList.removeChild(joinButtonContainer);
                }, 950);
                setTimeout( () => {
                    fadeIn(commentForm.parentNode.insertBefore(cancelButton, commentForm.nextSibling), 250);
                    cancelButton.style.bottom = commentForm.offsetHeight + 'px';
                }, 1000);
                commentList.style.marginBottom = (commentForm.offsetHeight - footer.offsetHeight) + 'px';
            } else {
                commentForm.parentNode.insertBefore(cancelButton, commentForm.nextSibling);
                cancelButton.style.bottom = commentForm.offsetHeight + 'px';
            }
        } else {
            replyTitle.appendChild(cancelButton);
            commentForm.style.visibility = 'visible';
        }
    }
}

// Hide comment form
function hideCommentForm() {

    // If not currently in an animation
    if (!animationBlock) {

        // Hide the form for smaller displays
        if (mobileView) {
            commentForm.parentNode.removeChild(cancelButton);
            slideDown(commentForm, 1000);
            fadeIn(commentList.appendChild(joinButtonContainer), 1000);
            commentList.style.marginBottom = rem + 'px';
        } else {
            replyTitle.removeChild(cancelButton);
        }

        // Reset the comment_parent hidden field
        commentParentField.value = "0";

        // Move the comment form back to the bottom
        commentList.appendChild(commentForm);

        // Reset the reply title
        replyTitle.innerText = 'Join the discussion!';
    }

    return false;
}

// Animations
function slideUp(obj, dur) {
    obj.style.visibility = 'visible';
    animationBlock = true;
    obj.animate(
        [{
            transform: `translateY(${screen.height - obj.offsetHeight}px)`,
            opacity: 0,
            easing: "ease"
        },
            {
                transform: `translateY(0px)`,
                opacity: 1
            }],
        dur
    ).onfinish = function () {
        animationBlock = false;
    };
}

function slideDown(obj, dur) {
    animationBlock = true;
    obj.animate(
        [{
            transform: `translateY(0px)`,
            opacity: 1,
            easing: "ease"
        },
            {
                transform: `translateY(${screen.height - obj.offsetHeight}px)`,
                opacity: 0,
            }],
        dur
    ).onfinish = function () {
        obj.style.visibility = 'hidden';
        animationBlock = false;
    };
}

function fadeIn(obj, dur) {
    animationBlock = true;
    obj.animate({
        opacity: [0,1]
    }, dur).onfinish = () => {
        animationBlock = false;
    };
}

function fadeOut(obj, dur) {
    animationBlock = true;
    obj.animate({
        opacity: [1,0]
    }, dur).onfinish = () => {
        animationBlock = false;
    };
}

/*************************************************
 * Listeners
 *************************************************/

// Loop through each reply button and add an event listener to it
replyButtons.forEach(link => {
    const commentId = link.getAttribute('data-commentid');
    link.addEventListener('click', event => {
        event.preventDefault();
        showCommentForm(commentId);
    });
});

// Reset the comment form when cancelled
cancelButton.addEventListener('click', () => {
    hideCommentForm();
});

// Open default comment form if button is clicked
joinButton.addEventListener('click', () => {
    showCommentForm("0");
});

// Switch to mobile view or desktop view if screen is resized
window.addEventListener('resize', () => {

    // Desktop switching to mobile
    if (window.innerWidth <= 576 && mobileView === false) {
        mobileView = true;
        resetCancelButtonStyles();

        // If currently replying
        if (commentParentField.value !== "0") {
            replyTitle.removeChild(cancelButton);
            showCommentForm(commentParentField.value);
        } else {
            hideCommentForm();
            fadeIn(commentList.appendChild(joinButtonContainer), 1000);
        }
    }

    // Mobile switching to desktop
    else if (window.innerWidth > 576 && mobileView === true) {
        mobileView = false;
        resetCancelButtonStyles();

        // If modal is open
        if (commentForm.style.visibility === 'visible') {
            // If currently replying
            if (commentParentField.value !== "0") {
                commentForm.parentNode.removeChild(cancelButton);
                showCommentForm(commentParentField.value);
            } else {
                showCommentForm("0");
            }
            commentList.style.marginBottom = rem + 'px';
        } else {
            showCommentForm("0");
            fadeOut(joinButtonContainer);
            setTimeout(() => {
                commentList.removeChild(joinButtonContainer);
            }, 950);
        }
    }

    return true;
});