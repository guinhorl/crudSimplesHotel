<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//Configurações
$config['protocol'] = 'smtp';
$config['smtp_host'] = 'smtp.gmail.com';
$config['smtp_port'] = '587';
$config['smtp_timeout'] = '5';

//
$config['smtp_user'] = '';
$config['smtp_pass'] = '';
//
$config['charset'] = 'utf-8';
$config['newline'] = '\r\n';
$config['mailtype'] = 'html';
$config['validation'] = TRUE;
