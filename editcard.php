


<html>
   

   <!-- EDIT PART -->
   <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                      <div class="modal-content">
                                          <div class="modal-header">
                                              <h5 class="modal-title" id="staticBackdropLabel">Edit card</h5>
                                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                          </div>
                                          <div class="modal-body">
   
                                              <form method="post">
                                                  <formu class="mb-3">
                                                      <input type="hidden" name="editId" value="<?= $row->id ?>">
                                                      <span id="errorsSpanSG"></span>
                                                      <div class="form-outline mb-4 ">
                                                          <label for="exampleFormControlInput1" class="form-label">title</label>
                                                          <input type="text" class="form-control" name="updateTitle" id="hubTitle" placeholder="<?= $row->name  ?>">
                                                      </div>
                                                      <div class="form-outline mb-4">
                                                          <label for="exampleFormControlInput1" class="form-label">link</label>
                                                          <input type="text" class="form-control" name="updateLink" id="hubDescription" placeholder="<?= $row->url ?>">
                                                      </div>
                                                      <div class="form-outline mb-4">
                                                          <label for="exampleFormControlInput1" class="form-label">image URL: <img class="image" height="50px" src='<?= $row->imageUrl ?>'></img></label>
                                                          <input type="text" class="form-control" name="updateURLpng" id="URLpng" placeholder="<?= $row->imageUrl ?>">
                                                      </div>
   
                                                      
                                                  </formu>
   
                                                  <div class="modal-footer">
                                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                              <button type="submit" class="btn btn-primary" id="editbutt">confirm</button>
                                              </form>
                                          </div>
                                          </div>
                                          
                                          
                                      </div>
                                  </div>
                              </div>
 
                          
   </html>