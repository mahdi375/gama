<div id="dashAddNewGame" class="container">
    <h3 class="pt-2 pl-md-4 row justify-content-center justify-content-md-start">Add New Game :</h3>

    <form action="" class="mt-md-3" id="dashNewGameForm">

        <div id="newGameTitleDiv" class="form-group pl-md-3">
            <label for="newGameTitle">Title: <span id='newGameTitleError' class=" ml-2 text-danger" ></span></label>
            <input type="text" class="form-control" name="title" id="newGameTitle" placeholder="Example input">
            
        </div>

        <div id="newGameCategoryDiv" class="form-group col-md-6 col-sm-7">
            <label for="newGameCategory">Category: <span id="newGameCategoryError" class=" ml-2 text-danger" ></span></label>
            <select id="newGameCategory" name="category"  class="form-control">
                <option selected  disabled>Category</option>
                <option value="1">Action</option>
                <option value="2">Recor</option>
            </select>
        </div>

        <div id="newGameDescriptionDiv" class="form-group pl-md-3">
            <label for="newGameDescription">Description: <span id="newGameDescriptionError" class=" ml-2 text-danger" ></span></label>
            <textarea class="form-control" name="description" id="newGameDescription" rows="4"></textarea>
            <p class="mt-3">Top image :<span id="newGameTopImageError" class=" ml-4 text-danger"></span></p>
        </div>

        <div id="newGameImageTopDiv" class="form-group ml-md-3 col-md-7 custom-file ">
                <input type="file" class="custom-file-input " name="topImage" id="newGameImageTop" accept="image/*" required>
                <label class="custom-file-label" id="newGameImageTopLabel" for="newGameImageTop">Choose file...</label>
                <p id="newGameImageBottomLable" class="mt-3">Bottom image : <span class=" text-primary "> optional</span><span id="newGameBottomImageError" class=" ml-4 text-danger"></span></p>
        </div>

        <div id="newGameImageBottomDiv" class="form-group ml-md-3 col-md-7 custom-file ">
            <input type="file" class="custom-file-input " name="bottomImage" id="newGameImageBottom" accept="image/*" required>
            <label class="custom-file-label" id="newGameImageBottomLabel" for="newGameImageBottom">Choose file...</label>
        </div>

        <div id="newGameBtnDiv" class="row justify-content-center justify-content-md-start ml-md-3 mt-4 mb-4 mb-lg-0">
            <button type="submit" id="newGameBtnSubmitBtn" class="btn btn-primary" >Add Game</button>
        </div>
    </form>
    <p id="addGameSuccessMessage" class="d-none p-2 mt-3 mb-2 bg-info mb-4 text-white font-weight-bold"></p>
</div>