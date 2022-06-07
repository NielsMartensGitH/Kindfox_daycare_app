<x-dashboard-layout>
    <x-slot name="content">
        <h1>POSTS</h1>


        <!-- ADD MESSAGE -->
        <div class="row">
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
                        <li><a class="dropdown-item">Delete</a></li>
                    </ul>
                    </div>
                </div>
                </div>
                <p class="card-text">{{ $post->message }}</p>

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
                <x-add-post-modal :clients="$clients"></x-add-post-modal>
                <x-edit-post-modal :post="$post" :id="$id" :clients="$clients"></x-edit-post-modal>
        </div>

        @endforeach
        </div>

    </x-slot>
</x-dasboard-layout>