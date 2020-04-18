var newGameBtnSubmitBtn = document.querySelector('#newGameBtnSubmitBtn');

var newGameTitleError = document.querySelector('#newGameTitleError');
var newGameCategoryError = document.querySelector('#newGameCategoryError');
var newGameDescriptionError = document.querySelector('#newGameDescriptionError');
var newGameTopImageError = document.querySelector('#newGameTopImageError');
var newGameBottomImageError = document.querySelector('#newGameBottomImageError');

var addGameSuccessMessage = document.querySelector('#addGameSuccessMessage');


newGameBtnSubmitBtn.addEventListener('click',(e)=>{
    e.preventDefault();
    addBtnAnim();
    var form = new FormData(document.querySelector('#dashNewGameForm'));
    var xhr= new XMLHttpRequest();
    xhr.addEventListener('readystatechange',()=>{
        if(xhr.readyState===4 && xhr.status===200){
            processNewGameResp(JSON.parse(xhr.responseText));
        }
    });
    xhr.open('POST','http://localhost/gama/games/addNewGame');
    xhr.send(form);
});

function processNewGameResp(response){
    if(response.result){
        cleareErrors();
        setTimeout(()=>{
                            newGameBtnSubmitBtn.innerHTML='Done';
                            newGameBtnSubmitBtn.classList='btn btn-success';
                            addGameSuccessMessage.classList='p-2 mt-3 mb-2 bg-info mb-4 mb-lg-0 text-white font-weight-bold'
                        },351);
        addGameSuccessMessage.innerHTML='Your new game was recive, be patient for last validation';
        
        console.log('OK')
    }else{
        newGameBtnSubmitBtn.disabled=false;
        setTimeout(()=>{newGameBtnSubmitBtn.innerHTML='Add Game'},351);
        newGameTitleError.innerHTML = response.errors.title_err; 
        newGameCategoryError.innerHTML = response.errors.category_err; 
        newGameDescriptionError.innerHTML = response.errors.description_err; 
        newGameTopImageError.innerHTML = response.errors.topImage_err; 
        newGameBottomImageError.innerHTML = response.errors.bottomImage_err;
    }
}

//to annimate add button
function addBtnAnim(){
    newGameBtnSubmitBtn.disabled=true;
    newGameBtnSubmitBtn.style.width='101px';
    setTimeout(()=>{newGameBtnSubmitBtn.innerHTML='.'},100);
    setTimeout(()=>{newGameBtnSubmitBtn.innerHTML='. .'},150);
    setTimeout(()=>{newGameBtnSubmitBtn.innerHTML='. .  . .'},200);
    setTimeout(()=>{newGameBtnSubmitBtn.innerHTML='. . . . .'},250);
    setTimeout(()=>{newGameBtnSubmitBtn.innerHTML='. . . . . .'},300);
    setTimeout(()=>{newGameBtnSubmitBtn.innerHTML='. . . . . . .'},350);
}
//to cleare errors
function cleareErrors(){
    newGameTitleError.innerHTML = ''; 
    newGameCategoryError.innerHTML = ''; 
    newGameDescriptionError.innerHTML = ''; 
    newGameTopImageError.innerHTML = ''; 
    newGameBottomImageError.innerHTML = '';

}
// show selected image name in file input 
var topImgInput = document.querySelector('#newGameImageTop');
var topImgLable = document.querySelector('#newGameImageTopLabel');
topImgInput.addEventListener('change',()=>{
    topImgLable.innerHTML = topImgInput.files[0].name;
});
var bottomImgInput = document.querySelector('#newGameImageBottom');
var bottomImgLable = document.querySelector('#newGameImageBottomLabel');
bottomImgInput.addEventListener('change',()=>{
    bottomImgLable.innerHTML = bottomImgInput.files[0].name;
});







