<x-dashboard-layout :notifications="$notifications">
    <x-slot name="content">
        <div class="row">
            <div class="col-sm-12 header">

                <h1 class=text-center>Children</h1>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="children flex justify-content-center flex-wrap gap-2" id="children">
                    @foreach($children as $id => $child)
                    <div class="col-md-3 p-0 m-0 card-group child-card">
                        <div class="card" style="width: 18rem;">
                            <div class="d-flex justify-content-center">
                                <form method="post" action="{{ route('child.update', ['client' => $child->id])}}">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" style="none">
                                    <img src="{{ $child->getFirstMedia()->getFullUrl() }}" id="{{$child->id}}" class="rounded client-img card-img-top">
                                    </button>
                                    <input type="hidden" name="checked_in" class="getCheckedInStatus{{$child->id}}" value="{{$child->checked_in}}">
                                    <input type="hidden" class="childId" value="{{$child->id}}">
                                </form>
                            </div>
                            <h1 class="text-center">{{$child->first_name}}</h1>
                            <div class="card-body">
                                <div class="d-flex justify-content-center" role="group" aria-label="Basic mixed styles example">
                                    <button type="button" class="btn btn-kindfox-warning" data-bs-toggle="modal" data-bs-target="#editChild{{$id}}" id="{{ $id }}" href="#">
                                        Edit</button>
                                    <x-edit-child-modal :client="$child" :id="$id"></x-edit-child-modal>
                                    <button type="button" class="btn btn-kindfox-primary" data-bs-toggle="modal" data-bs-target="#diaryModal{{$id}}" id="{{ $id }}">
                                        Diary
                                    </button>
                                    <a href="{{ route('client.destroy', ['client' => $child->id]) }}"><button type="button" class="btn btn-kindfox-danger">Delete</button></a>
                                </div>
                            </div>
                            {{--Modals--}}
                            <x-diary-modal :id="$id" :clientid="$child->id"></x-diary-modal>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>


    </x-slot>
    </x-dasboard-layout>