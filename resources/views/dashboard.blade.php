<x-dashboard-layout>
    <x-slot name="content">
    <div class="row">
    <div class="col-sm-12 header">

        <h1 class=text-center>Children</h1>
    </div>
</div>
<div class="container">
<div class="row" >
    <div class="col-md-3 p-0 m-0 card-group" *ngFor="let child of children$">
        <div class="card" style="width: 18rem;">
            <img src="../../../assets/img/profielfotoRoos.jpg" class="card-img-top" alt="..."
            [ngClass]="{'green-border': child.checked_in === 1}"
            (dblclick)="onDblClick(child)">
            <h1>Baby</h1>
            <div class="card-body d-flex justify-content-center">
                <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                    <button type="button" class="btn btn-kindfox-warning" 
                    data-bs-toggle="modal" 
                    data-bs-target="#childEditModal"
                    (click)="passedChild = child">
                    Edit</button>
                    <div>
                        <button type="button" class="btn btn-kindfox-primary"
                        data-bs-toggle="modal" data-bs-target="#exampleModal"
                    (click)="childToDiary = child">Diary</button>
                    
                    <button type="button" class="btn btn-kindfox-danger"
                    (click)="onDelete(child)">Delete</button>
                  </div>
            </div>
          </div>
    </div>
   
</div>
</div>
    </x-slot>
</x-dasboard-layout>
