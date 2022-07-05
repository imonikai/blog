'use strict';

window.addEventListener('load', () => {
    const url = new URL(window.location.href);
    const id = url.searchParams.get('id');
    const target = '../api/get_article_data.php?id=' + id + '&requireHTML=1';

    if( id != null )
    {
        document.querySelector('.blog-title').innerHTML = '記事更新'
        fetch(target)
        .then(response => {
            console.log(response);
            return response.json();
        }).then(data => {
            data = JSON.stringify(data);
            data = JSON.parse(data);
            console.log(data);
            if(data.result == 'NG')
            {
                throw new Error('Not exists article id');
            }
            document.querySelector('#title-form').value = data[1].title;
            document.querySelector('#description-form').value = data[1].description;
            editor.setValue(data[1].content);
        }).catch(err => {
            console.log(err);
            document.querySelector('.blog-title').innerHTML = 'エラー';
            document.querySelector('#submit-button').style.display = 'none';
        })
    }
    else
    {
        document.querySelector('.blog-title').innerHTML = '新規作成';
    }
}, false);
