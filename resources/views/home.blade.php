<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ mix('css/app.css')}}">
		<title>{{ config("app.name") }}</title>
	</head>
	<body>
        <a href="https://github.com/anjaraeu/rcgp">
            <img style="position: absolute; top: 0; right: 0; border: 0;" src="/img/forkme.png" alt="Fork me on GitHub" data-canonical-src="/img/forkme2.png">
        </a>
        <script src="{{ mix('js/app.js')}}" defer></script>
	</body>
</html>
