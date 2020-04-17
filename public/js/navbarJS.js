
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

//This is php7 trick , but here work too :)
//when author logged in , log in elements are disappeared !
if(document.querySelector('#logInbtn')??false){ 
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

    //Log in form submitBtn
    var submitBtn = document.querySelector('#logInFormSubmitBtn');
    submitBtn.addEventListener('click',(e)=>{
        e.preventDefault();
        submitBtn.disabled = true;
        sendXHRLoginRequest();
        var form = new FormData(document.querySelector('#loginForm'));
        var xhr = new XMLHttpRequest();

    });
 }   
function sendXHRLoginRequest(){
    var form = new FormData(document.querySelector('#loginForm'));
    var xhr = new XMLHttpRequest();
    xhr.addEventListener('readystatechange',()=>{
        if(xhr.readyState===4 && xhr.status === 200 ){
            processLoginResponse(JSON.parse(xhr.responseText));
        }
    });
    xhr.open('POST','http://localhost/gama/authors/login');
    xhr.send(form);
}
function processLoginResponse(response){
    var emailInput = document.querySelector('#log_email');
    var passwordInput = document.querySelector('#log_password');
    if(response.result){
        submitBtn.innerHTML=' Done ';
        submitBtn.classList='btn btn-success mb-2';
        setTimeout(()=>{location.replace('http://localhost/gama/authors/dashboard');} , 700);
    }else{
        submitBtn.disabled = false;
        emailInput.value = '';
        passwordInput.value= '';
        emailInput.placeholder = response.errors.email_err ? response.errors.email_err : 'Email';
        if(!response.errors.email_err){ // email remaind if correct
            emailInput.value = response.email;
        }
        passwordInput.placeholder= response.errors.password_err;
    }
}
