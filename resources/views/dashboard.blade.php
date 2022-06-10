<x-dashboard-layout>
    <x-slot name="content">
    <div class="row">
    <div class="col-sm-12 header">

        <h1 class=text-center>Children</h1>
    </div>
</div>
<div class="container">
<div class="row" >
<div class="flex flex-wrap gap-2">
    @foreach($children as $id => $child)
    <div class="col-md-3 p-0 m-0 card-group">
        <div class="card" style="width: 18rem;">
            <img src="../../../assets/img/profielfotoRoos.jpg" class="card-img-top" alt="..."
            >
            <h1>{{$child->first_name}}</h1>
            <div class="card-body d-flex justify-content-center">
                <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                    <button type="button" class="btn btn-kindfox-warning" 
                    data-bs-toggle="modal" 
                    data-bs-target="#childEditModal{{$id}}"
                    id="{{ $id }}" href="#"
                    >
                    Edit</button>
                    <div>
                        <button type="button" class="btn btn-kindfox-primary"
                        data-bs-toggle="modal" 
                        data-bs-target="#diaryModal{{$id}}"
                        id="{{ $id }}"
                    >Diary</button>
                    
                    <button type="button" class="btn btn-kindfox-danger"
                    >Delete</button>
                  </div>
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
