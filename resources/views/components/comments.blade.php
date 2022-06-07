@props(['post'])

@foreach($post->comments as $comment)
<div class="card-body">
    <div class="row">
      <div class="col-auto mx-3 my-1 avatarbox">

        <!-- if the commment has a parent_id we want to show the avatar of that parent -->
        <img src="{{ asset('assets/img/person-icon.png')}}" width="50px" class="rounded-pill">

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
            <small>{{ $comment->created_at->diffForHumans()}}</small>

          </div>
          <div class="dropdown">
            <i class="fas fa-ellipsis-h" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"></i>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
              <li><a class="dropdown-item">Delete</a></li>
              <!-- we don't want the daycares to edit parent message, only delete them -->
              <li><a class="dropdown-item">Edit</a></li>
            </ul>
          </div>
        </div>

         <!-- we don't want to show the comment when in editing mode for that comment -->
         <p>{{ $comment->message }}</p>
          <!-- instead when we are in editing mode this will be a textarea with the original comment in it which is now editable -->

        </div>
      </div>
    </div>

    <!-- for writing a new comment -->
    {{-- <div class="form-floating m-3">
      <textarea [(ngModel)]="commentText"  #refEl class="form-control commentinput" (keydown)="triggerFunction($event, refEl)" [style.height]="textareaHeight" placeholder="Leave a comment here" id="floatingTextarea"></textarea>
      <label for="floatingTextarea">Write a comment</label>
    </div> --}}

    <!-- when there are no comments written yet -->
  </div>
  @endforeach
  @if(!count($post->comments))
  <h4 class="m-3">There are no comments here</h4>
  @endif