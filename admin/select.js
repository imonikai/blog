'use strict';

window.addEventListener('load', ()=> {
    const deleteBtn = document.querySelectorAll('.delete-btn'); 

    deleteBtn.forEach( button => {
        button.addEventListener('click', (e) => {
        
            e.preventDefault();
        
            const url = new URL(button.href);
        
            fetch(url)
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
                    window.location.href = './index.php';
                } 
            }).catch(err => {
                alert(err);
                console.log(err);
            })
        });
    })
});