<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Assignment</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Animate.css -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
  <style>
    /* Custom CSS for animations */
    .animate-delay-1s { animation-delay: 1s; }
    .animate-delay-2s { animation-delay: 2s; }
    .animate-delay-3s { animation-delay: 3s; }
  </style>
</head>

<body>

  <div class="container">
    <div class="row">
      <div class="col-md-8 offset-md-2 text-center animate__animated animate__fadeInDown">
        <h1 class="mt-5 animate__animated animate__bounceIn">Back-End Technical Assessment <br> PHP Back-End Software Engineer <br><br> WireApps Ltd
</h1>
        <p class="lead animate__animated animate__fadeInUp animate-delay-1s my-5">Please use the following link to preview the API doc for the application.</p>
        <a href="{{url('endpoints')}}" class="btn btn-primary btn-lg animate__animated animate__fadeInUp animate-delay-2s">Preview API Doc</a>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>