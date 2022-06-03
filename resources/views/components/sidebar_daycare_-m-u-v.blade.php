
    <!-- this is where the user can see all info about their daycare on the right sidebar -->
    <div class="row mx-1">
        <div class="col-md-12">
            @yield('daycareinfo')
            <h4 class="my-2">my daycare</h4>
            <div class="card daycare-contact">
                <div class="card-body p-4">
                    <h5 class="card-title text-center"> companyname here </h5>
                    <div class="card-text">
                        <div class="d-flex justify-content-center">
                            <img src='./../assets/img/daycarerainbow_avatar.jpg' alt="" width='165px'>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button class="my-1 btn btn-kindfox-warning" data-bs-toggle="modal" data-bs-target="#exampleModal">Contact</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title" id="exampleModalLabel"> company name here</h3>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
            <div class="row d-flex justify-content-center">
            <div class="col-sm-3 mx-3 p-3 border">
                <h3>Address</h3>
                <div> street adress here</div>
                <div> city and postalcode here</div>
            </div>
            <div class="col-sm-3 p-3 mx-3 border">
                <h3>Contact</h3>
                <div>email here</div>
                <div>phone here</div>
            </div>
            </div>
            <div class="row">
            <div class="col-sm-12">
                <div class="my-3 d-flex justify-content-center">
                <div class="mapouter"><div class="gmap_canvas"><iframe width="800" height="500" id="gmap_canvas" src="https://maps.google.com/maps?q=thor%20genk&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://fmovies-online.net"></a><br><style>.mapouter{position:relative;text-align:right;height:500px;width:600px;}</style><a href="https://www.embedgooglemap.net">show google maps on website</a><style>.gmap_canvas {overflow:hidden;background:none!important;height:500px;width:600px;}</style></div></div>
                </div>
            </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
</div>
