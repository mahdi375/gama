
var btn= document.querySelector('#rigsterSubmitBtn');

btn.addEventListener('click',(e)=>{
    e.preventDefault();
    btnAnimation();
    btn.disabled = true;
    
    var xhr = new XMLHttpRequest();

    xhr.addEventListener('readystatechange',()=>{
        if(xhr.readyState===4 && xhr.status===200){
            feedback(JSON.parse(xhr.responseText));
            //console.log(xhr.responseText);
        }
    });
    xhr.open('POST', 'http://localhost/gama/authors/store');
    xhr.send(getFormData());
});

function feedback(response){
    if(response.status === 'success'){
        //show success message and redirect
        document.querySelector('#registerNameErr').innerHTML = '' ;
        document.querySelector('#registerEmailErr').innerHTML = '' ;
        document.querySelector('#registerPasswordErr').innerHTML = '' ;
        document.querySelector('#registerImageErr').innerHTML = '' ;
        document.querySelector('#registerConfirmPasswordErr').innerHTML = '' ;
            setTimeout(()=>{btn.innerHTML="Done" } , 300);
            setTimeout(()=>{btn.classList=" btn btn-success " } , 300);
        var messBox =document.querySelector('#regFeedbackMessage');
        messBox.innerHTML=response.name+' Successfuly Registered ';
        messBox.classList='bg-success mt-2 text-white form-control ';
        //redirect to dashboard
        var url='http://localhost/gama/authors/dashboard/'+response.name;
        setTimeout(()=>{location.replace(url);} , 600);

    }else if(response.status === 'failure'){
        //show errors
            setTimeout(()=>{btn.innerHTML="Join" } , 300);
            setTimeout(()=>{btn.disabled= false } , 300);
        document.querySelector('#registerNameErr').innerHTML = response.name_err ;
        document.querySelector('#registerEmailErr').innerHTML = response.email_err ;
        document.querySelector('#registerPasswordErr').innerHTML = response.password_err ;
        document.querySelector('#registerImageErr').innerHTML = response.image_err;
        document.querySelector('#registerConfirmPasswordErr').innerHTML = response.confirm_password_err ;
    }
    
}
function getFormData(){
    var form = document.querySelector('#registerForm');
    var formdata = new FormData(form);
    return formdata;
}
function btnAnimation(){
    setTimeout(()=>{btn.innerHTML=" .. " } , 100);
    setTimeout(()=>{btn.innerHTML=" .... " } , 150);
    setTimeout(()=>{btn.innerHTML=" ......" } , 200);  
    setTimeout(()=>{btn.innerHTML=" ........" } , 250);  
    setTimeout(()=>{btn.innerHTML=" .........." } , 300);  // take some times
}
// show selected image name in file input 
var imgInput = document.querySelector('#registerImage');
var imgLable = document.querySelector('#registerImageLabel');
imgInput.addEventListener('change',()=>{
    imgLable.innerHTML = imgInput.files[0].name;
});