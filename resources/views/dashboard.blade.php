<x-dashboard-layout>
    <x-slot name="content">
    <div class="row">
    <div class="col-sm-12 header">

        <h1 class=text-center>Children</h1>
    </div>
</div>
<div class="container">
<div class="row" >
<div class="flex justify-content-center flex-wrap gap-2">
    @foreach($children as $id => $child)
    <div class="col-md-3 p-0 m-0 card-group">
        <div class="card" style="width: 18rem;">
            <div class="d-flex justify-content-center">
                <img src="{{ $child->getFirstMedia()->getFullUrl() }}" class="rounded client-img card-img-top">
            </div>
            <h1 class="text-center">{{$child->first_name}}</h1>
            <div class="card-body">
                <div class="d-flex justify-content-center" role="group" aria-label="Basic mixed styles example">
                    <button type="button" class="btn btn-kindfox-warning" 
                    data-bs-toggle="modal" 
                    data-bs-target="#childEditModal{{$id}}"
                    id="{{ $id }}" href="#">
                    Edit</button>
                        <button type="button" class="btn btn-kindfox-primary"
                        data-bs-toggle="modal" 
                        data-bs-target="#diaryModal{{$id}}"
                        id="{{ $id }}">
                        Diary
                        </button>
                    <button type="button" class="btn btn-kindfox-danger"
                    >Delete</button>
            </div>
          </div>
          {{--Modals--}}
          <x-diary-modal :id="$id"></x-diary-modal>
    </div>
    </div>
    @endforeach
</div>
</div>
    </x-slot>
</x-dasboard-layout>
