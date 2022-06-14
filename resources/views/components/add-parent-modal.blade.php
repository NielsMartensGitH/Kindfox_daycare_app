<!-- Modal -->
  <div class="modal fade" id="addParent" tabindex="-1" aria-labelledby="addPostLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addPostLabel">New parent</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- postsForm -->
          <form method="post" action="{{ route('parent.store')}}" enctype="multipart/form-data">
            @csrf
               @method('POST')
               <h5>Code: </h5>
               <div class="my-3">
                <div class="form-floating">
                    <input class="form-control" name="main_user_code" id="floatingTextarea">
                    <label for="floatingTextarea">Enter parent code</label>
                  </div>
                </div>
                <h5>Add First Child</h5>
                <div class="my-3">
                  <div class="form-floating">
                      <input class="form-control" name="first_name" id="floatingTextarea">
                      <label for="floatingTextarea">Firstname</label>
                    </div>
                  </div>
                  <div class="my-3">
                    <div class="form-floating">
                        <input class="form-control" name="last_name" id="floatingTextarea">
                        <label for="floatingTextarea">Lastname</label>
                      </div>
                    </div>
                    <div class="my-3">
                      <div class="form-floating">
                          <input class="form-control" name="age" id="floatingTextarea">
                          <label for="floatingTextarea">Age</label>
                        </div>
                      </div>
                      <div>
                        <h5 class="my-4">Add profile picture: </h5>
                        <input type="file" class="form-control" name="client_pic" id="client_pic" accept="image/png, image/gif, image/jpeg">
                        <div class="flex justify-around gap-1 flex-wrap" id="prevImages"></div> {{-- for showing preview of images --}}
                        </div>
                  <!-- FOOTER WITH BUTTONS -->
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Submit</button>
            </div>
        </form>
        </div>
      </div>
    </div>
  </div>

