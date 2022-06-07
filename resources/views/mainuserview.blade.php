@extends('layouts.MainUserView')

@section('content')
    @foreach($Posts as $post)
        @foreach($User as $user)
            @foreach($user->companies as $company)
                @if($company->id == $post->company_id)
                    @if(!empty($Clients))
                        @foreach($Clients as $client)
                            @if($post->is_private == 0)
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-auto">
                                                COMPANY IMG HERE
                                                {{$company->name}}
                                            </div>
                                            <div class="col-sm-10">
                                                <h5 class="card-title">{{$post->name}}</h5>
                                                <h6 class="card-subtitle mb-2 text-muted">Posted <span>{{$post->created_at->diffForHumans()}}</span></h6>
                                            </div>
                                        </div>
                                        <p class="card-text">{{$post->message}}</p>
                                        <img src="..." class="card-img-top" alt="...">
                                    </div>

                                    <div class="card-footer text-muted">
                                        <div class="privacy d-flex justify-content-between">
                                                <p class="m-0">Every parent can see this message</p>
                                            <div class="comments">
                                                @foreach($Comments as $comment)
                                                    @if ($comment->post_id == $post->id)
                                                        <p>{{$comment->message}}</p>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                            @elseif($post->is_private == 1 && $post->client_id == $client->id)
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-auto">
                                                COMPANY IMG HERE
                                                {{$company->name}}
                                            </div>
                                            <div class="col-sm-10">
                                                <h5 class="card-title">{{$post->name}}</h5>
                                                <h6 class="card-subtitle mb-2 text-muted">Posted <span>{{$post->created_at->diffForHumans()}}</span></h6>
                                            </div>
                                        </div>
                                        <p class="card-text">{{$post->message}}</p>
                                        <img src="..." class="card-img-top" alt="...">
                                    </div>

                                    <div class="card-footer text-muted">
                                        <div class="privacy d-flex justify-content-between">
                                                <p class="m-0">Only You can see this message</p>
                                            <div class="comments">
                                                @foreach($Comments as $comment)
                                                    @if ($comment->post_id == $post->id)
                                                        <p>{{$comment->message}}</p>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endif
                @endif
            @endforeach
        @endforeach
    @endforeach
@endsection

@section('children')
    @if(!empty($Clients))
        @foreach ($Clients as $client)
            <a href="{{route('mainuserviewclients',$client->id)}}"><i class="fas fa-baby border rounded-circle p-2"></i>{{$client->first_name}} {{$client->last_name}}</a>
            <br>
        @endforeach
    @endif
@endsection

@section('daycareinfo')
    @foreach($User as $user)
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