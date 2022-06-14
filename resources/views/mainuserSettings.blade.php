@extends('layouts.MainUserView')

@section('content')
    @foreach($Userdata as $data)
        <form method="POST" action="{{ route('updateuser', $data->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="flex gap-5">
            <div class="w-50">
                <div>
                    <x-label for="first_name" :value="__('First Name')" />
                    <x-input id="first_name" class="block mt-1 w-full" type="text" name="first_name" :value="old('first_name')" value="{{$data->first_name}}" required autofocus />
                </div>
                <div class="mt-4">
                    <x-label for="last_name" :value="__('Last Name')" />
                    <x-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" :value="old('last_name')" value="{{$data->last_name}}" required autofocus />
                </div>
                <div class="mt-4">
                    <x-label for="streetnr" :value="__('Street/number')" />
                    <x-input id="streetnr" class="block mt-1 w-full" type="text" name="streetnr" :value="old('streetnr')" value="{{$data->street_number}}" required autofocus />
                </div>
                <div class="mt-4">
                    <x-label for="country" :value="__('Country')" />
                    <x-input id="country" class="block mt-1 w-full" type="text" name="country" :value="old('country')"  value="{{$data->country}}" required autofocus />
                </div>
            </div>
            <div class="w-50">
                <div class="">
                    <x-label for="postal_code" :value="__('Postal Code')" />
                    <x-input id="postal_code" class="block mt-1 w-full" type="text" name="postal_code" :value="old('postal_code')"  value="{{$data->postal_code}}" required autofocus />
                </div>
                <div class="mt-4">
                    <x-label for="city" :value="__('City')" />
                    <x-input id="city" class="block mt-1 w-full" type="text" name="city" :value="old('city')" value="{{$data->city}}" required autofocus />
                </div>
                <div class="mt-4">
                    <x-label for="phone" :value="__('Phone number')" />
                    <x-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" value="{{$data->phone_number}}" required autofocus />
                </div>
            
                {{-- <div class="mt-8">
                    <x-label for="email" :value="__('Profile picture')" />

                    <input type="file" class="form-control" name="user_pic" id="user_pic" accept="image/png, image/gif, image/jpeg">
                </div> --}}
                <div class="flex justify-around gap-1 flex-wrap" id="prevImages"></div> {{-- for showing preview of images --}}
                <input type="hidden" name="role_id" value=1>

                </div>
            </div>
            <div class="flex items-center justify-end mt-4">
                <x-button class="ml-4">
                    {{ __('Update') }}
                </x-button>
            </div>
        </form>
    @endforeach
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

