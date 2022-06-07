  <!-- Modal -->
  <div class="modal fade" id="addPost" tabindex="-1" aria-labelledby="addPostLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addPostLabel">Create message</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <!-- postsForm -->
          <form>
            <select formControlName="privacy" class="form-select my-2 privacy" aria-label="Default select example">
              <option>Choose a privacy</option>
              <option value="1">Private</option>
              <option value="0">Public</option>
            </select>

            <!-- only shows when value of privacy that is selected is 'private' -->
            <div class="my-3 child_input">
              <label><b>Select a child</b></label>
              <select  formControlName="child" class="form-select" aria-label="Default select example">
                <option>Choose  a child</option>
                <option >Nore Martens</option>
              </select>
            </div>
              <div class="my-3">
                <label><b>Add pictures</b></label>
                <input type="file" class="form-control" name="images[]" id="images" multiple accept="image/png, image/gif, image/jpeg">
              </div>
            <div class="my-3">
                <div class="form-floating">
                    <textarea class="form-control postinput" placeholder="Leave a comment here" id="floatingTextarea"></textarea>
                    <label for="floatingTextarea">Your message</label>
                  </div>
            </div>

                  <!-- FOOTER WITH BUTTONS -->
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Send</button>
            </div>
        </form>
        </div>
      </div>
    </div>
  </div>
