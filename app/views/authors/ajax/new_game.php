<div id="dashAddNewGame" class="container">
    <h3 class="pt-3 pl-md-4 row justify-content-center justify-content-md-start">Add New Game :</h3>

    <form action="" class="mt-md-5">

        <div id="newGameTitleDiv" class="form-group pl-md-3">
            <label for="newGameTitle">Title: </label>
            <input type="text" class="form-control" id="newGameTitle" placeholder="Example input">
        </div>

        <div id="newGameCategoryDiv" class="form-group col-md-4">
            <label for="newGameCategory">Category: </label>
            <select id="newGameCategory" class="form-control">
                <option selected disabled>Category</option>
                <option>Action</option>
                <option>Recor</option>
            </select>
        </div>

        <div id="newGameDescriptionDiv" class="form-group pl-md-3">
            <label for="newGameDescription">Description: </label>
            <textarea class="form-control" id="newGameDescription" rows="4"></textarea>
            <p class="mt-3">Top image :<span class=" text-primary "> less than 200kb</span><span class=" ml-4 text-danger" id="registerImageErr">errr</span></p>
        </div>

        <div id="newGameImageTopDiv" class="form-group ml-md-3 col-md-7 custom-file ">
                <input type="file" class="custom-file-input " name="image" id="newGameImageTop" accept="image/*" required>
                <label class="custom-file-label" id="newGameImageTopLabel" for="newGameImageTop">Choose file...</label>
                <p id="newGameImageBottomLable" class="mt-3">Bottom image : <span class=" text-primary "> optional</span><span class=" ml-4 text-danger" id="registerImageErr">errr</span></p>
        </div>

        <div id="newGameImageBottomDiv" class="form-group ml-md-3 col-md-7 custom-file ">
            <input type="file" class="custom-file-input " name="image" id="newGameImageBottom" accept="image/*" required>
            <label class="custom-file-label" id="newGameImageBottomLabel" for="newGameImageBottom">Choose file...</label>
        </div>

        <div id="newGameBtnDiv" class="row justify-content-center justify-content-md-start ml-md-3 mt-4">
            <button type="submit" id="newGameBtnSubmitBtn" class="btn btn-primary" >Add Game</button>
        </div>
    </form>

</div>