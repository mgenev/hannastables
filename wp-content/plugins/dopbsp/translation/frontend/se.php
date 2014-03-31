<?php

/*
* Title                   : Booking System PRO (WordPress Plugin)
* Version                 : 1.2
* File                    : se.php
* File Version            : 1.0
* Created / Last Modified : 01 November 2012
* Author                  : Marius-Cristian Donea
* Copyright               : © 2012 Marius-Cristian Donea
* Website                 : http://www.mariuscristiandonea.com
* Description             : Swedish Frontend Translation.
*/
   
    // Months & Week Days
    global $DOPBSP_month_names;
    $DOPBSP_month_names = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
    
    global $DOPBSP_day_names;
    $DOPBSP_day_names = array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
    
    // Calendar 
    define('DOPBSP_ADD_MONTH_VIEW', "Add Month View");
    define('DOPBSP_REMOVE_MONTH_VIEW', "Remove Month View");
    define('DOPBSP_PREVIOUS_MONTH', "Previous Month");
    define('DOPBSP_NEXT_MONTH', "Next Month");
    define('DOPBSP_AVAILABLE_ONE_TEXT', "available");
    define('DOPBSP_AVAILABLE_TEXT', "available");
    define('DOPBSP_BOOKED_TEXT', "booked");
    define('DOPBSP_UNAVAILABLE_TEXT', "unavailable");
                            
    // Calendar Form 
    define('DOPBSP_CHECK_IN_LABEL', "Check In");
    define('DOPBSP_CHECK_OUT_LABEL', "Check Out");
    define('DOPBSP_START_HOURS_LABEL', "Start at"); 
    define('DOPBSP_END_HOURS_LABEL', "Finish at");
    define('DOPBSP_NO_ITEMS_LABEL', "No book items"); 
    define('DOPBSP_SERVICES_LABEL', "Services");
    define('DOPBSP_TOTAL_PRICE_LABEL', "Total:");
    define('DOPBSP_DEPOSIT_PRICE_LABEL', "Deposit:");
    define('DOPBSP_DEPOSIT_PRICE_LEFT_LABEL', " Left to Pay:");
    define('DOPBSP_DISCOUNT_PRICE_LABEL', "Actual Price:");
    define('DOPBSP_DISCOUNT_TEXT', "discount");
    define('DOPBSP_DEPOSIT_TEXT', "deposit");
    
    define('DOPBSP_NO_SERVICES_AVAILABLE', "There are no services available for the period you selected.");
    define('DOPBSP_MIN_STAY_WARNING', "You need to book a minimum number of days");
    define('DOPBSP_MAX_STAY_WARNING', "You can book only a maximum number of days");
    
    define('DOPBSP_FIRST_NAME_LABEL', "First Name");
    define('DOPBSP_FIRST_NAME_INVALID', "Please enter your First Name. All fields are mandatory.");
    define('DOPBSP_LAST_NAME_LABEL', "Last Name");
    define('DOPBSP_LAST_NAME_INVALID', "Please enter your Last Name. All fields are mandatory.");
    define('DOPBSP_EMAIL_LABEL', "Email");
    define('DOPBSP_EMAIL_INVALID', "Please enter a valid Email. All fields are mandatory.");
    define('DOPBSP_PHONE_LABEL', "Phone");
    define('DOPBSP_PHONE_INVALID', "Please enter a valid Phone number. All fields are mandatory.");    
    define('DOPBSP_NO_PEOPLE_LABEL', "No People");
    define('DOPBSP_NO_ADULTS_LABEL', "No Adults");
    define('DOPBSP_NO_CHILDREN_LABEL', "No Children");                
    define('DOPBSP_MESSAGE_LABEL', "Message");
    define('DOPBSP_MESSAGE_INVALID', "Please enter your Message. All fields are mandatory.");    
    define('DOPBSP_PAYMENT_ARRIVAL_LABEL', "Pay on Arrival (need to be approved)"); 
    define('DOPBSP_PAYMENT_ARRIVAL_SUCCESS', "Your request has been successfully sent. Please wait for approval.");
    define('DOPBSP_PAYMENT_PAYPAL_LABEL', "Pay on PayPal (instant booking)");
    define('DOPBSP_PAYMENT_PAYPAL_TRANSACTON_ID_LABEL', "PayPal Transaction ID");
    define('DOPBSP_PAYMENT_PAYPAL_SUCCESS', "Your payment was approved and services are booked."); 
    define('DOPBSP_PAYMENT_PAYPAL_ERROR', "There was an error while processing PayPal payment. Please try again.");
    define('DOPBSP_TERMS_AND_CONDITIONS_INVALID', "You must agree with our Terms & Conditions to continue.");  
    define('DOPBSP_TERMS_AND_CONDITIONS_LABEL', "I accept to agree to the Terms & Conditions.");
    define('DOPBSP_BOOK_NOW_LABEL', "Book Now");
    
    // Email 
    define('DOPBSP_EMAIL_RESERVATION_ID', 'Reservation ID');
    
    define('DOPBSP_EMAIL_TO_USER_SUBJECT', "Your booking request has been sent.");
    define('DOPBSP_EMAIL_TO_USER_MESSAGE_PAYMENT_ARRIVAL', "Please wait for approval. Bellow are the details.");
    define('DOPBSP_EMAIL_TO_USER_MESSAGE_PAYMENT_PAYPAL', "The period has been book. Bellow are the details.");
    
    define('DOPBSP_EMAIL_TO_ADMIN_SUBJECT', "You received a booking request.");
    define('DOPBSP_EMAIL_TO_ADMIN_MESSAGE_PAYMENT_ARRIVAL', "Below are the details. Go to admin to Approve or Reject the request.");
    define('DOPBSP_EMAIL_TO_ADMIN_MESSAGE_PAYMENT_PAYPAL', "Below are the details. Payment has been done via PayPal and the period has been booked.");
    
?>