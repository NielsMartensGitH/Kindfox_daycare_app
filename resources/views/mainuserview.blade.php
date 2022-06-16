@extends('layouts.MainUserView', ['notifications' => $notifications])
@section('content')
    {{-- <h1>POSTS</h1> --}}

    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />

    <!-- POST TEMPLATE -->
    <div class="row justify-content-center my-3">
        @foreach($posts as $id => $post)
            @foreach($user as $curuser)
                @foreach($curuser->companies as $company)
                    @if($company->id == $post->company_id)
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
                            <x-add-post-modal :clients="$clients"></x-add-post-modal>
                            <x-edit-post-modal :post="$post" :id="$id" :clients="$clients"></x-edit-post-modal>
                        </div>
                    @endif
                @endforeach
            @endforeach
        @endforeach
    </div>
@endsection

@section('children')
    @if(!empty($clients))
        @foreach ($clients as $client)
            <a href="{{route('mainuserviewclients',$client->client_id)}}"><i class="fas fa-baby border rounded-circle p-2"></i>{{$client->first_name}} {{$client->last_name}}</a>
            @if($client->checked_in == 1)
                <span class="yesdot"></span>
            @elseif($client->check_in == 0)
                <span class="nodot"></span>
            @endif
            <br>
        @endforeach
    @endif
@endsection

@section('daycareinfo')
    @foreach($user as $user)
        @foreach($user->companies as $company)
            <!-- this is where the user can see all info about their daycare on the right sidebar -->
            <div class="row mx-1">
                <div class="col-md-12">
                    <h4 class="my-2">my daycare</h4>
                    <div class="card daycare-contact textblack">
                        <div class="card-body p-4">
                            <h5 class="card-title text-center"> {{$company->name}} </h5>
                            <div class="card-text">
                                <div class="d-flex justify-content-center">
                                    <img src='./../assets/img/daycarerainbow_avatar.jpg' alt="" width='165px'>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center">
                                <button class="my-1 btn btn-kindfox-warning" data-bs-toggle="modal" data-bs-target="#exampleModal">Contact</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <!-- Modal -->
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLabel"> {{$company->name}}</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body textblack">
                    <div class="row d-flex justify-content-center">
                    <div class="col-sm-3 mx-3 p-3 border">
                        <h3>Address</h3>
                        <div> {{$company->street_number}}</div>
                        <div> {{$company->city}} {{$company->postal_code}}</div>
                    </div>
                    <div class="col-sm-3 p-3 mx-3 border">
                        <h3>Contact</h3>
                        <div>email here</div>
                        <div>{{$company->phone_number}}</div>
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-sm-12">
                        <div class="my-3 d-flex justify-content-center">
                        <div class="mapouter"><div class="gmap_canvas"><iframe width="800" height="500" id="gmap_canvas" src="https://maps.google.com/maps?q={{$company->city}}&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://fmovies-online.net"></a><br><style>.mapouter{position:relative;text-align:right;height:500px;width:600px;}</style><a href="https://www.embedgooglemap.net">show google maps on website</a><style>.gmap_canvas {overflow:hidden;background:none!important;height:500px;width:600px;}</style></div></div>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
                </div>
            </div>
        </div>
        @endforeach
    @endforeach
@endsection