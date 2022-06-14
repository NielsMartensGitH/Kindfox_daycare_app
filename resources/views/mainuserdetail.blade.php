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
            <h3 class="mx-4">Children</h3>
    </x-slot>
</x-dasboard-layout>
