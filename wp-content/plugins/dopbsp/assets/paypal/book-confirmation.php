<?php

/*
* Title                   : Booking System PRO (WordPress Plugin)
* Version                 : 1.2
* File                    : book-confirmation.php
* File Version            : 1.2
* Created / Last Modified : 01 November 2012
* Author                  : Marius-Cristian Donea
* Copyright               : © 2011 Marius-Cristian Donea
* Website                 : http://www.mariuscristiandonea.com
* Description             : PayPal Book Confirmation script.
*/

    // ==================================================================
    //    PayPal Express Checkout Call
    // ===================================================================
    
    require_once ("paypalfunctions.php");
    $PaymentOption = "PayPal";
    
    if ($PaymentOption == "PayPal"){
	/*
	'------------------------------------
	' The paymentAmount is the total value of 
	' the shopping cart, that was set 
	' earlier in a session variable 
	' by the shopping cart page
	'------------------------------------
	*/
        
        $DOPBSP_Page = $_SESSION['DOPBSP_Page'];
        $DOPBSP_PluginURL = $_SESSION['DOPBSP_PluginURL'];
        $DOPBSP_CalendarID = $_SESSION['DOPBSP_CalendarID'];
        $DOPBSP_PriceItemValue = $_SESSION['DOPBSP_PriceItemValue'];
        $DOPBSP_PriceValue = $_SESSION['DOPBSP_PriceValue']; 
        $DOPBSP_DiscountValue = $_SESSION['DOPBSP_DiscountValue']; 
        $DOPBSP_PriceToPayValue = $_SESSION['DOPBSP_PriceToPayValue']; 
        $DOPBSP_PriceDepositValue = $_SESSION['DOPBSP_PriceDepositValue']; 
	$finalPaymentAmount = $_SESSION["Payment_Amount"];
        $DOPBSP_Currency = $_SESSION['DOPBSP_Currency'];
        $DOPBSP_CurrencyCode = $_SESSION['DOPBSP_CurrencyCode'];
                
        $DOPBSP_CheckIn = $_SESSION['DOPBSP_CheckIn'];
        $DOPBSP_CheckOut = $_SESSION['DOPBSP_CheckOut'];    
        $DOPBSP_StartHour = $_SESSION['DOPBSP_StartHour'];
        $DOPBSP_EndHour = $_SESSION['DOPBSP_EndHour'];
        $DOPBSP_NoItems = $_SESSION['DOPBSP_NoItems'];

        $DOPBSP_FirstName = $_SESSION['DOPBSP_FirstName'];
        $DOPBSP_LastName = $_SESSION['DOPBSP_LastName'];
        $DOPBSP_Email = $_SESSION['DOPBSP_Email'];
        $DOPBSP_Phone = $_SESSION['DOPBSP_Phone'];
        $DOPBSP_NoPeople = $_SESSION['DOPBSP_NoPeople'];
        $DOPBSP_NoChildren = $_SESSION['DOPBSP_NoChildren'];
        $DOPBSP_Message = $_SESSION['DOPBSP_Message'];
                
        $DOPBSP_Notes = array();
        
        $_SESSION['DOPBSP_Page'] = '';
        $_SESSION['DOPBSP_PluginURL'] = '';
        $_SESSION['DOPBSP_CalendarID'] = '';   
        $_SESSION['DOPBSP_PriceItemValue'] = ''; 
        $_SESSION['DOPBSP_Currency'] = '';
        $_SESSION['DOPBSP_CurrencyCode'] = '';

        $_SESSION['DOPBSP_CheckIn'] = '';
        $_SESSION['DOPBSP_CheckOut'] = '';    
        $_SESSION['DOPBSP_StartHour'] = '';
        $_SESSION['DOPBSP_EndHour'] = '';
        $_SESSION['DOPBSP_NoItems'] = '';

        $_SESSION['DOPBSP_FirstName'] = '';
        $_SESSION['DOPBSP_LastName'] = '';
        $_SESSION['DOPBSP_Email'] = '';
        $_SESSION['DOPBSP_Phone'] = '';
        $_SESSION['DOPBSP_NoPeople'] = '';
        $_SESSION['DOPBSP_NoChildren'] = '';
        $_SESSION['DOPBSP_Message'] = '';
		
	/*
	'------------------------------------
	' Calls the DoExpressCheckoutPayment API call
	'
	' The ConfirmPayment function is defined in the file PayPalFunctions.jsp,
	' that is included at the top of this file.
	'-------------------------------------------------
	*/
        
	$resArray = ConfirmPayment($finalPaymentAmount);
	$ack = strtoupper($resArray["ACK"]);
                
	if ($ack == "SUCCESS" || $ack == "SUCCESSWITHWARNING"){
            /*
            '********************************************************************************************************************
            '
            ' THE PARTNER SHOULD SAVE THE KEY TRANSACTION RELATED INFORMATION LIKE 
            '                    transactionId & orderTime 
            '  IN THEIR OWN  DATABASE
            ' AND THE REST OF THE INFORMATION CAN BE USED TO UNDERSTAND THE STATUS OF THE PAYMENT 
            '
            '********************************************************************************************************************
            */
  
            $transactionId = $resArray["PAYMENTINFO_0_TRANSACTIONID"]; // ' Unique transaction ID of the payment. Note:  If the PaymentAction of the request was Authorization or Order, this value is your AuthorizationID for use with the Authorization & Capture APIs. 
//            $transactionType = $resArray["PAYMENTINFO_0_TRANSACTIONTYPE"]; //' The type of transaction Possible values: l  cart l  express-checkout 
//            $paymentType = $resArray["PAYMENTINFO_0_PAYMENTTYPE"];  //' Indicates whether the payment is instant or delayed. Possible values: l  none l  echeck l  instant 
//            $orderTime = $resArray["PAYMENTINFO_0_ORDERTIME"];  //' Time/date stamp of payment
//            $amt = $resArray["PAYMENTINFO_0_AMT"];  //' The final amount charged, including any shipping and taxes from your Merchant Profile.
//            $currencyCode= $resArray["PAYMENTINFO_0_CURRENCYCODE"];  //' A three-character currency code for one of the currencies listed in PayPay-Supported Transactional Currencies. Default: USD. 
//            $feeAmt = $resArray["PAYMENTINFO_0_FEEAMT"];  //' PayPal fee amount charged for the transaction
//            $settleAmt = $resArray["PAYMENTINFO_0_SETTLEAMT"];  //' Amount deposited in your PayPal account after a currency conversion.
//            $taxAmt = $resArray["PAYMENTINFO_0_TAXAMT"];  //' Tax charged on the transaction.
//            $exchangeRate = $resArray["PAYMENTINFO_0_EXCHANGERATE"];  //' Exchange rate if a currency conversion occurred. Relevant only if your are billing in their non-primary currency. If the customer chooses to pay with a currency other than the non-primary currency, the conversion occurs in the customer's account.
		
            /*
            ' Status of the payment: 
                            'Completed: The payment has been completed, and the funds have been added successfully to your account balance.
                            'Pending: The payment is pending. See the PendingReason element for more information. 
            */
		
//            $paymentStatus = $resArray["PAYMENTINFO_0_PAYMENTSTATUS"]; 

            /*
            'The reason the payment is pending:
            '  none: No pending reason 
            '  address: The payment is pending because your customer did not include a confirmed shipping address and your Payment Receiving Preferences is set such that you want to manually accept or deny each of these payments. To change your preference, go to the Preferences section of your Profile. 
            '  echeck: The payment is pending because it was made by an eCheck that has not yet cleared. 
            '  intl: The payment is pending because you hold a non-U.S. account and do not have a withdrawal mechanism. You must manually accept or deny this payment from your Account Overview. 		
            '  multi-currency: You do not have a balance in the currency sent, and you do not have your Payment Receiving Preferences set to automatically convert and accept this payment. You must manually accept or deny this payment. 
            '  verify: The payment is pending because you are not yet verified. You must verify your account before you can accept this payment. 
            '  other: The payment is pending for a reason other than those listed above. For more information, contact PayPal customer service. 
            */
		
//            $pendingReason = $resArray["PAYMENTINFO_0_PENDINGREASON"];  

            /*
            'The reason for a reversal if TransactionType is reversal:
            '  none: No reason code 
            '  chargeback: A reversal has occurred on this transaction due to a chargeback by your customer. 
            '  guarantee: A reversal has occurred on this transaction due to your customer triggering a money-back guarantee. 
            '  buyer-complaint: A reversal has occurred on this transaction due to a complaint about the transaction from your customer. 
            '  refund: A reversal has occurred on this transaction because you have given the customer a refund. 
            '  other: A reversal has occurred on this transaction due to a reason not listed above. 
            */
		
//            $reasonCode = $resArray["PAYMENTINFO_0_REASONCODE"];   
            
            // ================================================================= WP Settings
            require_once('../../../../../wp-load.php');  
            require_once('../../dopbsp-email.php');  
                    
            if (isset($_SESSION["DOPBookingSystemPROFrontEndLanguage"])){
                include_once "../../translation/frontend/".$_SESSION["DOPBookingSystemPROFrontEndLanguage"].".php";        
            }
            else{
                include_once "../../translation/frontend/en.php";
            }

            global $wpdb;
            $wp_settings = $wpdb->get_row('SELECT * FROM '.DOPBSP_Settings_table.' WHERE calendar_id="'.$DOPBSP_CalendarID.'"');
        
            $wpdb->insert(DOPBSP_Reservations_table, array('calendar_id' => $DOPBSP_CalendarID,
                                                           'check_in' => $DOPBSP_CheckIn,
                                                           'check_out' => $DOPBSP_CheckOut,
                                                           'start_hour' => $DOPBSP_StartHour,
                                                           'end_hour' => $DOPBSP_EndHour,
                                                           'no_items' => $DOPBSP_NoItems,
                                                           'currency' => $DOPBSP_Currency,
                                                           'currency_code' => $DOPBSP_CurrencyCode,
                                                           'total_price' => $DOPBSP_PriceValue,
                                                           'discount' => $DOPBSP_DiscountValue,
                                                           'price' => $DOPBSP_PriceToPayValue,
                                                           'deposit' => $DOPBSP_PriceDepositValue,
                                                           'first_name' => $DOPBSP_FirstName,
                                                           'last_name' => $DOPBSP_LastName,
                                                           'email' => $DOPBSP_Email,
                                                           'phone' => $DOPBSP_Phone,
                                                           'no_people' => $DOPBSP_NoPeople,
                                                           'no_children' => $DOPBSP_NoChildren,
                                                           'message' => $DOPBSP_Message,
                                                           'payment_method' => '2',
                                                           'paypal_transaction_id' => $transactionId,
                                                           'status' => 'approved'));
            $DOPemail = new DOPBookingSystemPROEmail();
            $reservationId = $wpdb->insert_id;
            
            $message = '';
            $message_ids = '';
            $message_date = '';
            $message_price = '';
            $message_form = '';

            if ($wp_settings->notifications_email){
                // ================================================================= Email to user
                $message = DOPBSP_EMAIL_TO_USER_MESSAGE_PAYMENT_PAYPAL;
                
                $message_ids = '<strong>'.DOPBSP_EMAIL_RESERVATION_ID.'</strong> '.$reservationId;
                $message_ids .= '<br /><strong>'.DOPBSP_PAYMENT_PAYPAL_TRANSACTON_ID_LABEL.'</strong> '.$transactionId;
                
                $message_date = $DOPBSP_CheckIn != '' ? '<strong>'.DOPBSP_CHECK_IN_LABEL.':</strong> '.dateToFormat($DOPBSP_CheckIn, $wp_settings->date_type):'';
                $message_date .= $DOPBSP_CheckOut != '' ? '<br /><strong>'.DOPBSP_CHECK_OUT_LABEL.':</strong> '.dateToFormat($DOPBSP_CheckOut, $wp_settings->date_type):'';
                $message_date .= $DOPBSP_StartHour != '' ?  '<br /><strong>'.DOPBSP_START_HOURS_LABEL.':</strong> '.($wp_settings->hours_ampm == 'true' ? timeToAMPM($DOPBSP_StartHour):$DOPBSP_StartHour):'';
                $message_date .= $DOPBSP_EndHour != '' ? '<br /><strong>'.DOPBSP_END_HOURS_LABEL.':</strong> '.($wp_settings->hours_ampm == 'true' ? timeToAMPM($DOPBSP_EndHour):$DOPBSP_EndHour):'';
                
                $message_price = $DOPBSP_NoItems != '' ? '<strong>'.DOPBSP_NO_ITEMS_LABEL.':</strong> '.$DOPBSP_NoItems:'';
                $message_price .= $DOPBSP_PriceToPayValue != 0 ? '<br /><strong>'.DOPBSP_TOTAL_PRICE_LABEL.'</strong> '.$DOPBSP_Currency.$DOPBSP_PriceToPayValue:'';
                $message_price .= $DOPBSP_PriceDepositValue != 0 ? '<br /><strong>'.DOPBSP_DEPOSIT_PRICE_LABEL.'</strong> '.$DOPBSP_Currency.$DOPBSP_PriceDepositValue.' ('.$wp_settings->deposit.'%)'.
                                                                   '<br /><strong>'.DOPBSP_DEPOSIT_PRICE_LEFT_LABEL.'</strong> '.$DOPBSP_Currency.($DOPBSP_PriceToPayValue-$DOPBSP_PriceDepositValue):'';
                $message_price .= $DOPBSP_PriceValue != 0 && $DOPBSP_PriceValue != $DOPBSP_PriceToPayValue ? '<br /><strong>'.DOPBSP_DISCOUNT_PRICE_LABEL.'</strong> <span style="text-decoration: line-through;">'.$DOPBSP_Currency.$DOPBSP_PriceValue.'</span> ('.$DOPBSP_DiscountValue.'% '.DOPBSP_DISCOUNT_TEXT.')':'';
                        
                $message_form = $DOPBSP_FirstName != '' ? '<strong>'.DOPBSP_FIRST_NAME_LABEL.':</strong> '.$DOPBSP_FirstName:'';
                $message_form .= $DOPBSP_LastName != '' ? '<br /><strong>'.DOPBSP_LAST_NAME_LABEL.':</strong> '.$DOPBSP_LastName:'';
                $message_form .= $DOPBSP_Email != '' ? '<br /><strong>'.DOPBSP_EMAIL_LABEL.':</strong> '.$DOPBSP_Email:'';
                $message_form .= $DOPBSP_Phone != '' ? '<br /><strong>'.DOPBSP_PHONE_LABEL.':</strong> '.$DOPBSP_Phone:'';
                $message_form .= $DOPBSP_NoPeople != '' ? ($DOPBSP_NoChildren == '' ? '<br /><strong>'.DOPBSP_NO_PEOPLE_LABEL:'<br /><strong>'.DOPBSP_NO_ADULTS_LABEL).':</strong> '.$DOPBSP_NoPeople:'';
                $message_form .= $DOPBSP_NoChildren != '' ? '<br /><strong>'.DOPBSP_NO_CHILDREN_LABEL.':</strong> '.$DOPBSP_NoChildren:'';
                $message_form .= $DOPBSP_Message != '' ? '<br /><strong>'.DOPBSP_MESSAGE_LABEL.':</strong> '.$DOPBSP_Message:'';

                if ($wp_settings->smtp_enabled == 'true'){
                    $DOPemail->sendSMTPEmail($DOPBSP_Email,
                                             $wp_settings->notifications_email,
                                             DOPBSP_EMAIL_TO_USER_SUBJECT,
                                             $DOPemail->message($message,
                                                                $message_ids,
                                                                $message_date,
                                                                $message_price,
                                                                $message_form,
                                                                '../../emails/'.$wp_settings->template_email.'/paypal-user-email.html'),
                                             $wp_settings->smtp_host_name,
                                             $wp_settings->smtp_host_port,
                                             $wp_settings->smtp_ssl,
                                             $wp_settings->smtp_user,
                                             $wp_settings->smtp_password);
                }
                else{
                    $DOPemail->sendEmail($DOPBSP_Email,
                                         $wp_settings->notifications_email,
                                         DOPBSP_EMAIL_TO_USER_SUBJECT,
                                         $DOPemail->message($message,
                                                            $message_ids,
                                                            $message_date,
                                                            $message_price,
                                                            $message_form,
                                                            '../../emails/'.$wp_settings->template_email.'/paypal-user-email.html'));
                }
                
                // ================================================================= Email to admin
                $message = DOPBSP_EMAIL_TO_ADMIN_MESSAGE_PAYMENT_PAYPAL;
                
                if ($wp_settings->smtp_enabled == 'true'){
                    $DOPemail->sendSMTPEmail($wp_settings->notifications_email,
                                             $DOPBSP_Email,
                                             DOPBSP_EMAIL_TO_ADMIN_SUBJECT,
                                             $DOPemail->message($message,
                                                                $message_ids,
                                                                $message_date,
                                                                $message_price,
                                                                $message_form,
                                                                '../../emails/'.$wp_settings->template_email.'/paypal-administrator-email.html'),
                                             $wp_settings->smtp_host_name,
                                             $wp_settings->smtp_host_port,
                                             $wp_settings->smtp_ssl,
                                             $wp_settings->smtp_user,
                                             $wp_settings->smtp_password);
                }
                else{
                    $DOPemail->sendEmail($wp_settings->notifications_email,
                                         $DOPBSP_Email,
                                         DOPBSP_EMAIL_TO_ADMIN_SUBJECT,
                                         $DOPemail->message($message,
                                                            $message_ids,
                                                            $message_date,
                                                            $message_price,
                                                            $message_form,
                                                            '../../emails/'.$wp_settings->template_email.'/paypal-administrator-email.html'));
                }
            }
            
            // ================================================================= Notes
            array_push($DOPBSP_Notes, '<strong>'.DOPBSP_EMAIL_RESERVATION_ID.':</strong> '.$reservationId);
            array_push($DOPBSP_Notes, '<strong>'.DOPBSP_PAYMENT_PAYPAL_TRANSACTON_ID_LABEL.':</strong> '.$transactionId);
            array_push($DOPBSP_Notes, '<strong>'.DOPBSP_TOTAL_PRICE_LABEL.'</strong> '.$DOPBSP_Currency.$DOPBSP_PriceToPayValue);
            
            if ($DOPBSP_PriceDepositValue != 0){
                array_push($DOPBSP_Notes, '<strong>'.DOPBSP_DEPOSIT_PRICE_LABEL.'</strong> '.$DOPBSP_Currency.$DOPBSP_PriceDepositValue.' ('.$wp_settings->deposit.'%)');
                array_push($DOPBSP_Notes, '<strong>'.DOPBSP_DEPOSIT_PRICE_LEFT_LABEL.'</strong> '.$DOPBSP_Currency.($DOPBSP_PriceToPayValue-$DOPBSP_PriceDepositValue));
            }
            
            if ($DOPBSP_PriceValue != 0 && $DOPBSP_PriceValue != $DOPBSP_PriceToPayValue){
                array_push($DOPBSP_Notes, '<strong>'.DOPBSP_DISCOUNT_PRICE_LABEL.'</strong> <span style="text-decoration: line-through;">'.$DOPBSP_Currency.$DOPBSP_PriceValue.'</span> ('.$DOPBSP_DiscountValue.'% '.DOPBSP_DISCOUNT_TEXT.')');
            }
            
            if ($DOPBSP_FirstName != ''){
                array_push($DOPBSP_Notes, '<strong>'.$DOPBSP_FirstName.' '.$DOPBSP_LastName.'</strong>');
            }
            
            if ($DOPBSP_Email != ''){
                array_push($DOPBSP_Notes, '<strong>'.DOPBSP_EMAIL_LABEL.':</strong> '.$DOPBSP_Email);
            }
            
            if ($DOPBSP_Phone != ''){
                array_push($DOPBSP_Notes, '<strong>'.DOPBSP_PHONE_LABEL.':</strong> '.$DOPBSP_Phone);
            }
            
            if ($DOPBSP_NoPeople != ''){
                array_push($DOPBSP_Notes, '<strong>'.($DOPBSP_NoChildren == '' ? DOPBSP_NO_PEOPLE_LABEL:DOPBSP_NO_ADULTS_LABEL).':</strong> '.$DOPBSP_NoPeople);
            }
            
            if ($DOPBSP_NoChildren != ''){
                array_push($DOPBSP_Notes, '<strong>'.DOPBSP_NO_CHILDREN_LABEL.':</strong> '.$DOPBSP_NoChildren);
            }
            
            if ($DOPBSP_Message != ''){
                array_push($DOPBSP_Notes, '<strong>'.DOPBSP_MESSAGE_LABEL.':</strong> '.$DOPBSP_Message);
            }
            
            array_push($DOPBSP_Notes, '------------------------------<br />');
            
            // ================================================================= Change Schedule
            
            // ================================================================= Load Schedule
            
            if ($DOPBSP_CheckOut == ''){
                $day = $wpdb->get_row('SELECT * FROM '.DOPBSP_Days_table.' WHERE calendar_id="'.$DOPBSP_CalendarID.'" AND day="'.$DOPBSP_CheckIn.'"');
            }
            else{
                if ($wp_settings->morning_check_out == 'true'){
                    $days = $wpdb->get_results('SELECT * FROM '.DOPBSP_Days_table.' WHERE calendar_id="'.$DOPBSP_CalendarID.'" AND day>="'.$DOPBSP_CheckIn.'" AND day<"'.$DOPBSP_CheckOut.'"');
                }
                else{
                    $days = $wpdb->get_results('SELECT * FROM '.DOPBSP_Days_table.' WHERE calendar_id="'.$DOPBSP_CalendarID.'" AND day>="'.$DOPBSP_CheckIn.'" AND day<="'.$DOPBSP_CheckOut.'"');
                }
            }
            
            // =================================================================
            
            if ($DOPBSP_CheckOut == '' && $DOPBSP_StartHour == ''){ 
                $data = json_decode($day->data);
                
                if ($data->available == '' || (int)$data->available < 1){
                    $available = 1;
                }
                else{
                    $available = $data->available;
                }

                if ($available-$DOPBSP_NoItems == 0){
                        $data->price = '';
                        $data->promo = '';
                        $data->status = 'booked';
                }

                $data->available = $available-$DOPBSP_NoItems;
                $data->notes = $data->notes.implode('<br />', $DOPBSP_Notes);
                
                $wpdb->update(DOPBSP_Days_table, array('data' => json_encode($data)), array('calendar_id' => $DOPBSP_CalendarID, 
                                                                                            'day' => $day->day));
            }
            else if ($DOPBSP_CheckOut != ''){                 
                foreach ($days as $key => $day){
                    $data = json_decode($day->data);

                    if ($data->available == '' || (int)$data->available < 1){
                        $available = 1;
                    }
                    else{
                        $available = $data->available;
                    }

                    if ($available-$DOPBSP_NoItems == 0){
                            $data->price = '';
                            $data->promo = '';
                            $data->status = 'booked';
                    }

                    $data->available = $available-$DOPBSP_NoItems;
                    $data->notes = $data->notes.implode('<br />', $DOPBSP_Notes);

                    $wpdb->update(DOPBSP_Days_table, array('data' => json_encode($data)), array('calendar_id' => $DOPBSP_CalendarID, 
                                                                                                'day' => $day->day));
                }
            }
            else if ($DOPBSP_StartHour != '' && $DOPBSP_EndHour == ''){ 
                $data = json_decode($day->data);
                $hour = $data->hours->$DOPBSP_StartHour;
                
                if ($hour->available == '' || (int)$hour->available < 1){
                    $available = 1;
                }
                else{
                    $available = (int)$hour->available;
                }

                if ($available-$DOPBSP_NoItems == 0){
                    $hour->price = '';
                    $hour->promo = '';
                    $hour->status = 'booked';
                }

                $hour->available = $available-$DOPBSP_NoItems;
                $hour->notes = $hour->notes.implode('<br />', $DOPBSP_Notes);
                
                $data->hours->$DOPBSP_StartHour = $hour;
                $wpdb->update(DOPBSP_Days_table, array('data' => json_encode($data)), array('calendar_id' => $DOPBSP_CalendarID, 
                                                                                            'day' => $day->day));
            }
            else if ($DOPBSP_EndHour != ''){
                $data = json_decode($day->data);
                
                foreach ($data->hours as $key => $item){
                    if ($DOPBSP_StartHour <= $key && $key <= $DOPBSP_EndHour){
                        $hour = $data->hours->$key;
                
                        if ($hour->available == '' || (int)$hour->available < 1){
                            $available = 1;
                        }
                        else{
                            $available = (int)$hour->available;
                        }

                        if ($available-$DOPBSP_NoItems == 0){
                            $hour->price = '';
                            $hour->promo = '';
                            $hour->status = 'booked';
                        }

                        $hour->available = $available-$DOPBSP_NoItems;
                        $hour->notes = $hour->notes.implode('<br />', $DOPBSP_Notes);

                        $data->hours->$key = $hour;
                    }
                }
                
                $wpdb->update(DOPBSP_Days_table, array('data' => json_encode($data)), array('calendar_id' => $DOPBSP_CalendarID, 
                                                                                            'day' => $day->day));
            }
            
            // =================================================================        
                    
            $_SESSION['DOPBSP_PayPal'.$DOPBSP_CalendarID] = 'success';
            header('Location:'.$DOPBSP_Page);
            
            // =================================================================
	}
	else{
            //Display a user friendly Error on the page using any of the following error information returned by PayPal
//            $ErrorCode = urldecode($resArray["L_ERRORCODE0"]);
//            $ErrorShortMsg = urldecode($resArray["L_SHORTMESSAGE0"]);
//            $ErrorLongMsg = urldecode($resArray["L_LONGMESSAGE0"]);
//            $ErrorSeverityCode = urldecode($resArray["L_SEVERITYCODE0"]);

//            echo "GetExpressCheckoutDetails API call failed.<br />";
//            echo "Detailed Error Message: ".$ErrorLongMsg."<br />";
//            echo "Short Error Message: ".$ErrorShortMsg."<br />";
//            echo "Error Code: ".$ErrorCode."<br />";
//            echo "Error Severity Code: ".$ErrorSeverityCode."<br />";
              
            $_SESSION['DOPBSP_PayPal'.$DOPBSP_CalendarID] = 'error';
            header('Location:'.$DOPBSP_Page);
	}
    }
    
// Prototypes
    function dateToFormat($date, $type){
        global $DOPBSP_month_names;  
        $dayPieces = explode('-', $date);

        if ($type == '1'){
            return $DOPBSP_month_names[(int)$dayPieces[1]-1].' '.$dayPieces[2].', '.$dayPieces[0];
        }
        else{
            return $dayPieces[2].' '.$DOPBSP_month_names[(int)$dayPieces[1]-1].' '.$dayPieces[0];
        }
    }
            
    function timeToAMPM($item){
        $time_pieces = explode(':', $item);
        $hour = (int)$time_pieces[0];
        $minutes = $time_pieces[1];
        $result = '';

        if ($hour == 0){
            $result = '12';
        }
        else if ($hour > 12){
            $result = timeLongItem($hour-12);
        }
        else{
            $result = timeLongItem($hour);
        }

        $result .= ':'.$minutes.' '.($hour < 12 ? 'AM':'PM');

        return $result;
    }

    function timeLongItem($item){
        if ($item < 10){
            return '0'.$item;
        }
        else{
            return $item;
        }
    }
		
?>