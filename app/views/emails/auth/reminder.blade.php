<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>Cambiar Contraseña</h2>

		<div>
			Para cambiar tu contraseña completa este formulario: {{ URL::to('password/reset', array($token)) }}.<br/>
			Este link expera en {{ Config::get('auth.reminder.expire', 60) }} minutos.
		</div>
	</body>
</html>
