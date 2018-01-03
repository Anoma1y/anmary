<?php
	class Contacts {
		public function index() {
       		require_once('views/contacts/index.php');
	        return true;
		}
		public function sendEmail() {
			$info = include('engine/info.php');
			if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {
				if (!empty($_POST)) {
					$name = $_POST['name'];
					$email = $_POST['email'];
					$message = $_POST['text'];
					$formcontent="Имя: $name \nСообщение: $message\nПочта: $email";
					$recipient = $info["email"];
					$subject = "Contact Form";
					$mailheader = "От: $email \r\n";
					mail($recipient, $subject, $formcontent, $mailheader) or die("Error!");	
				}
			} 
			die();
		}
	}
