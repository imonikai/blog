'use strict';

function topPage() 
{
    const target = './api/get_all_article_link_html.php';
    fetch(target)
    .then(response => {
        return response.text();
    }).then(data => {
        document.querySelector('#main-content').style.display = 'none';
        document.querySelector('#main-content').innerHTML = data;

        const links = document.querySelector('#main-content').querySelectorAll('.card-link');
        for(let i = 0; i < links.length; i++)
        {
            links[i].addEventListener('click', (e) => {
                e.preventDefault();
                changeArticle(new URL(links[i].href).hash);
            });
        }

        $('#main-content').fadeIn();
    }).catch(err => {
        console.log(err);
        document.querySelector('.blog-title').innerHTML = 'エラー';
    })
}

function changeArticle( id )
{
    const target = './api/get_article_html.php?id=' + id.substring(1);
    fetch(target)
    .then(response => {
        return response.text();
    }).then(data => {
        window.location.hash = id;
        document.querySelector('#main-content').style.display = 'none';
        document.querySelector('#main-content').innerHTML = data;
        $('#main-content').fadeIn();
    })
}