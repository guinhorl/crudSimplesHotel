<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PHPMailer\PHPMailer\PHPMailer;
class Phpmailer_library
{

	public function __construct()
	{
		log_message('Debug', 'PHPMailer class is loaded.');
	}

	public function load()
	{
		/*require_once(APPPATH."third_party/phpmailer/PHPMailerAutoload.php");*/
		require_once(APPPATH.'third_party/phpmailer/Exception.php');
		require_once(APPPATH.'third_party/phpmailer/PHPMailer.php');
		require_once(APPPATH.'third_party/phpmailer/SMTP.php');

		$mail = new PHPMailer(true);
		return $mail;

	}
}
