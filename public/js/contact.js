var contactSubBtn = document.querySelector('#contactSubmitBtn');
var contactSuccessMessage= document.querySelector('#contactSuccessMessage');
var contactNameError = document.querySelector('#contactNameError');
var contactEmailError = document.querySelector('#contactEmailError');
var contactMessageError = document.querySelector('#contactMessageError');
contactSubBtn.addEventListener('click',(e)=>{
    e.preventDefault();
    var contactForm = new FormData(document.querySelector('#contactForm'));
    var xhr = new XMLHttpRequest();
    xhr.addEventListener('readystatechange',()=>{
        if(xhr.readyState===4 && xhr.status ===200){
            proccessContactFormRequest(xhr.responseText);
        }
    });
    xhr.open('POST','http://localhost/gama/Pages/contact');
    xhr.send(contactForm);
});
function proccessContactFormRequest(responseText){
    var response = JSON.parse(responseText);
    //console.log(response);
    if(response.result){
        contactNameError.innerHTML='';
        contactEmailError.innerHTML='';
        contactMessageError.innerHTML='';
        contactSuccessMessage.classList="alert alert-success";
        contactSuccessMessage.innerHTML='Tanks '+response.message.name+', your message sent.';
        setTimeout(()=>{location='http://localhost/gama/Pages/contact';},700);
    }else{
        contactNameError.innerHTML = response.errors.name_err;
        contactEmailError.innerHTML = response.errors.email_err;
        contactMessageError.innerHTML = response.errors.message_err;
    }
}