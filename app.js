
var btn = document.querySelector('#btnAddImage');

btn.addEventListener('click', getDiv); 

function getDiv() {
    var addDiv = document.createElement('form');
    addDiv.setAttribute('method','post');
    addDiv.setAttribute('action','index.php');
    addDiv.setAttribute('id','addImage');
    addDiv.innerHTML='<input type="hidden" name="size" value="1000000"><div class="input-group mb-3" id="inputForm"><input type="file" name="image" class="custom-file-input"><input type="text" id="text" name="image_text" placeholder="Attach the image..." class="custom-file-label"><div class="input-group-append"><button type="submit" name="upload" class="input-group-text">Upload</button></div></div>';
    document.getElementById("import").appendChild(addDiv);
};

var removeImage = document.querySelector('#removeImage');

removeImage.addEventListener('click', rImage);

function rImage() {
    
    var rem = document.getElementByClass('show').style.display='none';
    return rem;
}

rImage();