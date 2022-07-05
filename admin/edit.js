'use strict';

window.addEventListener('load', ()=> {
    document.querySelector("#submit-button").addEventListener('click', (e) => {

        e.preventDefault();
    
        document.querySelector('#content').value = editor.getValue();
        const url = new URL(window.location.href);
        const id = url.searchParams.get('id');
        let target;
        const form = new FormData()
    
        form.append('title', document.querySelector('#title-form').value);
        form.append('description', document.querySelector('#description-form').value);
        form.append('content', editor.getValue());
        form.append('displayFlag', document.querySelector('#displayflag-checkbox').checked );
    
        if(id == null)
        {
            target = '../api/create_article.php';
        }
        else
        {
            target = '../api/update_article.php?id=' + id;
        }
    
        fetch(target, {
            method: 'POST',
            body: form
        })
        .then(response => {
            return response.json();
        }).then(data => {
            console.log(data)
            if(data.result != 'OK')
            {
                throw new Error('操作が完了できませんでした');
            }
            else
            {
                location.href = './index.php';
            } 
        }).catch(err => {
            alert(err);
            console.log(err);
        })
    });
}, false);