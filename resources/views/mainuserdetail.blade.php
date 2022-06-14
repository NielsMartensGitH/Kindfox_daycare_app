<x-dashboard-layout>
    <x-slot name="content">
          @if ($errors->any())
          <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif
            <div class="d-flex">
                <div class="m-4">
                    <div>
                        <img src="{{ $main_user->getFirstMedia()->getFullUrl()}}" width="350px" class="rounded">
                    </div>
                </div>
                <div class="m-4">
                    <div style="width: 500px">
                        <h2>{{ $main_user->first_name }} {{ $main_user->last_name }}</h2>
                    </div>
                    <div class="d-flex justify-content-between">
                        <div class="fw-bold">Address: </div>
                        <div class="user_detail"> {{ $main_user->street_number}}, {{ $main_user->postal_code }} {{ $main_user->city }}</div>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <div class="fw-bold">Country: </div>
                        <div class="user_detail"> {{ $main_user->country }}</div>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <div class="fw-bold">Phone number: </div>
                        <div class="user_detail"> {{ $main_user->phone_number }}</div>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <div class="fw-bold">Email: </div>
                        <div class="user_detail"> {{ $main_user->user->email }}</div>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <div class="fw-bold">Customer since: </div>
                        <div class="user_detail"> {{ $main_user->created_at->isoFormat('Do MMMM YYYY') }}</div>
                    </div>
                    <hr>
                </div>
            </div>
            <div class="d-flex align-items-center">
                <h3 class="mx-2">Children</h3>
            <a class="nav-link">
                <button type="button" class="btn btn-kindfox-success" data-bs-toggle="modal" data-bs-target="#addChild">
                  <span><i class="fa fa-plus-circle"></i> Add Child </span>
                </button>
              </a>
            </div>
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Age</th>
                    <th scope="col">Member Since</th>
                    <th scope="col">thumbnail</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($main_user->clients as $client)
                      @if($client->companies()->find($company_id))
                        <tr>
                          <th scope="row"> {{ $client->id }}</th>
                          <td>{{ $client->first_name}}</td>
                          <td> {{ $client->last_name }}</td>
                          <td>{{ $client->age }}</td>
                          <td> {{ $client->created_at->isoFormat('Do MMMM YYYY') }}</td>
                          <td><img src="{{ $client->getFirstMedia()->getFullUrl()}}" class="client-thumbnail"></td>
                          <td class="d-flex justify-content-center gap-2">
                            <a href="" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#addChild">Edit</a>
                            <a href="{{ route('client.destroy', ['client' => $client->id, 'user' => $main_user->id])}}" class="btn btn-danger">Delete</a>
                          </td>
                        </tr>
                        <x-edit-child-modal :main_user="$main_user" :client="$client"></x-edit-child-modal>
                      @endif
                    @endforeach
                </tbody>
              </table>
              <x-add-child-modal :main_user="$main_user"></x-add-child-modal>
    </x-slot>
</x-dasboard-layout>
