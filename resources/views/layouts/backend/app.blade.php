
<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.backend.head')
</head>

<body>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      @include('layouts.backend.nav')


      @include('layouts.backend.sidebar')

      @yield('content')

    </div>
  </div>
  @include('layouts.backend.script')
</body>
</html>
