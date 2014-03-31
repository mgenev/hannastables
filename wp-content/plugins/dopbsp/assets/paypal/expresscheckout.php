<?php

/*
* Title                   : Booking System PRO (WordPress Plugin)
* Version                 : 1.2
* File                    : expresscheckout.php
* File Version            : 1.2
* Created / Last Modified : 01 November 2012
* Author                  : Marius-Cristian Donea
* Copyright               : © 2011 Marius-Cristian Donea
* Website                 : http://www.mariuscristiandonea.com
* Description             : PayPal Express Checkout script.
*/

    if (session_id() == ""){
        session_start();
    }

    // ==================================
    // PayPal Express Checkout Module
    // ==================================
    
    $cID = $_POST['DOPBookingSystemPRO_ID'];
    
    $_SESSION['DOPBSP_Page'] = $_POST['DOPBookingSystemPRO_Page'.$cID];
    $_SESSION['DOPBSP_PluginURL'] = $_POST['DOPBookingSystemPRO_PluginURL'.$cID];
    $_SESSION['DOPBSP_CalendarID'] = $cID;   
    $_SESSION['DOPBSP_PriceItemValue'] = $_POST['DOPBookingSystemPRO_PriceItemValue'.$cID]; 
    $_SESSION['DOPBSP_PriceValue'] = $_POST['DOPBookingSystemPRO_PriceValue'.$cID]; 
    $_SESSION['DOPBSP_DiscountValue'] = $_POST['DOPBookingSystemPRO_DiscountValue'.$cID]; 
    $_SESSION['DOPBSP_PriceToPayValue'] = $_POST['DOPBookingSystemPRO_PriceToPayValue'.$cID]; 
    $_SESSION['DOPBSP_PriceDepositValue'] = $_POST['DOPBookingSystemPRO_PriceDepositValue'.$cID]; 
    $_SESSION['Payment_Amount'] = $_POST['DOPBookingSystemPRO_PriceDepositValue'.$cID] != 0 ? $_POST['DOPBookingSystemPRO_PriceDepositValue'.$cID]:$_POST['DOPBookingSystemPRO_PriceToPayValue'.$cID];
    $_SESSION['DOPBSP_Currency'] = $_POST['DOPBookingSystemPRO_Currency'.$cID];
    $_SESSION['DOPBSP_CurrencyCode'] = $_POST['DOPBookingSystemPRO_CurrencyCode'.$cID];
        
    $_SESSION['DOPBSP_CheckIn'] = isset($_POST['DOPBookingSystemPRO_CheckIn'.$cID]) ? $_POST['DOPBookingSystemPRO_CheckIn'.$cID]:'';
    $_SESSION['DOPBSP_CheckOut'] = isset($_POST['DOPBookingSystemPRO_CheckOut'.$cID]) ? $_POST['DOPBookingSystemPRO_CheckOut'.$cID]:'';    
    $_SESSION['DOPBSP_StartHour'] = isset($_POST['DOPBookingSystemPRO_StartHour'.$cID]) ? $_POST['DOPBookingSystemPRO_StartHour'.$cID]:'';
    $_SESSION['DOPBSP_EndHour'] = isset($_POST['DOPBookingSystemPRO_EndHour'.$cID]) ? $_POST['DOPBookingSystemPRO_EndHour'.$cID]:'';
    $_SESSION['DOPBSP_NoItems'] = isset($_POST['DOPBookingSystemPRO_NoItems'.$cID]) ? $_POST['DOPBookingSystemPRO_NoItems'.$cID]:'';
         
    $_SESSION['DOPBSP_FirstName'] = isset($_POST['DOPBookingSystemPRO_FirstName'.$cID]) ? $_POST['DOPBookingSystemPRO_FirstName'.$cID]:'';
    $_SESSION['DOPBSP_LastName'] = isset($_POST['DOPBookingSystemPRO_LastName'.$cID]) ? $_POST['DOPBookingSystemPRO_LastName'.$cID]:'';
    $_SESSION['DOPBSP_Email'] = isset($_POST['DOPBookingSystemPRO_Email'.$cID]) ? $_POST['DOPBookingSystemPRO_Email'.$cID]:'';
    $_SESSION['DOPBSP_Phone'] = isset($_POST['DOPBookingSystemPRO_Phone'.$cID]) ? $_POST['DOPBookingSystemPRO_Phone'.$cID]:'';
    $_SESSION['DOPBSP_NoPeople'] = isset($_POST['DOPBookingSystemPRO_NoPeople'.$cID]) ? $_POST['DOPBookingSystemPRO_NoPeople'.$cID]:'';
    $_SESSION['DOPBSP_NoChildren'] = isset($_POST['DOPBookingSystemPRO_NoChildren'.$cID]) ? $_POST['DOPBookingSystemPRO_NoChildren'.$cID]:'';
    $_SESSION['DOPBSP_Message'] = isset($_POST['DOPBookingSystemPRO_Message'.$cID]) ? $_POST['DOPBookingSystemPRO_Message'.$cID]:'';                    
    
    require_once("paypalfunctions.php");
    
    //'------------------------------------
    //' The paymentAmount is the total value of 
    //' the shopping cart, that was set 
    //' earlier in a session variable 
    //' by the shopping cart page
    //'------------------------------------
    $paymentAmount = $_SESSION["Payment_Amount"];
    
    //'------------------------------------
    //' The currencyCodeType and paymentType 
    //' are set to the selections made on the Integration Assistant 
    //'------------------------------------
    $currencyCodeType = $_SESSION["DOPBSP_CurrencyCode"];
    $paymentType = "Sale";

    //'------------------------------------
    //' The returnURL is the location where buyers return to when a
    //' payment has been succesfully authorized.
    //'
    //' This is set to the value entered on the Integration Assistant 
    //'------------------------------------
    $returnURL = $_SESSION['DOPBSP_PluginURL'].'assets/paypal/book-confirmation.php';

    //'------------------------------------
    //' The cancelURL is the location buyers are sent to when they hit the
    //' cancel button during authorization of payment during the PayPal flow
    //'
    //' This is set to the value entered on the Integration Assistant 
    //'------------------------------------
    $cancelURL = $_SESSION["DOPBSP_Page"];

    //'------------------------------------
    //' Calls the SetExpressCheckout API call
    //'
    //' The CallShortcutExpressCheckout function is defined in the file PayPalFunctions.php,
    //' it is included at the top of this file.
    //'-------------------------------------------------
    
    $resArray = CallShortcutExpressCheckout($paymentAmount, $currencyCodeType, $paymentType, $returnURL, $cancelURL);
    $ack = strtoupper($resArray["ACK"]);
        
    if($ack=="SUCCESS" || $ack=="SUCCESSWITHWARNING"){
	RedirectToPayPal($resArray["TOKEN"]);
    } 
    else{
	//Display a user friendly Error on the page using any of the following error information returned by PayPal
	$ErrorCode = urldecode($resArray["L_ERRORCODE0"]);
	$ErrorShortMsg = urldecode($resArray["L_SHORTMESSAGE0"]);
	$ErrorLongMsg = urldecode($resArray["L_LONGMESSAGE0"]);
	$ErrorSeverityCode = urldecode($resArray["L_SEVERITYCODE0"]);
	
	echo "SetExpressCheckout API call failed.<br/>";
	echo "Detailed Error Message: ".$ErrorLongMsg."<br/>";
	echo "Short Error Message: ".$Error."<br/>";;
	echo "Error Severity Code: ".$ErrorSeverityCode."<br/>";
    }
    
?>