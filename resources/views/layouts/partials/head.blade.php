<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width initial-scale=1.0">
<title>{{ $pageTitle ?? 'Title' }} | {{ setting('site_title') ?? config('app.name') }}</title>
<link rel="shortcut icon" href="{{ asset('assets/backend/img/back_icon.png') }}" type="image/x-icon"/>
<!-- GLOBAL MAINLY STYLES-->
<link href="{{ asset('assets/backend/vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<link href="{{ asset('assets/backend/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/backend/vendors/themify-icons/css/themify-icons.css') }}" rel="stylesheet" />
<!-- PLUGINS STYLES-->
@stack('css')
<!-- THEME STYLES-->
<link href="{{ asset('assets/backend/css/main.min.css') }}" rel="stylesheet" />
<link href="{{ asset('css/iziToast.css') }}" rel="stylesheet">
<link href="{{ asset('assets/backend/custom.css') }}" rel="stylesheet" />
@stack('customCSS')
<!-- PAGE LEVEL STYLES-->
