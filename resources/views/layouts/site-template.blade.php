<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
		
		<title>
			SINPROSERMUCARU | @yield('title')</title>
		</title>

		<link href="https://fonts.googleapis.com/css?family=Encode+Sans+Expanded:400,600,700" rel="stylesheet">
		<link href="{{ asset('site/plugin-frameworks/bootstrap.css') }}" rel="stylesheet">
		<link href="{{ asset('site/fonts/ionicons.css') }}" rel="stylesheet">
		<link href="{{ asset('site/common/styles.css') }}" rel="stylesheet">
		<link rel="shortcut icon" href="{{asset('assets/img/favicon.ico')}}"/>
		
		@yield('css')
		
		<script src="{{ asset('assets/js/recaptcha.js') }}" async defer></script>
	</head>
<body>

	@include('site.partials.menu_superior')

	@yield('content')

	@include('site.partials.rodape')

	<script src="{{ asset('site/plugin-frameworks/jquery-3.2.1.min.js') }}"></script>
	<script src="{{ asset('site/plugin-frameworks/tether.min.js') }}"></script>
	<script src="{{ asset('site/plugin-frameworks/bootstrap.js') }}"></script>
	<script src="{{ asset('site/common/scripts.js') }}"></script>

	<script type="text/javascript">
		$('.carousel').carousel({
			interval: 2000
		})
	</script>

	@yield('script-inferior')

</body>
</html>
