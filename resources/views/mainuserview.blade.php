@extends('layouts.MainUserView')

@section('content')
    @foreach($Posts as $post)
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-auto">
                            COMPANY IMG HERE
                        </div>
                        <div class="col-sm-10">
                            <h5 class="card-title">{{$post->name}}</h5>
                            <h6 class="card-subtitle mb-2 text-muted">Posted <span>TIME CALC HERE</span><span> ago</span></h6>
                        </div>
                    </div>
                    <p class="card-text">{{$post->message}}</p>
                    </div>

                    <div class="card-footer text-muted">
                        <div class="privacy d-flex justify-content-between">
                            @if($post->is_private == 0)
                                <p class="m-0">Every parent can see this message</p>
                            @else
                                <p class="m-0">Only You can see this message</p>
                            @endif
                            <div class="comments" style="display:none">
                                @foreach($Comments as $comment)
                                    <p>{{$comment->message}}</p>
                                @endforeach
                            </div>
                        </div> 
                    </div>

                </div>
            </div>
    @endforeach
@endsection