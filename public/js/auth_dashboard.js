
var gamesBarBtn = document.querySelector('#gamesBarBtn');
var addBarBtn = document.querySelector('#addBarBtn');
var accountBarBtn = document.querySelector('#accountBarBtn');

var contentDiv = document.querySelector('#dashRightDiv');

var barBtns = [gamesBarBtn,addBarBtn,accountBarBtn];

barBtns.forEach((barBtn)=>{
    barBtn.addEventListener('click',(e)=>{
        if(barBtn.classList != "active"){
            btnBarXHRSender(barBtn);
        }
    })
});

//to send xhr of btns bar
function btnBarXHRSender(btn){
    xhr = new XMLHttpRequest();
    xhr.addEventListener('readystatechange',()=>{
        if(xhr.readyState===4 && xhr.status === 200){
            processBtnBarResponse(btn,JSON.parse(xhr.responseText));
        }
    });
    var url ;
    if(btn.id === 'gamesBarBtn'){ url = 'http://localhost/gama/authors/authorGames';}
    if(btn.id === 'addBarBtn'){ url = 'http://localhost/gama/authors/addGame';}
    if(btn.id === 'accountBarBtn'){ url = 'http://localhost/gama/authors/profile';}

    xhr.open('GET',url);
    xhr.send(); 
}
//to process response of btn bar xhr
function processBtnBarResponse(btn,response){
    barBtns.forEach(btn=>{btn.classList=""});
    btn.classList="active";
    contentDiv.innerHTML=response.html;

    var pageScript = document.createElement("script");
    pageScript.innerHTML = response.script ;
    document.head.append(pageScript);
    pageScript.remove();
};