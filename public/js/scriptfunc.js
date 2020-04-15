

// select profile image script
var imgInput = document.querySelector('#registerImage');
var imgLable = document.querySelector('#registerImageLabel');
imgInput.addEventListener('change',()=>{
    imgLable.innerHTML = imgInput.files[0].name;
    console.log(imgInput.files[0])
});