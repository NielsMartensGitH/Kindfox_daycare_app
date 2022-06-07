@extends('layouts.MainUserView')

@section('content')
<!-- DIARIES MESSAGEBOARD  -->
<div class="d-flex justify-content-end">
    <a href="{{route('mainuserview')}}"><button class="btn  btn-secondary my-2">Back to Posts</button></a>
</div>

<!-- Loop of diaries data -->
    @foreach($Diaries as $diary)
        <div class="row justify-content-center my-3">
            <div class="col-sm-8">
                <div class="card">
                    <div class="card-body">

                        <div class="row">

                            <div class="col-auto">
                                <img src="" class="img-responsive rounded-circle" width="50px" alt="">
                            </div>
                            
                            <div class="col-sm-10">
                                <h5 class="card-title">{{$Company->name}}</h5>

                                <!-- TIME SINCE POSTED -->
                                <h6 class="card-subtitle mb-2 text-muted">Posted <span>{{$diary->created_at->diffForHumans()}}</span>/h6>
                            </div>
                            
                        </div>

                    
                        <!----    DIARY TEMPLATE--->
                        <div class="container green-border p-3 m-2">

                            <!-- NAME OF CHILD -->
                            <div class="row">
                                <div class="col green-border m-3 p-2">
                                    {{$curClient->first_name}} {{$curClient->last_name}}
                                </div>
                            </div>


                            <div class="row">

                                <!-- FOOD -->
                                <div class="col-md green-border m-3 p-2 redux">
                                    <span><p class="card-text kindfox-font-orange">{{$diary->food_message}}</p>
                                    <i class={{$diary->food_smile}}></i></span>
                                </div>

                                <!-- SLEEP -->
                                <div class="col-md green-border m-3 p-2 redux">
                                    <p class="card-text kindfox-font-orange">{{$diary->sleep_message}}</p>
                                    {{-- <i class={{$diary->sleep_smile}}></i> --}}
                                </div>

                            </div>

                            <!-- POT VISITS -->
                            <div class="kindfox-green-bg m-2 p-2">
                                <h5>Pot visits</h5>
                                {{-- <div>
                                    @for($i = 0; $i < {{$diary->poop_amount}}; i++)
                                        <i class="fas fa-poo brown-poop">
                                    @endfor
                                    @for($i= 0; $i < (5-{{$diary->poop_amount}}; i++))
                                        <i class="fas fa-poo"></i>
                                    @endfor --}}
                                </div>
                            </div>

                            <!-- ACTIVITIES -->
                            <div class="green-border m-2 p-2 kindfox-font-orange">
                                <h5>Activities</h5>
                                {{$diary->activitie_message}}
                            </div>
                            <div class="row">
                                <div class="col kindfox-green-bg m-4 p-3">
                                    <h5>My involvement in the activities:</h5>
                                    {{$diary->involvement_message}}
                                </div>
                                <div class="col kindfox-green-bg m-4 p-3">
                                    <h5>My mood today:</h5>
                                    {{$diary->mood}}
                                </div>
                            </div>
                            <div class="green-border m-2 p-2 kindfox-font-orange">
                                <h5>Message of the day</h5>
                                {{$diary->extra_message}}
                            </div>
                        </div>
                        <!---Diary template ends here-->

                        <!-- FOOTER OF POST -->
                    </div>
                    <div class="card-footer text-muted">
                        <div class="privacy d-flex justify-content-between">
                            <p class="m-0">Only you can see this message</p>
                            <button class="btn btn-secondary m-0 commentbutton" (click)="messageId(diary.id)">Comments</button>
                        </div> 
                    </div>
                    this is where the comment section goes
                </div>
            </div>
        </div>
        <br>
    @endforeach  
@endsection

<!--this is to show the children-->
@section('children')
    @if(!empty($Clients))
        @foreach ($Clients as $client)
            <a href="{{route('mainuserviewclients',$client->id)}}"><i class="fas fa-baby border rounded-circle p-2"></i>{{$client->first_name}} {{$client->last_name}}</a>
            <br>
        @endforeach
    @endif
@endsection
<!--this is to show the company info-->
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