<?php

/*
* Title                   : Booking System Pro (WordPress Plugin)
* Version                 : 1.2
* File                    : dopbsp-backend.php
* File Version            : 1.1
* Created / Last Modified : 01 November 2012
* Author                  : Marius-Cristian Donea
* Copyright               : © 2012 Marius-Cristian Donea
* Website                 : http://www.mariuscristiandonea.com
* Description             : Booking System PRO Email Class.
*/

    require("libraries/php/smtp/smtp.php");
    require("libraries/php/smtp/sasl.php");
    
    if (!class_exists("DOPBookingSystemPROEmail")){
        class DOPBookingSystemPROEmail{
            function DOPBookingSystemPROEmail(){
            }
            
            function sendEmail($email_to,
                               $email_from,
                               $subject,
                               $message){
                $headers = "Content-type: text/html; charset=utf-8"."\r\n".
                           "MIME-Version: 1.1"."\r\n".
                           "From:".$email_from."\r\n".
                           "Reply-To:".$email_from;

                mail($email_to, $subject, $message, $headers);
            }
            
            function sendSMTPEmail($email_to,
                                   $email_from,
                                   $subject,
                                   $message,
                                   $host_name,
                                   $host_port,
                                   $ssl,
                                   $user,
                                   $password){
                $smtp = new smtp_class;
                
                $smtp->host_name = $host_name;        // IP address Change this variable to the address of the SMTP server to relay, like "smtp.myisp.com"
                $smtp->host_port = $host_port;        // Change this variable to the port of the SMTP server to use, like 465
                $smtp->ssl = $ssl;                    // Change this variable if the SMTP server requires an secure connection using SSL
                $smtp->start_tls = 0;                 // Change this variable if the SMTP server requires security by starting TLS during the connection
                $smtp->localhost = "localhost";       // Your computer address
                $smtp->direct_delivery = 0;           // Set to 1 to deliver directly to the recepient SMTP server
                $smtp->timeout = 10;                  // Set to the number of seconds wait for a successful connection to the SMTP server
                $smtp->data_timeout = 0;              // Set to the number seconds wait for sending or retrieving data from the SMTP server. Set to 0 to use the same defined in the timeout variable
                $smtp->debug = 1;                     // Set to 1 to output the communication with the SMTP server
                $smtp->html_debug = 1;                // Set to 1 to format the debug output as HTML
                $smtp->pop3_auth_host = "";           // Set to the POP3 authentication host if your SMTP server requires prior POP3 authentication
                $smtp->user = $user;                  // Set to the user name if the server requires authetication
                $smtp->realm = "";                    // Set to the authetication realm, usually the authentication user e-mail domain
                $smtp->password = $password;          // Set to the authetication password
                $smtp->workstation = "";              // Workstation name for NTLM authentication
                $smtp->authentication_mechanism="";   // Specify a SASL authentication method like LOGIN, PLAIN, CRAM-MD5, NTLM, etc... Leave it empty to make the class negotiate if necessary

                if($smtp->SendMessage($email_from,
                                      array($email_to),
                                      array("MIME-Version: 1.0",
                                            "Content-type: text/html; charset=iso-8859-1",
                                            "From: $email_from",
                                            "To: $email_to",
                                            "Subject: $subject",
                                            "Date: ".strftime("%a, %d %b %Y %H:%M:%S %Z")),
                                      "$message")){
                    //echo "Message sent to $email_to OK.\n"; 
                }
                else{
                    echo "Cound not send the message to $email_to.\nError: ".$smtp->error."\n";
                }
            }
            
            function message($message, 
                             $ids, 
                             $date, 
                             $price, 
                             $form, 
                             $file){
                $content = file_get_contents($file);
                
                $content = str_replace('{MESSAGE}', $message, $content);
                $content = str_replace('{IDS_DATA}', $ids, $content);
                $content = str_replace('{DATE_DATA}', $date, $content);
                $content = str_replace('{PRICE_DATA}', $price, $content);
                $content = str_replace('{FORM_DATA}', $form, $content);

                return $content;
            }
        }
    }
        
?>