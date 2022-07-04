const deleteBtn = document.querySelector('.delete-btn'); 

deleteBtn.addEventListener('click', (e) => {

    e.preventDefault();

    const url = new URL(deleteBtn.href);

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