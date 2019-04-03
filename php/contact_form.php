<?php

	$to = 'abogadarussi@gmail.com, ambigus9@gmail.com, contacto@russiabogados.com';  // please change this email id
	
	$errors = array();
	// print_r($_POST);

	// Check if name has been entered
	if (!isset($_POST['name'])) {
		$errors['name'] = 'Por favor ingrese su nombre';
	}
	
	// Check if email has been entered and is valid
	if (!isset($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
		$errors['email'] = 'Por favor ingrese un correo electrónico válido';
	}
	
	//Check if message has been entered
	if (!isset($_POST['message'])) {
		$errors['message'] = 'Por favor ingrese un mensaje';
	}

	//Check if phone has been entered
	if (!isset($_POST['phone'])) {
		$errors['phone'] = 'Por favor ingrese un teléfono';
	}

	$errorOutput = '';

	if(!empty($errors)){

		$errorOutput .= '<div class="alert alert-danger alert-dismissible" role="alert">';
 		$errorOutput .= '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';

		$errorOutput  .= '<ul>';

		foreach ($errors as $key => $value) {
			$errorOutput .= '<li>'.$value.'</li>';
		}

		$errorOutput .= '</ul>';
		$errorOutput .= '</div>';

		echo $errorOutput;
		die();
	}



	$name = $_POST['name'];
	$email = $_POST['email'];
	$message = $_POST['message'];
	$phone = $_POST['phone'];
	$from = $email;
	$subject = 'Nuevo mensaje de Contacto para Russiabogados';
	$headers = 'From: contacto@russiabogados.com' . "\r\n" .
    'Reply-To: '.$_POST['email']. "\r\n" .
    'X-Mailer: PHP/' . phpversion();

	$body = "Cliente: $name\nCorreo: $email\nTelefono: $phone\nMensaje:\n$message";


	//send the email
	$result = '';
	if (mail ($to, $subject, $body, $headers)) {
		$result .= '<div class="alert alert-success alert-dismissible" role="alert">';
 		$result .= '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
		$result .= 'Gracias!! Hemos recibido tu mensaje, y nos pondremos en contacto contigo tan pronto sea posible';
		$result .= '</div>';

		echo $result;
		die();
	}

	$result = '';
	$result .= '<div class="alert alert-danger alert-dismissible" role="alert">';
	$result .= '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
	$result .= 'Ha habido un error enviando el mensaje. Porfavor, intente nuevamente';
	$result .= '</div>';

	echo $result;
	die();


?>