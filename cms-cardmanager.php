<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#sbModalCardManager" id="modalSpawner" hidden> </button>
<div class="modal fade" id="sbModalCardManager" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Edit card</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post">
                    <div class="mb-3">
                        <input type="hidden" name="modalAction" id="modal-action" value="">
                        <input type="hidden" name="modalId" id="modal-id" value="">
                        <span id="errorsSpanSG"></span>
                        <div class="form-outline mb-4 ">
                            <label for="modalName" class="form-label">Title</label>
                            <input type="text" class="form-control" name="modalName" id="modal-name">
                        </div>
                        <div class="form-outline mb-4">
                            <label for="modalURL" class="form-label">Link</label>
                            <input type="text" class="form-control" name="modalURL" id="modal-url">
                        </div>
                        <div class="form-outline mb-4">
                            <label for="modalMedia" class="form-label">Image URL</label>
                            <input type="text" class="form-control" name="modalMedia" id="modal-media">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" id="editbutt">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>