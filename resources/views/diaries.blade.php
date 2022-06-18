<x-dashboard-layout>
    <x-slot name="content">

<!-- title -->
<div class="row">
    <div class="col-sm-12">
        <h1>Diaries</h1>
    </div>
</div>

<table id="table_id" class="display">
  <thead>
      <tr>
          <th>Id</th>
          <th>Client</th>
          <th>Image</th>
          <th>Written at</th>
          <th>Actions</th>
      </tr>
  </thead>
  <tbody>
    @foreach ($diaries as $diary)
      <tr>
          <td>{{ $diary->id }}</td>
          <td>{{ $diary->clients->first_name }} {{ $diary->clients->last_name }}</td>
          <td><img src="{{ $diary->clients->getFirstMedia()->getFullUrl()}}" class="client-thumbnail"></td>
          <td>{{ $diary->created_at->isoFormat('Do MMMM YYYY') }}</td>
          <td>
            <a href="{{ route('diary.detail', $diary->id)}}" class="btn btn-dark">Show</a>
            <a href="{{ route('diary.destroy', $diary->id)}}" class="btn btn-danger">Delete</a>
          </td>
      </tr>
    @endforeach
  </tbody>
</table>
    </x-slot>
</x-dasboard-layout>
