<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>{{ config('app.name', 'URL Shortener') }}</title>
<link rel="shortcut icon" href="{{ asset('assets/backend/img/back_icon.png') }}" type="image/x-icon"/>
<link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@300;400&family=Poppins:wght@400;500&display=swap" rel="stylesheet">
<link href="{{ asset('assets/frontend/css/bootstrap.min.css') }}" rel="stylesheet" >
<link href="{{ asset('assets/frontend/icofont/icofont.min.css') }}" rel="stylesheet" >
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet" >
<link href="{{ asset('assets/frontend/css/tom-select.css') }}" rel="stylesheet">
<link  href="{{ asset('assets/frontend/style.css')}}" rel="stylesheet">
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
