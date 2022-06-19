<x-dashboard-layout :notifications="$notifications">
    <x-slot name="content">
        <div class="row">
          @if ($errors->any())
          <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif
            <div class="d-flex d-row">
                <h1>Parents</h1>
                <a class="nav-link">
                  <button type="button" class="btn btn-kindfox-success" data-bs-toggle="modal" data-bs-target="#addParent">
                    <span><i class="fa fa-plus-circle"></i> Add </span>
                  </button>
                </a>
            </div>
        </div>
        <div class="row">
            <div>
                  <div class="flex flex-wrap gap-3">
                      @foreach($main_users as $main_user)
                    <div class="card shadow-md" style="width: 18rem;">
                      <img src="{{ $main_user->getFirstMedia()->getFullUrl()}}" class="card-img-top" alt="...">
                      <div class="card-body">
                        <h5 class="card-title">{{ $main_user->first_name }} {{ $main_user->last_name }}</h5>
                        <p class="card-text">
                          Email: test@test.com
                          <br>
                          phone: {{ $main_user->phone_number }}
                        </p>
                        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                          <a href="{{ route('parent.detail', $main_user->id)}}">
                            <button type="button" class="btn btn-kindfox-success m-1" data-bs-toggle="modal" data-bs-target="#detailModal">
                              <i class="fas fa-info-circle"></i> Details
                            </button>
                          </a>
                          <button type="button" class="btn btn-kindfox-warning m-1"
                          data-bs-toggle="modal" data-bs-target="#editParent"><i class="fas fa-edit"></i> Edit</button>
                          <button type="button" class="btn btn-kindfox-danger m-1" data-bs-toggle="modal" data-bs-target="#deleteModal">
                              <i class="far fa-trash-alt"></i> Delete</button>
                        </div>
                      </div>
                    </div>
                    @endforeach
                  </div>
            </div>
        </div>
        <x-add-parent-modal></x-add-parent-modal>
    </x-slot>
</x-dasboard-layout>
