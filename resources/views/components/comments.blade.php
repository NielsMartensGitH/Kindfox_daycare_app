@props(['post'])

<div class="comment{{ $post->id }}">
  @foreach($post->comments as $comment)
  <div class="card-body comment-body">
      <div class="row">
        <div class="col-auto mx-3 my-1 avatarbox">

          <!-- if the commment has a parent_id we want to show the avatar of that parent -->
          @if($comment->company)
          <img src="{{ $comment->company->getFirstMedia()->getFullUrl() }}" width="50px" class="mx-2 circular--landscape">
          @elseif ($comment->main_user)
          <img src="{{ $comment->main_user->getFirstMedia()->getFullUrl() }}" width="50px" class="mx-2 circular--landscape">
          @else
          @endif
          <!-- else we show the avatar of the daycare -->
        </div>

        <div class="col-auto message">
          <div class="card-text px-3 py-2 my-1 comment-text">
            <div class="d-flex justify-content-between">
            <div class="commenthead">

              <!-- if the comment has a daycare_id we want to show the name of that daycare -->
              @if( $comment->company_id)
                <h6>{{ $comment->company->name }}</h6>
              @else
                <h6>{{ $comment->main_user->first_name }} {{ $comment->main_user->last_name }}</h6>
              @endif
              <!-- time since comment has been written below the name -->
              <small>{{ $comment->created_at->diffForHumans() }}</small>

            </div>
            <div class="dropdown">
              <i class="fas fa-ellipsis-h" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"></i>
              <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                <li><a class="dropdown-item">Delete</a></li>
              </ul>
            </div>
          </div>

          <!-- we don't want to show the comment when in editing mode for that comment -->
          <p>{{ $comment->message }}</p>
            <!-- instead when we are in editing mode this will be a textarea with the original comment in it which is now editable -->

          </div>
        </div>
      </div>

      <!-- when there are no comments written yet -->
    </div>
    @endforeach
</div>
  <!-- for writing a new comment -->
  <form method="post" action="#" class="comments" id="comments{{$post->id}}">
    <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
  <div class="form-floating m-3">
    <textarea class="form-control commentinput" name="message" placeholder="Leave a comment here" id="message"></textarea>
    @if(is_null(Auth::user()->company_id))
    <input type="hidden" name="main_user_id" value="{{Auth()->user()->main_user_id}}" id="main_user_id">
    <input type="hidden" name="company_id" value="null" id="company_id">
    @else
    <input type="hidden" name="main_user_id" value=null id="main_user_id">
    <input type="hidden" name="company_id" value="{{Auth::user()->company->id}}" id="company_id">
    <input type="hidden" name="company_name" value="{{Auth::user()->company->name}}" id="company_name">
    @endif
    <input type="hidden" name="commentPost_id" value="{{$post->id}}" id="commentPost_id">
    <label for="floatingTextarea">Write a comment</label>
  </div>
</form>
  @if(!count($post->comments))
  <h4 class="m-3">There are no comments here</h4>
  @endif