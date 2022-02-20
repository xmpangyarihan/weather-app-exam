<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Japan Travel Information</title>
	<link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">

	<style type="text/css">
		body{
			background-color: #F0E6FA;
		}
		#weatherInfo{
			background-image: url("{{ asset('images/weatherbg.jpg') }}");
			background-repeat: no-repeat;
			background-size: cover;
		}
		#placeInfo{
			background-image: url("{{ asset('images/placebg.jpg') }}");
			background-repeat: no-repeat;
			background-size: cover;
		}
		.card-body-2{
			background-color: rgba(45, 46, 45, 0.4);
			margin: 20px;
		}
	</style>
</head>
<body>
	<br />
	<div id="app">
		<home />
	</div>
</body>
<script src="{{ asset('js/app.js') }}"></script>
</html>