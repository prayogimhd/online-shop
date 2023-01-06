<script src="{{ asset('frontend') }}/js/jquery.min.js"></script>
<script src="{{ asset('frontend') }}/js/jquery-migrate-3.0.1.min.js"></script>
<script src="{{ asset('frontend') }}/js/popper.min.js"></script>
<script src="{{ asset('frontend') }}/js/bootstrap.min.js"></script>
<script src="{{ asset('frontend') }}/js/jquery.easing.1.3.js"></script>
<script src="{{ asset('frontend') }}/js/jquery.waypoints.min.js"></script>
<script src="{{ asset('frontend') }}/js/jquery.stellar.min.js"></script>
<script src="{{ asset('frontend') }}/js/owl.carousel.min.js"></script>
<script src="{{ asset('frontend') }}/js/jquery.magnific-popup.min.js"></script>
<script src="{{ asset('frontend') }}/js/aos.js"></script>
<script src="{{ asset('frontend') }}/js/jquery.animateNumber.min.js"></script>
<script src="{{ asset('frontend') }}/js/bootstrap-datepicker.js"></script>
<script src="{{ asset('frontend') }}/js/scrollax.min.js"></script>
{{-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script> --}}
{{-- <script src="{{ asset('frontend') }}/js/google-map.js"></script> --}}
<script src="{{ asset('frontend') }}/js/main.js"></script>
<script src="{{ asset('frontend') }}/script/home.js"></script>
{{-- <script src="{{ asset('frontend') }}/script/order.js"></script> --}}
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ $client_key }}"></script>
@if (Session::has('success'))
    <script>
        toastr.success("{{ Session::get('success') }}");
    </script>
    @elseif (Session::has('warning'))
    <script>
        toastr.warning("{{ Session::get('warning') }}");
    </script>
    @elseif (Session::has('error'))
    <script>
        toastr.error("{{ Session::get('error') }}");
    </script>
@endif
@stack('js')
