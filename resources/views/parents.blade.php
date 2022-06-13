<x-dashboard-layout>
    <x-slot name="content">
        <div class="row">
            <div class="d-flex d-row">
                <h1>Parents</h1>
                <a class="nav-link">
                  <button type="button" class="btn btn-kindfox-success"
                  >
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
                          <button type="button" class="btn btn-kindfox-success m-1" data-bs-toggle="modal" data-bs-target="#detailModal">
                              <i class="fas fa-info-circle"></i> Details</button>
                          <button type="button" class="btn btn-kindfox-warning m-1"
                          data-bs-toggle="modal" data-bs-target="#editParent"><i class="fas fa-edit"></i> Edit</button>
                          <button type="button" class="btn btn-kindfox-danger m-1" data-bs-toggle="modal" data-bs-target="#deleteModal">
                              <i class="far fa-trash-alt"></i> Delete</button>
                        </div>
                      </div>
                    </div>
                    @endforeach
                  </div>
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">FirstName</th>
                        <th scope="col">LastName</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach($main_users as $main_user)
                      <tr>
                        <th scope="row">{{ $main_user->id }}</th>
                        <td>{{ $main_user->first_name }}</td>
                        <td> {{ $main_user->last_name }}</td>
                        <td>test@test.com</td>
                        <td>{{ $main_user->phone_number }}</td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                <button type="button" class="btn btn-kindfox-success m-1" data-bs-toggle="modal" data-bs-target="#detailModal">
                                    <i class="fas fa-info-circle"></i> Details</button>
                                <button type="button" class="btn btn-kindfox-warning m-1"
                                data-bs-toggle="modal" data-bs-target="#editParent">
                                    <i class="fas fa-edit"></i> Edit</button>
                                <button type="button" class="btn btn-kindfox-danger m-1" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                    <i class="far fa-trash-alt"></i> Delete</button>
                              </div>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
            </div>
        </div>
    </x-slot>
</x-dasboard-layout>
