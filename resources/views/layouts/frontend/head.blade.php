<title>{{ $config->name }}</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="csrf-token" content="{{ csrf_token() }}">

<link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Amatic+SC:400,700&display=swap" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
    integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
    crossorigin="anonymous" />
<link rel="icon" href="{{ asset('backend/configuration/' . $config->icon) }}">

<link rel="stylesheet" href="{{ asset('frontend') }}/css/open-iconic-bootstrap.min.css">
<link rel="stylesheet" href="{{ asset('frontend') }}/css/animate.css">

<link rel="stylesheet" href="{{ asset('frontend') }}/css/owl.carousel.min.css">
<link rel="stylesheet" href="{{ asset('frontend') }}/css/owl.theme.default.min.css">
<link rel="stylesheet" href="{{ asset('frontend') }}/css/magnific-popup.css">

<link rel="stylesheet" href="{{ asset('frontend') }}/css/aos.css">

<link rel="stylesheet" href="{{ asset('frontend') }}/css/ionicons.min.css">

<link rel="stylesheet" href="{{ asset('frontend') }}/css/bootstrap-datepicker.css">
<link rel="stylesheet" href="{{ asset('frontend') }}/css/jquery.timepicker.css">

<link rel="stylesheet" href="{{ asset('frontend') }}/css/flaticon.css">
<link rel="stylesheet" href="{{ asset('frontend') }}/css/icomoon.css">
<link rel="stylesheet" href="{{ asset('frontend') }}/css/style.css">
<link rel="stylesheet" href="{{ asset('frontend') }}/css/toast.css">
@stack('paginate')
