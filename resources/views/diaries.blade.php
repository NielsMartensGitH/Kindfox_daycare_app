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
            <a href="" class="btn btn-secondary">Edit</a>
            <a href="" class="btn btn-danger">Delete</a>
          </td>
      </tr>
    @endforeach
  </tbody>
</table>

<!-- Loop of diaries data -->
<div class="row justify-content-center my-3">
  <div class="col-sm-12">
    <div class="card shadow-sm">
      <div class="card-body">
        <div class="row">
          <div class="col-auto">
            <img src="{{ asset('assets/img/daycarerainbow_avatar.jpg')}}" class="img-responsive rounded-circle" width="50px" alt="">
          </div>
          <div class="col-sm-10">
            <h5 class="card-title">Daycare test</h5>

            <!-- TIME SINCE POSTED -->
            <h6 class="card-subtitle mb-2 text-muted">Posted <span>2 minutes</span><span> ago</span></h6>
          </div>
          <div class="col-sm-1">

            <!-- EDITING OR DELETE DROPDOWN -->
            <div class="dropdown">
              <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                Actions
              </button>
              <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                <li><a class="dropdown-item">Delete</a></li>
              </ul>
            </div>

          </div>
        </div>

        <!----    DIARY TEMPLATE--->
        <div class="container green-border p-3 m-2">

          <!-- NAME OF CHILD -->
          <div class="row">
            <div class="col green-border m-3 p-2">
              Nore Martens
            </div>
          </div>


          <div class="row">

            <!-- FOOD -->
            <div class="col-md green-border m-3 p-2 redux">
              <span><p class="card-text kindfox-font-orange">vandaag heb ik wasco stiften gegeten maar de opvanger werd kwaad. ik heb dan maar tegen mijn zin pap gegeten. de rijstpap was op want Jasmijn heeft alles opgesmikkeld >:(</p>
              <i class="fas fa-smile-beam"></i></span>
            </div>

            <!-- SLEEP -->
            <div class="col green-border m-3 p-2">
              <p class="card-text kindfox-font-orange">Een tweetal uur tot Roos naast me scheten begon te laten. bah bah en stinken, niet te doen</p>
              <i class="fas fa-frown-open"></i>
            </div>

          </div>

          <!-- POT VISITS -->
          <div class="kindfox-green-bg m-2 p-2">
            <h5>Pot visits</h5>
            <div>
              <i class="fas fa-poo brown-poop"></i>
            </div>
          </div>

          <!-- ACTIVITIES -->
          <div class="green-border m-2 p-2 kindfox-font-orange">
            <h5>Activities</h5>
            mario kart met Tuur, jongejonge is die goed zeg
          </div>
          <div class="row">
            <div class="col kindfox-green-bg m-4 p-3">
              <h5>My involvement in the activities:</h5>
              I am lost in the game
            </div>
            <div class="col kindfox-green-bg m-4 p-3">
              <h5>My mood today:</h5>
              good
            </div>
          </div>
          <div class="green-border m-2 p-2 kindfox-font-orange">
            <h5>Message of the day</h5>
            Yo mams, laat me in het weekend ook maar hier!
          </div>
        </div>
        <!---Diary template ends here-->

        <!-- FOOTER OF POST -->
      </div>
      <div class="card-footer text-muted">
       <div class="privacy d-flex justify-content-between">
         <p class="m-0">Only you can see this message</p>
         <button class="btn btn-secondary m-0 commentbutton">Comments</button>
       </div> 
      </div>
    </div>
  </div>
</div>
  





    </x-slot>
</x-dasboard-layout>
