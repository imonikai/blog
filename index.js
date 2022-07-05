'use strict';

window.addEventListener('load', () => {
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
}, false);