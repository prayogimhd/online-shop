<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.frontend.head')
</head>

<body class="goto-here">

    @include('layouts.frontend.nav')
    <!-- END nav -->

    @yield('content')

    @include('layouts.frontend.footer')




    <!-- loader -->
    <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
            <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4"
                stroke="#eeeeee" />
            <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4"
                stroke-miterlimit="10" stroke="#F96D00" />
        </svg></div>
    @include('layouts.frontend.script')

</body>

</html>
