<?php

$config['useragent']        = 'CodeIgniter';              // Mail engine switcher: 'CodeIgniter' or 'PHPMailer'
 
$config['protocol']         = 'smtp';                   // 'mail', 'sendmail', or 'smtp'
 
//$config['mailpath']         = '/usr/sbin/sendmail';
 
$config['smtp_host']        = 'surel.bussan.co.id';
 
$config['smtp_user']        = 'bafcard_c1@bussan.co.id';
 
$config['smtp_pass']        = 'Bussan1000';
 
$config['smtp_port']        = 25;
 
$config['smtp_timeout']     = 60;                        // (in seconds)
 
$config['smtp_crypto']      = 'tls';                    // '' or 'tls' or 'ssl'
 
$config['smtp_debug']       = 0;                        // PHPMailer's SMTP debug info level: 0 = off, 1 = commands, 2 = commands and data
 
$config['wordwrap']         = true;
 
$config['wrapchars']        = 76;
 
$config['mailtype']         = 'text';                   // 'text' or 'html'
 
$config['charset']          = 'utf-8';
 
$config['validate']         = true;
 
$config['priority']         = 3;                        // 1, 2, 3, 4, 5
 
$config['crlf']             = "\n";                     // "\r\n" or "\n" or "\r"
 
$config['newline']          = "\r\n";                     // "\r\n" or "\n" or "\r"
 
$config['bcc_batch_mode']   = false;
 
$config['bcc_batch_size']   = 200;