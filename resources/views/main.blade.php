<!DOCTYPE html>
<html lang="en">
<head>
  <title>File manager</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
</head>
<body>
  
<div class="container p-4">
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Main</h5>
      <div class="row">
        <div class="col-3">
          <div class="card">
            <div class="card-body">
              @yield('sidebar')
            </div>
          </div>
        </div>
        <div class="col-9">
          <div class="card">
            <div class="card-body">
             @yield('content')
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

</body>
</html>
