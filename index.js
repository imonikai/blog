'use strict'

window.onload = function() {
    topPage();

    document.querySelector('.top-link').addEventListener('click', (e) => {
        e.preventDefault();
        window.location.hash = '';
    })

    window.addEventListener('hashchange', () => {
            if(window.location.hash == '')
            {
                topPage();
            }
            else
            {
                changeArticle(window.location.hash);
            }
        }
    );
};