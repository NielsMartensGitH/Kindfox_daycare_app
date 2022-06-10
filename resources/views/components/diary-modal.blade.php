@props([ 'id'])
<!-- Modal -->
  <div class="modal fade" id="diaryModal{{$id}}" tabindex="-1" aria-labelledby="editpostLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editpostLabel">Diary</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body m-2">
          <!-- diaryForm -->
          <form method="post" enctype="multipart/form-data" class="form-green-border p-4 m-0">
            @csrf
            @method('PUT')
                <div class="mb-3 row">
                    <div class="col form-floating m-2 p-4 green-border">
                        <!---FOOD MESSAGE-->
                        <div class="row">
                            <p class="kindfox-font-orange">What I ate?</p>
                            <textarea name="" id="" cols="30" rows="3"
                            placeholder="Today I ate all of my broccoli soup..."
                            formControlName="message_food"
                            #message_food>
                            </textarea>
                            <span *ngIf="!childDiaryForm.get('message_food')?.valid && childDiaryForm.get('message_food')?.touched" 
                            class="help-block">This field is required!</span>
                        </div>
                        <!---FOOD SMILEYS-->
                        <div class="d-flex d-row justify-content-center m-3">
                            <div class="kindfox-green-bg">
                                    <i class="fas fa-smile-beam" #food_smile
                                    appSmile
                                    (click)="smileIndFood = 'fas fa-smile-beam'">
                                    </i>
                                    <i class="fas fa-frown-open" #food_smile
                                    appSmile
                                        (click)="smileIndFood = 'fas fa-frown-open'"></i>
                            </div>
                        </div>
                    </div>
                    <!----SLEEP MESSAGE-->
                    <div class="col form-floating m-2 p-4 green-border">
                        <div class="row">
                            <p class="kindfox-font-orange">How I slept?</p>
                            <textarea name="" id="" cols="30" rows="3" 
                            placeholder="I slept for 2 hours from..."
                            formControlName="message_sleep"
                            #message_sleep></textarea>
                            <span *ngIf="!childDiaryForm.get('message_sleep')?.valid && childDiaryForm.get('message_sleep')?.touched" 
                            class="help-block">This field is required!</span>
                        </div>
                        <!---SLEEP SMILEYS-->
                        <div class="d-flex d-row justify-content-center m-3">
                            <div class="kindfox-green-bg">
                                <i class="fas fa-smile-beam" #sleep_smile
                                    appSmile
                                    (click)="smileIndSleep = 'fas fa-smile-beam'">
                                    </i>
                                    <i class="fas fa-frown-open" #sleep_smile
                                    appSmile
                                    (click)="smileIndSleep = 'fas fa-frown-open'"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <!----POT VISITS-->
                <div class="row kindfox-green-bg mt-3 mb-3 p-3">
                    <div class="col d-flex d-row">
                        <h5 class="mr-3">Pot visits</h5>
                        
                            <div class="col-auto">
                                <i class='fas fa-poo'
                                [ngClass]="{'brown-poop': poos[0] == true}" 
                                (click)="onPoop(0)"></i>
                                <i class='fas fa-poo'
                                [ngClass]="{'brown-poop': poos[1] == true}"  
                                (click)="onPoop(1)"></i>
                                <i class='fas fa-poo'
                                [ngClass]="{'brown-poop': poos[2] == true}"  
                                (click)="onPoop(2)"></i>
                                <i class='fas fa-poo'
                                [ngClass]="{'brown-poop': poos[3] == true}"  
                                (click)="onPoop(3)"></i>
                                <i class='fas fa-poo'
                                [ngClass]="{'brown-poop': poos[4] == true}"  
                                (click)="onPoop(4)"></i> 
                            </div>
                        
                    </div>
                </div>
                <!---WELL BEING-->
                <div class="row kindfox-green-bg mt-3 mb-3 p-3">
                    <div class="col d-flex d-row">
                        <h5>My well-being</h5>
                        <div class="form-check" *ngFor="let mood of moods; let i = index">
                            <label class="form-check-label" for="flexCheckDefault">
                                mood from loop
                              </label>
                            <input class="form-check-input" type="radio" name="mood" id="flexCheckDefault"
                            (click)="moodMsg = i">
                        </div>
                    </div>
                </div>
                <!----ACTIVITIES MESSAGE-->
                <div class="row green-border">
                    <div class="col form-floating m-3">
                        <p class="kindfox-font-orange">Activities</p>
                        <textarea class="text-style p-2" rows="3" 
                        placeholder="Puzzles"
                        formControlName="messageAct"
                        #messageAct></textarea>
                    </div>
                    <span *ngIf="!childDiaryForm.get('messageAct')?.valid && childDiaryForm.get('messageAct')?.touched" 
                            class="help-block">This field is required!</span>
                </div>
                <!---INVOLVEMENT-->
                <div class="row kindfox-green-bg mt-3 mb-3 p-3">
                    <div class="col">
                        <h5>Involvement</h5>
                        <div class="form-check" *ngFor="let inv of involvements; let i = index">
                            <label class="form-check-label" for="flexCheckDefault">
                                inv from loop
                              </label>
                            <input class="form-check-input" type="radio" name="inv" id="flexCheckDefault"
                            (click)="involvementMsg = i">
                        </div>
                    </div>
                </div>
                <!--MESSAGE TO THE PARENT-->
                <div class="row green-border">
                    <div class="col form-floating m-3">
                        <p class="kindfox-font-orange">Message to the parent</p>
                        <textarea class="text-style p-2" id="" rows="3" 
                        placeholder="Write here a message to the parent"
                        formControlName="extraMessage"
                        #extraMessage></textarea>
                    </div>
                    <span *ngIf="!childDiaryForm.get('extraMessage')?.valid && childDiaryForm.get('extraMessage')?.touched" 
                            class="help-block">This field is required!</span>
                </div>
                <button type="submit" class="btn btn-kindfox-primary m-3"
                data-bs-dismiss="modal"
                [disabled]="!childDiaryForm.valid"
                >Submit</button>
              </form>
        </div>
      </div>
    </div>
  </div>
