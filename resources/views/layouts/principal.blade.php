<!DOCTYPE html>
<html>
	<head>
		<?php
			if (strstr($_SERVER["SERVER_ADDR"], "127.0.0.1")) {
				$base = "localhost";
			} else {
				$base = $_SERVER["SERVER_ADDR"];
			}
		?>
		<base href="//<?php echo $base ?>/DoctorFinder/">
		<meta name="viewport" content="width=device-width" />
	 	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link rel="stylesheet" href="public/css/app.css">
		<link rel="stylesheet" href="public/css/foundation-icons/foundation-icons.css" />
		<link rel="stylesheet" type="text/css" href="public/css/foundation.css">
		<link href="//fonts.googleapis.com/css?family=Montserrat|Open+Sans" rel="stylesheet">
		<meta name="_token" content="{!! csrf_token() !!}"/>
		@yield('titulo')
	</head>

		@yield('conteudo')
		<script src="//use.fontawesome.com/62804cfb0c.js"></script>
		<script src="public/js/jquery.js"></script>
		<script src="public/js/foundation.js"></script>
		<script src="public/js/what-input.js"></script>
		<script src="public/js/jquerymask.js"></script>


		</script>
		@yield('scripts')
</html>
