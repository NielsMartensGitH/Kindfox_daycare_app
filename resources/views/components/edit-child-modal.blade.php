@props(['client', 'id'])
<!-- Modal -->
<div class="modal fade" id="editChild{{$id}}" tabindex="-1" aria-labelledby="addPostLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addPostLabel">Edit Child</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- postsForm -->
          <form method="post" action="{{ route('client.edit', ['client' => $client->id])}}" enctype="multipart/form-data">
            @csrf
               @method('PUT')

                <div class="my-3">
                  <div class="form-floating">
                      <input class="form-control" name="first_name" id="floatingTextarea" value="{{ $client->first_name }}">
                      <label for="floatingTextarea">Firstname</label>
                    </div>
                  </div>
                  <div class="my-3">
                    <div class="form-floating">
                        <input class="form-control" name="last_name" id="floatingTextarea" value="{{ $client->last_name }}">
                        <label for="floatingTextarea">Lastname</label>
                      </div>
                    </div>
                    <div class="my-3">
                      <div class="form-floating">
                          <input class="form-control" name="age" id="floatingTextarea" value="{{ $client->age }}">
                          <label for="floatingTextarea">Age</label>
                        </div>
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

