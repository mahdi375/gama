
//Collaps button
var navbarCollapseBtn = document.querySelector('#navbarCollapseBtn');
var navbarSupportedContent=document.querySelector('#navbarSupportedContent');

navbarCollapseBtn.addEventListener('click',()=>{
    if(navbarSupportedContent.classList[0]==='show'){
        navbarSupportedContent.classList='collapse navbar-collapse';
    }else{
        navbarSupportedContent.classList='show collapse navbar-collapse';
    }
});

//log in button and div
var logInbtn = document.querySelector('#logInbtn');
var logIndiv = document.querySelector('#logindiv');

//log in button
logInbtn.addEventListener('click',(e)=>{
    e.preventDefault();
    if(logIndiv.classList[2]=='d-none'){
        logIndiv.classList="container justify-content-lg-end ";
    }else{
        logIndiv.classList="container justify-content-lg-end d-none ";
    }
});