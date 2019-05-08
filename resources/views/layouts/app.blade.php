<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="{{ mix('css/app.css')}}">
        <meta name="csrf-token" content="{{ csrf_token() }}">
		<title>{{ config("app.name") }}</title>
	</head>
	<body>
        <div id="app">
            @yield('content')
        </div>

        <script src="{{ mix('js/app.js')}}" defer></script>
	</body>
</html>
