
function deleteBtnClick(e)
{
    event.preventDefault();
    var confirmDelete = confirm('Are you sure to delete ?');
    //console.log(e.name);
    //console.log(confirmDelete);
    if(confirmDelete){
        var form = new FormData(document.querySelector('#dashGamesDeleteForm'));
        var xhr = new XMLHttpRequest();
        xhr.addEventListener('readystatechange',()=>{
            if(xhr.readyState===4 && xhr.status===200){
                //console.log(xhr.responseText)
                location.reload();
            }
        });
        var url ='http://localhost/gama/games/delete/?gameID='+e.value;
        xhr.open('DELETE',url);
        xhr.send();

    }

}