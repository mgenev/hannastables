<?php

/*
* Title                   : Booking System PRO (WordPress Plugin)
* Version                 : 1.2
* File                    : ma.php
* File Version            : 1.0
* Created / Last Modified : 01 November 2012
* Author                  : Marius-Cristian Donea
* Copyright               : © 2012 Marius-Cristian Donea
* Website                 : http://www.mariuscristiandonea.com
* Description             : Maltese Backend Translation.
*/

    define('DOPBSP_TITLE', "Booking System PRO");

    // Loading ...
    define('DOPBSP_LOAD', "Load data ...");

    // Save ...
    define('DOPBSP_SAVE', "Save data ...");
    define('DOPBSP_SAVE_SUCCESS', "Data has been saved.");
    
    // Months & Week Days
    global $DOPBSP_month_names;
    $DOPBSP_month_names = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
    
    global $DOPBSP_day_names;
    $DOPBSP_day_names = array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
    
    // Help
    define('DOPBSP_CALENDARS_HELP', "Click on the 'plus' icon to add a calendar. Click on a calendar item to open the editing area.");
    define('DOPBSP_CALENDAR_EDIT_HELP', "Select the days and hours to edit them. Click on the 'pencil' icon to edit calendar settings. Click on the 'mail' icon to see if you have reservations. Read documentation for more information.");
    define('DOPBSP_CALENDAR_EDIT_SETTINGS_HELP', "Click 'Submit Button' to save changes. Click 'Delete Button' to delete the calendar. Click 'Back Button' to return to the calendar.");

    // Form
    define('DOPBSP_SUBMIT', "Submit");
    define('DOPBSP_DELETE', "Delete");
    define('DOPBSP_BACK', "Back");
    define('DOPBSP_BACK_SUBMIT', "Back to calendar.");
    define('DOPBSP_ENABLED', "Enabled");
    define('DOPBSP_DISABLED', "Disabled");
    define('DOPBSP_DATE_TYPE_AMERICAN', "American (mm dd, yyyy)");
    define('DOPBSP_DATE_TYPE_EUROPEAN', "European (dd mm yyyy)");

    // Calendars    
    define('DOPBSP_SHOW_CALENDARS', "Calendars");
    define('DOPBSP_CALENDARS_LOADED', "Calendars list loaded.");
    define('DOPBSP_CALENDAR_LOADED', "Calendar loaded.");
    define('DOPBSP_NO_CALENDARS', "No calendars.");    
    
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
    define('DOPBSP_DATE_START_LABEL', "Start Date");
    define('DOPBSP_DATE_END_LABEL', "End Date");    
    define('DOPBSP_STATUS_LABEL', "Status");
    define('DOPBSP_STATUS_AVAILABLE_TEXT', "Available");
    define('DOPBSP_STATUS_BOOKED_TEXT', "Booked");
    define('DOPBSP_STATUS_SPECIAL_TEXT', "Special");
    define('DOPBSP_STATUS_UNAVAILABLE_TEXT', "Unavailable");
    define('DOPBSP_PRICE_LABEL', "Price");    
    define('DOPBSP_PROMO_LABEL', "Promo Price");               
    define('DOPBSP_AVAILABLE_LABEL', "No. Available");         
    define('DOPBSP_HOURS_DEFINITIONS_CHANGE_LABEL', "Change Hours Definitions (changing the definitions will overwrite any previous hours data)");
    define('DOPBSP_HOURS_DEFINITIONS_LABEL', "Hours Definitions (hh:mm add one per line). Use only 24 hours format.");  
    define('DOPBSP_HOURS_SET_DEFAULT_DATA_LABEL', "Set default hours values for this day(s). This will overwrite any existing data.)"); 
    define('DOPBSP_HOURS_START_LABEL', "Start Hour"); 
    define('DOPBSP_HOURS_END_LABEL', "End Hour");
    define('DOPBSP_HOURS_INFO_LABEL', "Information (users will see this message)");
    define('DOPBSP_HOURS_NOTES_LABEL', "Notes (only you will see this message)");
    define('DOPBSP_GROUP_DAYS_LABEL', "Group Days");
    define('DOPBSP_GROUP_HOURS_LABEL', "Group Hours");
    define('DOPBSP_RESET_CONFIRMATION', "Are you sure you want to reset data? If you reset days, hours data from those days will be reset to.");
    
    // Add Calendar
    define('DOPBSP_ADD_CALENDAR_NAME', "New Calendar");
    define('DOPBSP_ADD_CALENDAR_SUBMIT', "Add Calendar");
    define('DOPBSP_ADD_CALENDAR_SUBMITED', "Adding calendar ...");
    define('DOPBSP_ADD_CALENDAR_SUCCESS', "You have succesfully added a new calendar.");

    // Edit Calendar
    define('DOPBSP_EDIT_CALENDAR_SUBMIT', "Edit Calendar");
    define('DOPBSP_EDIT_CALENDAR_SUCCESS', "You have succesfully edited the calendar.");

    // Delete Calendar
    define('DOPBSP_DELETE_CALENDAR_CONFIRMATION', "Are you sure you want to delete this calendar?");
    define('DOPBSP_DELETE_CALENDAR_SUBMIT', "Delete Calendar");
    define('DOPBSP_DELETE_CALENDAR_SUBMITED', "Deleting calendar ...");
    define('DOPBSP_DELETE_CALENDAR_SUCCESS', "You have succesfully deleted the calendar.");
    
    // Reservations
    define('DOPBSP_SHOW_RESERVATIONS', "Show Reservations");    
    define('DOPBSP_NO_RESERVATIONS', "There are no reservations.");
    
    define('DOPBSP_RESERVATIONS_ID', "Reservation ID");
    
    define('DOPBSP_RESERVATIONS_CHECK_IN_LABEL', "Check In");
    define('DOPBSP_RESERVATIONS_CHECK_OUT_LABEL', "Check Out");
    define('DOPBSP_RESERVATIONS_START_HOURS_LABEL', "Start at"); 
    define('DOPBSP_RESERVATIONS_END_HOURS_LABEL', "Finish at");
    
    define('DOPBSP_RESERVATIONS_FIRST_NAME_LABEL', "First Name");
    define('DOPBSP_RESERVATIONS_LAST_NAME_LABEL', "Last Name");
    define('DOPBSP_RESERVATIONS_STATUS_LABEL', "Status");
    define('DOPBSP_RESERVATIONS_STATUS_PENDING', "Pending");
    define('DOPBSP_RESERVATIONS_STATUS_APPROVED', "Approved");        
    define('DOPBSP_RESERVATIONS_DATE_CREATED_LABEL', "Date Created");    
    define('DOPBSP_RESERVATIONS_PAYMENT_METHOD_LABEL', 'Payment Method');
    define('DOPBSP_RESERVATIONS_PAYMENT_METHOD_ARRIVAL', 'On Arrival');
    define('DOPBSP_RESERVATIONS_PAYMENT_METHOD_PAYPAL', 'PayPal');
    define('DOPBSP_RESERVATIONS_PAYMENT_METHOD_PAYPAL_TRANSACTION_ID_LABEL', 'PayPal Transaction ID');   
    define('DOPBSP_RESERVATIONS_TOTAL_PRICE_LABEL', "Total:"); 
    define('DOPBSP_RESERVATIONS_NO_ITEMS_LABEL', "No Booked Items"); 
    define('DOPBSP_RESERVATIONS_PRICE_LABEL', "Price");  
    define('DOPBSP_RESERVATIONS_DEPOSIT_PRICE_LABEL', "Deposit");
    define('DOPBSP_RESERVATIONS_DEPOSIT_PRICE_LEFT_LABEL', " Left to Pay");
    define('DOPBSP_RESERVATIONS_DISCOUNT_PRICE_LABEL', "Actual Price");
    define('DOPBSP_RESERVATIONS_DISCOUNT_PRICE_TEXT', "discount");
    define('DOPBSP_RESERVATIONS_EMAIL_LABEL', "Email"); 
    define('DOPBSP_RESERVATIONS_PHONE_LABEL', "Phone"); 
    define('DOPBSP_RESERVATIONS_NO_PEOPLE_LABEL', "No People"); 
    define('DOPBSP_RESERVATIONS_NO_ADULTS_LABEL', "No Adults"); 
    define('DOPBSP_RESERVATIONS_NO_CHILDREN_LABEL', "No Children"); 
    define('DOPBSP_RESERVATIONS_MESSAGE_LABEL', "Message");
    
    define('DOPBSP_RESERVATIONS_JUMP_TO_DAY_LABEL', 'Jump to day');
    define('DOPBSP_RESERVATIONS_APPROVE_LABEL', 'Approve');
    define('DOPBSP_RESERVATIONS_REJECT_LABEL', 'Reject');
    define('DOPBSP_RESERVATIONS_CANCEL_LABEL', 'Cancel');
    
    define('DOPBSP_RESERVATIONS_APPROVE_CONFIRMATION', 'Are you sure you want to approve this reservation?');
    define('DOPBSP_RESERVATIONS_APPROVE_SUCCESS', 'The reservatiopn has been approved.');
    define('DOPBSP_RESERVATIONS_REJECT_CONFIRMATION', 'Are you sure you want to reject this reservation?');
    define('DOPBSP_RESERVATIONS_REJECT_SUCCESS', 'The reservatiopn has been rejected.');
    define('DOPBSP_RESERVATIONS_CANCEL_CONFIRMATION', 'Are you sure you want to cancel this reservation?');
    define('DOPBSP_RESERVATIONS_CANCEL_SUCCESS', 'The reservatiopn has been canceled.');
    
    // Email 
    define('DOPBSP_EMAIL_APPROVED_SUBJECT', "Your booking request has been approved.");
    define('DOPBSP_EMAIL_APPROVED_MESSAGE', "Congratulations! Your booking request has been approved. Details about your request are below.");
    
    define('DOPBSP_EMAIL_REJECTED_SUBJECT', "Your booking request has been rejected.");
    define('DOPBSP_EMAIL_REJECTED_MESSAGE', "I'm sorry but your booking request has been rejected. Details about your request are below.");
    
    define('DOPBSP_EMAIL_CANCELED_SUBJECT', "Your booking request has been canceled.");
    define('DOPBSP_EMAIL_CANCELED_MESSAGE', "I'm sorry but your booking request has been canceled. Details about your request are below.");
    
    // TinyMCE
    define('DOPBSP_TINYMCE_ADD', 'Add Calendar');

    // Settings
    define('DOPBSP_GENERAL_STYLES_SETTINGS', "General Settings");
    define('DOPBSP_CALENDAR_NAME', "Name");
    define('DOPBSP_AVAILABLE_DAYS', "Available Days");
    define('DOPBSP_CURRENCY', "Currency");
    define('DOPBSP_DATE_TYPE', "Date Type");
    define('DOPBSP_PREDEFINED', "Select Predifined Settings");
    define('DOPBSP_TEMPLATE', "Style Template");
    define('DOPBSP_MIN_STAY', "Minimum Stay");
    define('DOPBSP_MAX_STAY', "Maximum Stay");
    define('DOPBSP_PAGE_URL', "Page URL");
    
    define('DOPBSP_NOTIFICATIONS_STYLES_SETTINGS', "Notifications Settings");
    define('DOPBSP_NOTIFICATIONS_TEMPLATE', "Email Template");
    define('DOPBSP_NOTIFICATIONS_EMAIL', "Notifications Email");
    define('DOPBSP_NOTIFICATIONS_SMTP_ENABLED', "Enable SMTP");
    define('DOPBSP_NOTIFICATIONS_SMTP_HOST_NAME', "SMTP Host Name");
    define('DOPBSP_NOTIFICATIONS_SMTP_HOST_PORT', "SMTP Host Port");
    define('DOPBSP_NOTIFICATIONS_SMTP_SSL', "SMTP SSL Conenction");
    define('DOPBSP_NOTIFICATIONS_SMTP_USER', "SMTP Host User");
    define('DOPBSP_NOTIFICATIONS_SMTP_PASSWORD', "SMTP Host Password");
                                              
    define('DOPBSP_HOURS_STYLES_SETTINGS', "Days/Hours Settings");
    define('DOPBSP_MULTIPLE_DAYS_SELECT', "Use Check In/Check Out");
    define('DOPBSP_MORNING_CHECK_OUT', "Morning Check Out");
    define('DOPBSP_HOURS_ENABLED', "Use Hours");
    define('DOPBSP_HOURS_DEFINITIONS', "Define Hours");
    define('DOPBSP_MULTIPLE_HOURS_SELECT', "Use Start/Finish Hours");
    define('DOPBSP_HOURS_AMPM', "Enable AM/PM format");
    
    define('DOPBSP_DISCOUNTS_NO_DAYS_SETTINGS', "Discounts by Number of Days");
    define('DOPBSP_DISCOUNTS_NO_DAYS', "Number of Days");
    define('DOPBSP_DISCOUNTS_NO_DAYS_DAYS', "days booking");
    
    define('DOPBSP_DEPOSIT_SETTINGS', "Deposit");
    define('DOPBSP_DEPOSIT', "Deposit value");
    
    define('DOPBSP_FORM_STYLES_SETTINGS', "Contact Form Settings");
    define('DOPBSP_NAME_ENABLED', "Enable Name");
    define('DOPBSP_EMAIL_ENABLED', "Enable Email");
    define('DOPBSP_PHONE_ENABLED', "Enable Phone");
    define('DOPBSP_NO_PEOPLE_ENABLED', "Enable Number of People Allowed");
    define('DOPBSP_MIN_NO_PEOPLE', "Minimum number of allowed people");
    define('DOPBSP_MAX_NO_PEOPLE', "Maximum number of allowed people");
    define('DOPBSP_NO_CHILDREN_ENABLED', "Enable Number of Children Allowed");
    define('DOPBSP_MIN_NO_CHILDREN', "Minimum number of allowed children");
    define('DOPBSP_MAX_NO_CHILDREN', "Maximum number of allowed children");
    define('DOPBSP_MESSAGE_ENABLED', "Enable Message");
    define('DOPBSP_PAYMENT_ARRIVAL_ENABLED', "Enable Payment on Arrival");
    
    define('DOPBSP_PAYMENT_PAYPAL_STYLES_SETTINGS', "PayPal Settings");
    define('DOPBSP_PAYMENT_PAYPAL_ENABLED', "Enable PayPal Payment");
    define('DOPBSP_PAYMENT_PAYPAL_USERNAME', "PayPal API User Name");
    define('DOPBSP_PAYMENT_PAYPAL_PASSWORD', "PayPal API Password");
    define('DOPBSP_PAYMENT_PAYPAL_SIGNATURE', "PayPal API Signature");
    define('DOPBSP_PAYMENT_PAYPAL_SANDBOX_ENABLED', "Enable PayPal Sandbox");
    
    define('DOPBSP_TERMS_AND_CONDITIONS_ENABLED', "Enable Terms & Conditions");
    define('DOPBSP_TERMS_AND_CONDITIONS_LINK', "Terms & Conditions Link");
    
    define('DOPBSP_GO_TOP', "go top");
    
    // Settings Info
    define('DOPBSP_CALENDAR_NAME_INFO', "Change calendar name.");
    define('DOPBSP_AVAILABLE_DAYS_INFO', "Default value: all available. Select available days.");
    define('DOPBSP_CURRENCY_INFO', "Default value: USD. Select calendar currency.");
    define('DOPBSP_DATE_TYPE_INFO', "Default value: American. Select date format: American (mm dd, yyyy) or European (dd mm yyyy)");
    define('DOPBSP_PREDEFINED_INFO', "If selected on Submit the bellow settings will be changed.");
    define('DOPBSP_TEMPLATE_INFO', "Default value: default. Select styles template.");
    define('DOPBSP_MIN_STAY_INFO', "Default value: 1. Set minimum amount of days that can be selected.");
    define('DOPBSP_MAX_STAY_INFO', "Default value: 0. Set maximum amount of days that can be selected. If you set 0 the number is unlimited.");
    define('DOPBSP_PAGE_URL_INFO', "Set page URL were the calendar will be added. It is mandatory if you create a searching system through some calendars.");
    
    define('DOPBSP_NOTIFICATIONS_TEMPLATE_INFO', "Default value: default. Select email template.");
    define('DOPBSP_NOTIFICATIONS_EMAIL_INFO', "Enter the email were you will notified about booking requests or you will use to notify users.");
    define('DOPBSP_NOTIFICATIONS_SMTP_ENABLED_INFO', "Use SMTP to send emails.");
    define('DOPBSP_NOTIFICATIONS_SMTP_HOST_NAME_INFO', "Enter SMTP host name");
    define('DOPBSP_NOTIFICATIONS_SMTP_HOST_PORT_INFO', "Enter SMTP host port.");
    define('DOPBSP_NOTIFICATIONS_SMTP_SSL_INFO', "Use a  SSL conenction.");
    define('DOPBSP_NOTIFICATIONS_SMTP_USER_INFO', "Enter SMTP host username.");
    define('DOPBSP_NOTIFICATIONS_SMTP_PASSWORD_INFO', "Enter SMTP host password.");
    
    define('DOPBSP_MULTIPLE_DAYS_SELECT_INFO', "Default value: Enabled. Use Check In/Check Out or select only one day.");
    define('DOPBSP_MORNING_CHECK_OUT_INFO', "Default value: Disabled. This option enables Check In in the afternoon of first day and Check Out in the morning of the day after last day.");
    define('DOPBSP_HOURS_ENABLED_INFO', "Default value: Disabled. Enable hours for the calendar.");
    define('DOPBSP_HOURS_DEFINITIONS_INFO', "Enter hh:mm ... add one per line. Changing the definitions will overwrite any previous hours data. Use only 24 hours format.");
    define('DOPBSP_MULTIPLE_HOURS_SELECT_INFO', "Default value: Enabled. Use Start/Finish Hours or select only one hour.");
    define('DOPBSP_HOURS_AMPM_INFO', "Display hours in AM/PM format. NOTE: Hours definitions still need to be in 24 hours format.");
    
    define('DOPBSP_DISCOUNTS_NO_DAYS_INFO', "Select the number of days to which you want to add a discount (up to 31 days).");
    define('DOPBSP_DISCOUNTS_NO_DAYS_DAYS_INFO', "Default value 0. Set the discount percent that a user will get when booking this number of days.");
    
    define('DOPBSP_DEPOSIT_INFO', "Default value: 0. Set the percent value for the deposit. The Deposit is available only if you have a Payment Service activated.");
    
    define('DOPBSP_NAME_ENABLED_INFO', "Default value: Enabled. Enable Name in Contact Form.");
    define('DOPBSP_EMAIL_ENABLED_INFO', "Default value: Enabled. Enable Email in Contact Form.");
    define('DOPBSP_PHONE_ENABLED_INFO', "Default value: Enabled. Enable Phone in Contact Form.");
    define('DOPBSP_NO_PEOPLE_ENABLED_INFO', "Default value: Enabled. Request number of people that will use the booked item.");
    define('DOPBSP_MIN_NO_PEOPLE_INFO', "Default value: 1. Set minimum number of allowed people per booked item.");
    define('DOPBSP_MAX_NO_PEOPLE_INFO', "Default value: 4. Set maximum number of allowed people per booked item.");
    define('DOPBSP_NO_CHILDREN_ENABLED_INFO', "Default value: Enabled. Request number of children that will use the booked item.");
    define('DOPBSP_MIN_NO_CHILDREN_INFO', "Default value: 0. Set minimum number of allowed children per booked item.");
    define('DOPBSP_MAX_NO_CHILDREN_INFO', "Default value: 2. Set maximum number of allowed children per booked item.");
    define('DOPBSP_MESSAGE_ENABLED_INFO', "Default value: Enabled. Enable Message in Contact Form.");
    define('DOPBSP_PAYMENT_ARRIVAL_ENABLED_INFO', "Default value: Enabled. Allow user to pay on arrival. Need approval.");
    
    define('DOPBSP_PAYMENT_PAYPAL_ENABLED_INFO', "Default value: Disabled. Allow user to pay with PayPal. The period is instantly booked.");
    define('DOPBSP_PAYMENT_PAYPAL_USERNAME_INFO', "Enter PayPal API Credentials User Name. View Help section to see from were you can get them.");
    define('DOPBSP_PAYMENT_PAYPAL_PASSWORD_INFO', "Enter PayPal API Credentials Password. View Help section to see from were you can get them.");
    define('DOPBSP_PAYMENT_PAYPAL_SIGNATURE_INFO', "Enter PayPal API Credentials Signature. View Help section to see from were you can get them.");
    define('DOPBSP_PAYMENT_PAYPAL_SANDBOX_ENABLED_INFO', "Enable to use PayPal Sandbox features.");
    
    define('DOPBSP_TERMS_AND_CONDITIONS_ENABLED_INFO', "Default value: Disabled. Enable Terms & Conditions check box.");
    define('DOPBSP_TERMS_AND_CONDITIONS_LINK_INFO', "Enter the link to Terms & Conditions page.");
    
    // General Settings
    define('DOPBSP_TITLE_SETTINGS', "Settings");
    
    define('DOPBSP_USERS_PERMISSIONS', "Users Permissions");
    define('DOPBSP_USERS_ADMINISTRATORS', "Administrators (view all calendars)");
    define('DOPBSP_USERS_AUTHORS', "Authors (view Booking System)");
    define('DOPBSP_USERS_CONTRIBUTORS', "Contributors (view Booking System)");
    define('DOPBSP_USERS_EDITORS', "Editors (view Booking System)");
    define('DOPBSP_USERS_SUBSCRIBERS', "Subscribers (view Booking System)");
    
    // Help
    define('DOPBSP_TITLE_HELP', 'Help');

    global $DOPBSP_help_info;
    
    $DOPBSP_help_info = array(
        array(
            'question' => 'How do I install the plugin with FTP?',
            'answer' => '<iframe src="http://www.screenr.com/embed/vNo8" width="650" height="396" frameborder="0"></iframe>'
        ),
        array(
            'question' => 'How do I install the plugin with Upload Manager?',
            'answer' => '<iframe src="http://www.screenr.com/embed/1Bo8" width="650" height="396" frameborder="0"></iframe>'
        ),
        array(
            'question' => 'How do I use Morning Check Out?',
            'answer' => '<iframe src="http://www.screenr.com/embed/D587" width="650" height="396" frameborder="0"></iframe>'
        ),
        array(
            'question' => 'How do I enable and manage hours?',
            'answer' => '<iframe src="http://www.screenr.com/embed/G587" width="650" height="396" frameborder="0"></iframe>'
        ),
        array(
            'question' => 'From were I get PayPal API Credentials?',
            'answer' => 'Please follow these <a href="https://cms.paypal.com/us/cgi-bin/?cmd=_render-content&content_ID=developer/e_howto_api_ECAPICredentials" target="_blank">instructions</a>.'
        ),          
        array(
            'question' => 'How do I change the language?',
            'answer' => 'For the Front End you add the attribute <strong>lang</strong> in the shortcode: <strong>[dopbsp id=1 lang=en]</strong>.<br />
                         The value is the name of the translation file from <strong>dopbsp/translation/frontend</strong>.<br /><br />
                         For the Back End you select the language from the top-right corner. The files are in folder <strong>dopbsp/translation/backend</strong>.'
        ),
        array(
            'question' => 'Why doesn\'t the calendar show in my website?',
            'answer' => '1. If the calendar doesn\'t show it might be because there is a problem with the JavaScript in your website. If you can\'t identify the problem <a href="mailto:support@mariuscristiandonea.zendesk.com">contact me</a> with a link. I will identify the problem for you, but I will not fix the problems that aren\'t caused by this plugin.<br />
                         2. Another reason might be that you load more than one jQuery file into your theme. The proper way to load jQuery into your theme or plugin is:<br />
                         &nbsp;&nbsp;&nbsp;&nbsp;<font style="font-size:11px; font-weight:bold;"> if (!wp_script_is(\'jquery\', \'queue\')){<br />
                         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;wp_enqueue_script(\'jquery\');<br />
                         &nbsp;&nbsp;&nbsp;&nbsp;} </font>'
        ),
        array(
            'question' => 'Known issuses',
            'answer' => '1. The Back End section has some display issues in IE 7 (please update to a new version).'
        ),
        array(
            'question' => 'What I can do when nothing works?',
            'answer' => '<a href="mailto:support@mariuscristiandonea.zendesk.com">Contact me</a> :)<br /><br />
                         Before I can offer support I will need to confirm your purchase.<br /><br />
                         There are 2 ways to do this:<br />
                         1. Send me a Private Message from my <a href="http://codecanyon.net/user/MariusCristianDonea" target="_blank">Profile Page</a> ... the right-bottom form. If you don\'t see it you need to Sign In into your Envato Account.<br />
                         2. Send me your Envato Username & Item Purchase Code that came with the Licence Certificate when you bought the item. You can get it from CodeCanyon -> Sign In into your Account -> Downloads -> Licence Certificate on the purchased item.<br /><br />
                         Please add in your message a link were you use the item, admin and/or FTP log in info, or any other stuff that might be relevant.<br /><br />
                         I will try to answer your questions in less than 48 hours. If you don\'t receive an answer in 48 hours please view my <a href="http://codecanyon.net/user/MariusCristianDonea" target="_blank">Profile Page</a> for a reason.'
        )
    )

?>