var subBtn = document.querySelector('#dashboardAccountEditSubmitBtn');
subBtn.addEventListener('click',(e)=>{
    e.preventDefault();
    subBtn.disabled=true;
    setTimeout(()=>{subBtn.classList='btn btn-secondary';},100);
    var editForm = new FormData(document.querySelector('#dashboardAccountEditForm'));
    var xhr = new XMLHttpRequest();
    xhr.addEventListener('readystatechange',()=>{
        if(xhr.readyState===4 && xhr.status===200){
            processEditRequestResponse(xhr.responseText);
        }
    });
    xhr.open('POST','http://localhost/gama/authors/update');
    xhr.send(editForm);
})


function processEditRequestResponse(text)
{
    var response = JSON.parse(text);
    //console.log(text);
    if(response.result===true){
        var url='http://localhost/gama/authors/dashboard/'+response.name;
        setTimeout(()=>{subBtn.classList='btn btn-success';},100);
        setTimeout(()=>{location.replace(url);} , 700);
        console.log('OK');
    }else{
        subBtn.disabled=false;
        setTimeout(()=>{subBtn.classList='btn btn-primary';},500);
        showEditFormErrors(response.errors);
    }
    //console.log(text);
}
//to show errors
function showEditFormErrors(errors){
    document.querySelector('#dashboardAccountEditNothingErr').innerHTML=errors.notAny;
    document.querySelector('#dashboardAccountEditNameErr').innerHTML=errors.name_err;
    document.querySelector('#dashboardAccountEditImageErr').innerHTML=errors.image_err;
    document.querySelector('#dashboardAccountEditOldPasswordErr').innerHTML=errors.oldPassword_err;
    document.querySelector('#dashboardAccountEditConfirmPasswordErr').innerHTML=errors.confirmPassword_err;
    document.querySelector('#dashboardAccountEditNewPasswordErr').innerHTML=errors.newPassword_err;
}

// show selected image name in file input 
var imgInput = document.querySelector('#dashboardAccountEditImage');
var imgLable = document.querySelector('#dashboardAccountEditImageLabel');
imgInput.addEventListener('change',()=>{
    imgLable.innerHTML = imgInput.files[0].name;
});