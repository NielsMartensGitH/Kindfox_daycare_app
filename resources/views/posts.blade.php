<x-dashboard-layout :notifications="$notifications">
    <x-slot name="content">
        {{-- <h1>POSTS</h1> --}}

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
        <!-- ADD MESSAGE -->
        <div class="row my-3">
        <div class="col-sm-12">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-add" data-bs-toggle="modal" data-bs-target="#addPost">
        Add message
            </button>
        </div>
        </div>

        <!-- POST TEMPLATE -->
        <div class="row justify-content-center my-3">
            @foreach($posts as $id => $post)
        <div class="col-sm-12 my-3">
            <div class="card shadow">
            <!-- BODY -->
            <div class="card-body">
                <div class="row">
                <div class="col-auto">
                    <img src="{{asset('assets/img/daycarerainbow_avatar.jpg')}}" class="img-responsive rounded-circle" width="50px" alt="">
                </div>
                <div class="col-sm-10">
                    <h5 class="card-title">{{ $post->companies->name }}</h5>
                    <h6 class="card-subtitle mb-2 text-muted">Posted {{ $post->created_at->diffForHumans() }}</h6>
                </div>
                <div class="col-sm-1">
                    <div class="dropdown">
                    <button class="btn btn-action dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        Actions
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item edit_modal" id="{{ $id }}" href="#" data-bs-toggle="modal" data-bs-target="#editModal{{$id}}">Edit</a></li>
                        <li><a href="{{ route('post.destroy', $post->id)}}" title="delete" class="dropdown-item action-delete">Delete</a></li>
                    </ul>
                    </div>
                </div>
                </div>
                <p class="card-text">{{ $post->message }}</p>
                @if(count($post->getMedia()))
               <div class="flex justify-around gap-1 flex-wrap">
                    @foreach ($post->getMedia() as $media)
                        <a href="{{ $media->getFullUrl() }}" data-lightbox="album{{ $post->id }}" data-title="{{Auth::user()->name}}"><img src="{{ $media->getFullUrl() }}" width="325px"  class="rounded shadow"></a>
                    @endforeach
               </div>
               @endif
            </div>

            <!-- FOOTER WITH COMMENTS AND PRIVACY MESSAGE -->
            <div class="card-footer text-muted">
            <div class="privacy d-flex justify-content-between">
                @if($post->is_private)
                    <p class="m-0">Only you can see this message</p>
                @else
                    <p class="m-0">Every parent can see this message</p>
                @endif
                <button id="{{ $id }}" class="btn btn-secondary commentbutton">Comments</button>
            </div>
            </div>

            <!-- COMMENTS  -->
            <div id="{{ $id }}" class="comment hidden">
                <x-comments :post="$post"></x-comments>
            </div>
            </div>
                {{-- MODALS --}}
                <x-edit-post-modal :post="$post" :id="$id" :clients="$clients"></x-edit-post-modal>
        </div>

        @endforeach
        </div>
        <x-add-post-modal :clients="$clients"></x-add-post-modal>
    </x-slot>
</x-dasboard-layout>