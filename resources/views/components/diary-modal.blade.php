@props([ 'id'])
<!-- Modal -->
  <div class="modal fade" id="diaryModal{{$id}}" tabindex="-1" aria-labelledby="editpostLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header kindfox-green-bg">
         <img src="../../assets/img/Kindfoxlogowhite.png" width="150px" class="logo">
          <h5 class="modal-title" id="editpostLabel">Diary</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body m-2">
          <!-- diaryForm -->
          <form method="post" enctype="multipart/form-data" class="form-green-border p-4 m-0" id="diaryForm">
            
                <div class="mb-3 row">
                    <div class="col form-floating m-2 p-4 green-border">
                        <!---FOOD MESSAGE-->
                        <div class="row">
                            <p class="kindfox-font-orange">What I ate?</p>
                            <textarea name="food_message" id="message_food" cols="30" rows="3"
                            placeholder="Today I ate all of my broccoli soup..."
                            >
                            </textarea>
                            
                        </div>
                        <!---FOOD SMILEYS-->
                        <div class="d-flex d-row justify-content-center m-3">
                            <div class="kindfox-green-bg">
                                    <i class="fas fa-smile-beam" value="1" name="food_smile"></i>
                                    <i class="fas fa-frown-open" value="0" name="food_smile"></i>
                            </div>
                        </div>
                    </div>
                    <!----SLEEP MESSAGE-->
                    <div class="col form-floating m-2 p-4 green-border">
                        <div class="row">
                            <p class="kindfox-font-orange">How I slept?</p>
                            <textarea name="sleep_message" id="sleep_message" cols="30" rows="3" 
                            placeholder="I slept for 2 hours from..."
                            name="message_sleep"
                            ></textarea>
                           
                        </div>
                        <!---SLEEP SMILEYS-->
                        <div class="d-flex d-row justify-content-center m-3">
                            <div class="kindfox-green-bg">
                                <i class="fas fa-smile-beam" name="sleep_smile" value="1"></i>
                                <i class="fas fa-frown-open" name="sleep_smile" value="0"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <!----POT VISITS-->
                <div class="row kindfox-green-bg mt-3 mb-3 p-3">
                    <div class="container">
                        <div class="row">
                            <h5 class="mr-3">Pot visits</h5>
                        </div>
                        <input type="hidden" id="poops" name="poop_icons" value="">
                        <div class="row">
                            <div class="col-auto">
                                <i class='fas fa-poo'
                                id="1"></i>
                                <i class='fas fa-poo'
                                id="2"></i>
                                <i class='fas fa-poo'
                                id="3"></i>
                                <i class='fas fa-poo'
                                id="4"></i>
                                <i class='fas fa-poo'
                                id="5" 
                                ></i>
                            </div>
                        </div>
                    </div>
                </div>
                <!---WELL BEING-->
                <div class="row kindfox-green-bg mt-3 mb-3 p-3">
                    <div class="container">
                        <div class="row">
                        <h5>My well-being</h5>
                        </div>
                        <div class="d-flex d-row justify-content-start">
                            <div class="form-check m-3">
                                <label class="form-check-label" for="very good">
                                VERY GOOD
                                </label>
                                <input class="form-check-input" type="radio" name="mood" value="very good" id="very good">
                            </div>
                            <div class="form-check m-3">
                                <label class="form-check-label" for="good">
                                GOOD
                                </label>
                                <input class="form-check-input" type="radio" name="mood" value="good" id="good">
                            </div>
                            <div class="form-check m-3">
                                <label class="form-check-label" for="not so good">
                                NOT SO GOOD
                                </label>
                                <input class="form-check-input" type="radio" name="mood" value="not so good" id="not so good">
                            </div>
                            <div class="form-check m-3">
                                <label class="form-check-label" for="bad">
                                BAD
                                </label>
                                <input class="form-check-input" type="radio" name="mood" value="bad" id="bad">
                            </div>
                        </div>
                    </div>
                </div>
                <!----ACTIVITIES MESSAGE-->
                <div class="row green-border">
                    <div class="col form-floating m-3">
                        <p class="kindfox-font-orange">Activities</p>
                        <textarea class="text-style p-2" 
                        placeholder="Puzzles"
                        name="activity_message"
                        id="activity_message"></textarea>
                    </div>
                </div>
                <!---INVOLVEMENT-->
                <div class="row kindfox-green-bg mt-3 mb-3 p-3">
                    <div class="col">
                        <h5>Involvement</h5>
                        <div class="form-check">
                            <label class="form-check-label" for="I am often very interested">
                            I am often very interested
                              </label>
                            <input class="form-check-input" type="radio" name="involvement_message" id="I am often very interested" value="I am often very interested">
                        </div>
                        <div class="form-check">
                            <label class="form-check-label" for="I am sometimes involved">
                            I am sometimes involved
                              </label>
                            <input class="form-check-input" type="radio" name="involvement_message" id="I am sometimes involved" value="I am sometimes involved">
                        </div>
                        <div class="form-check">
                            <label class="form-check-label" for="I find it hard to play">
                            I find it hard to play
                              </label>
                            <input class="form-check-input" type="radio" name="involvement_message" id="I find it hard to play" value="I find it hard to play">
                        </div>
                        <div class="form-check">
                            <label class="form-check-label" for="I am lost in the game">
                            I am lost in the game
                              </label>
                            <input class="form-check-input" type="radio" name="involvement_message" id="I am lost in the game" value="I am lost in the game">
                        </div>
                    </div>
                </div>
                <!--MESSAGE TO THE PARENT-->
                <div class="row green-border">
                    <div class="col form-floating m-3">
                        <p class="kindfox-font-orange">Message to the parent</p>
                        <textarea class="text-style p-2" id="extraMessage"
                        placeholder="Write here a message to the parent"
                        name="extra_message"></textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-kindfox-primary m-3"
                data-bs-dismiss="modal"
                >Submit</button>
              </form>
        </div>
      </div>
    </div>
  </div>

