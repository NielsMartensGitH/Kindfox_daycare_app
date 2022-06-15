<x-dashboard-layout>
    <x-slot name="content">

<!-- title -->
<div class="row">
    <div class="col-sm-12">
        <h1>Diaries</h1>
    </div>
</div>

<div class="row justify-content-center my-3">
  <div class="col-sm-12">
    <div class="card shadow-sm">
      <div class="card-body">
        <div class="row">
          <div class="col-auto">
            <img src="{{Auth::user()->company()->first()->getMedia()[0]->getFullUrl()}}" class="img-responsive rounded-circle" width="50px" alt="">
          </div>
          <div class="col-sm-10">
            <h5 class="card-title">{{ Auth::user()->name }}</h5>

            <!-- TIME SINCE POSTED -->
            <h6 class="card-subtitle mb-2 text-muted">Posted {{ $diary->created_at->diffForHumans() }}</h6>
          </div>
          <div class="col-sm-1">
          </div>
        </div>

        <!----    DIARY TEMPLATE--->
        <div class="container green-border p-3 m-2">

          <!-- NAME OF CHILD -->
          <div class="row">
            <div class="col green-border m-3 p-2">
              {{ $diary->clients->first_name }} {{ $diary->clients->last_name }}
            </div>
          </div>


          <div class="row">

            <!-- FOOD -->
            <div class="col-md green-border m-3 p-2 redux">
              <span><p class="card-text kindfox-font-orange">{{ $diary->food_message }}</p>
                @if($diary->food_smile)
              <i class="fas fa-smile-beam"></i></span>
                @else
                <i class="fas fa-frown-open"></i>
                @endif
            </div>

            <!-- SLEEP -->
            <div class="col green-border m-3 p-2">
              <p class="card-text kindfox-font-orange">{{ $diary->sleep_message }}</p>
              @if($diary->sleep_smile)
              <i class="fas fa-smile-beam"></i></span>
                @else
                <i class="fas fa-frown-open"></i>
                @endif
            </div>

          </div>

          <!-- POT VISITS -->
          <div class="kindfox-green-bg m-2 p-2">
            <h5>Pot visits</h5>
            <div>
              @for ($i = 0; $i < $diary->poop_icons; $i++)
              <i class="fas fa-poo brown-poop"></i>
              @endfor
            </div>
          </div>

          <!-- ACTIVITIES -->
          <div class="green-border m-2 p-2 kindfox-font-orange">
            <h5>Activities</h5>
            {{ $diary->activity_message }}
          </div>
          <div class="row">
            <div class="col kindfox-green-bg m-4 p-3">
              <h5>My involvement in the activities:</h5>
              {{ $diary->involvement_message }}
            </div>
            <div class="col kindfox-green-bg m-4 p-3">
              <h5>My mood today:</h5>
              {{ $diary->mood }}
            </div>
          </div>
          <div class="green-border m-2 p-2 kindfox-font-orange">
            <h5>Message of the day</h5>
            {{ $diary->extra_message }}
          </div>
        </div>
        <!---Diary template ends here-->

        <!-- FOOTER OF POST -->
      </div>
      <div class="card-footer text-muted">
       <div class="privacy d-flex justify-content-between">
         <p class="m-0">Only you can see this message</p>
       </div> 
      </div>
    </div>
  </div>
</div>
  
    </x-slot>
</x-dasboard-layout>
