<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home - Blogs</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">
  {{-- Navbar --}}
  @include('parts.navbar')

  {{-- Main content area --}}
  <main class="flex-grow-1">
      @yield('content')
  </main>

  {{-- Footer --}}
  @include('parts.footer')
  
  {{--Jquery CDN to make pusher defined--}}
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  {{--using pusher--}}
  <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
  <script>
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

    var pusher = new Pusher('c0964976905523a7b42b', {
      cluster: 'mt1'
    });
  </script>
  <script src="{{asset('js/pusherNotifications.js')}}"></script>
</body>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script> 
</html>