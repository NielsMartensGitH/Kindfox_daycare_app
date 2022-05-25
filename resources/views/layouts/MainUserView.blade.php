<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link href="{{ asset('assets/css/Main.css') }} " rel="stylesheet">
<!-- this is the navbar of the messageboard -->
</head>
<body>
<div id="navbar_MUV">
  <x-navbar_-m-u-v/>
</div>

<!-- everything below the navbar -->
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-10 contentarea">
        <!-- our main component with the posts  -->
        @yield('content')
        <img src="./../assets/img/profielfotoNiels.jpg" alt="" width= 1000px>
      </div>
        <div class="sidebar side-nav col-sm-2">
        <!-- our sidebar on the right of the page -->
          <x-sidebar_-m-u-v/>
        </div>
    </div>
  </div>
</body>
</html>

