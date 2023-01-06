<meta charset="UTF-8">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>{{ $config->name }}</title>

<!-- General CSS Files -->
@stack('head')
<link rel="icon" href="{{ asset('backend/configuration/' . $config->icon) }}">
<link rel="stylesheet" href="{{ asset('backend') }}/assets/modules/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="{{ asset('backend') }}/assets/modules/fontawesome/css/all.min.css">
<!-- CSS Libraries -->

<!-- Template CSS -->
<link rel="stylesheet" href="{{ asset('backend') }}/assets/css/style.css">
<link rel="stylesheet" href="{{ asset('backend') }}/assets/css/components.css">
<!-- Start GA -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'UA-94034622-3');
</script>
<!-- /END GA -->
