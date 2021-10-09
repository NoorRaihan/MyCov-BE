<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CoreUI for Bootstrap CSS -->
    <link rel="stylesheet" href="https://unpkg.com/@coreui/coreui/dist/css/coreui.min.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <title>{{ config('app.name', 'Laravel') }}</title>
  </head>
  <body class="c-app">
    @include('dashboard.sidenav')

    <div class="wrapper d-flex flex-column min-vh-100 bg-light dark:bg-transparent">
        <header class="header header-sticky mb-4">
        <div class="container-fluid">
        
        </div>
        </header>
        <div class="body flex-grow-1 px-3">
        <div class="container-lg">
            @yield('content')
        </div>
        </div>
        <footer class="footer">
        <div><a href="https://coreui.io">CoreUI</a> © 2021 creativeLabs.</div>
        <div class="ms-auto">Powered by&nbsp;<a href="https://coreui.io/pro/">CoreUI PRO</a></div>
        </footer>
        </div>
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://unpkg.com/@coreui/coreui/dist/js/coreui.min.js"></script>
  </body>
</html>
</body>
</html> --}}
