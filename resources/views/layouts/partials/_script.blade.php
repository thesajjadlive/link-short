<!-- CORE PLUGINS-->
<script src="{{ asset('/assets/backend/vendors/jquery/dist/jquery.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('/assets/backend/vendors/popper.js/dist/umd/popper.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('/assets/backend/vendors/bootstrap/dist/js/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('/assets/backend/vendors/metisMenu/dist/metisMenu.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('/assets/backend/vendors/jquery-slimscroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
<!-- PAGE LEVEL PLUGINS-->
@stack('js')
<!-- CORE SCRIPTS-->
<script src="{{ asset('assets/backend/js/app.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/iziToast.js') }}"></script>
@stack('customJS')
<!-- PAGE LEVEL SCRIPTS-->
