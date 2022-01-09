function spawnModal(isCreate, id, name, URL, mediaURL){
    document.querySelector("#modalSpawner").click();
    var modal = document.querySelector("#sbModalCardManager");
    if(isCreate){
        modal.querySelector("#modal-action").value = "create";
        modal.querySelector(".modal-title").innerHTML = "Create Card";
        modal.querySelector("#modal-id").value = "";
        modal.querySelector("#modal-name").value = "";
        modal.querySelector("#modal-url").value = "";
        modal.querySelector("#modal-media").value = "";
    }else{
        modal.querySelector("#modal-action").value = "edit";
        modal.querySelector(".modal-title").innerHTML = "Create Card";
        modal.querySelector("#modal-id").value = id;
        modal.querySelector("#modal-name").value = name;
        modal.querySelector("#modal-url").value = URL;
        modal.querySelector("#modal-media").value = mediaURL;
    }
}