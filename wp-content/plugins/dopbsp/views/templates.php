<?php

/*
* Title                   : Booking System PRO (WordPress Plugin)
* Version                 : 1.2
* File                    : templates.php
* File Version            : 1.2
* Created / Last Modified : 01 November 2012
* Author                  : Marius-Cristian Donea
* Copyright               : © 2012 Marius-Cristian Donea
* Website                 : http://www.mariuscristiandonea.com
* Description             : Booking System PRO Templates Class.
*/

    if (!class_exists("DOPBSPTemplates")){
        class DOPBSPTemplates{
            function DOPBSPTemplates(){// Constructor.
            }

            function calendarsList(){// Return Template              
?>
    <script type="text/JavaScript">
        var DOPBSP_curr_page = "Calendars List",
        DOPBSP_plugin_url = "<?php echo WP_PLUGIN_URL.'/dopbsp/'?>",
        DOPBSP_plugin_abs = "<?php echo ABSPATH.'wp-content/plugins/dopbsp/'?>",

        DOPBSP_TITLE = "<?php echo DOPBSP_TITLE?>",

        // Loading ...
        DOPBSP_LOAD = "<?php echo DOPBSP_LOAD?>",
        
        // Save ...
        DOPBSP_SAVE = "<?php echo DOPBSP_SAVE?>",
        DOPBSP_SAVE_SUCCESS = "<?php echo DOPBSP_SAVE_SUCCESS?>",
                
        // Months & Week Days
        DOPBSP_month_names = [<?php            
        global $DOPBSP_month_names;
        
        for ($i=0; $i<count($DOPBSP_month_names); $i++){
            if ($i == 0){
                echo '"'.$DOPBSP_month_names[$i].'"';
            }
            else{
                echo ', "'.$DOPBSP_month_names[$i].'"';                
            }
        }
?>],     
        DOPBSP_day_names = [<?php            
        global $DOPBSP_day_names;
        
        for ($i=0; $i<count($DOPBSP_day_names); $i++){
            if ($i == 0){
                echo '"'.$DOPBSP_day_names[$i].'"';
            }
            else{
                echo ', "'.$DOPBSP_day_names[$i].'"';                
            }
        }
?>],

        // Help
        DOPBSP_CALENDARS_HELP = "<?php echo DOPBSP_CALENDARS_HELP?>",
        DOPBSP_CALENDAR_EDIT_HELP = "<?php echo DOPBSP_CALENDAR_EDIT_HELP?>",
        DOPBSP_CALENDAR_EDIT_SETTINGS_HELP = "<?php echo DOPBSP_CALENDAR_EDIT_SETTINGS_HELP?>",

        // Form
        DOPBSP_SUBMIT = "<?php echo DOPBSP_SUBMIT?>",
        DOPBSP_DELETE = "<?php echo DOPBSP_DELETE?>",
        DOPBSP_BACK = "<?php echo DOPBSP_BACK?>",
        DOPBSP_BACK_SUBMIT = "<?php echo DOPBSP_BACK_SUBMIT?>",
        DOPBSP_ENABLED = "<?php echo DOPBSP_ENABLED?>",
        DOPBSP_DISABLED = "<?php echo DOPBSP_DISABLED?>",
        DOPBSP_DATE_TYPE_AMERICAN = "<?php echo DOPBSP_DATE_TYPE_AMERICAN?>",
        DOPBSP_DATE_TYPE_EUROPEAN = "<?php echo DOPBSP_DATE_TYPE_EUROPEAN?>",
        
        // Calendars    
        DOPBSP_SHOW_CALENDARS = "<?php echo DOPBSP_SHOW_CALENDARS?>",
        DOPBSP_CALENDARS_LOADED = "<?php echo DOPBSP_CALENDARS_LOADED?>",
        DOPBSP_CALENDAR_LOADED = "<?php echo DOPBSP_CALENDAR_LOADED?>",
        DOPBSP_NO_CALENDARS = "<?php echo DOPBSP_NO_CALENDARS?>",
        
        // Calendar 
        DOPBSP_ADD_MONTH_VIEW = "<?php echo DOPBSP_ADD_MONTH_VIEW?>",
        DOPBSP_REMOVE_MONTH_VIEW = "<?php echo DOPBSP_REMOVE_MONTH_VIEW?>",
        DOPBSP_PREVIOUS_MONTH = "<?php echo DOPBSP_PREVIOUS_MONTH?>",
        DOPBSP_NEXT_MONTH = "<?php echo DOPBSP_NEXT_MONTH?>",
        DOPBSP_AVAILABLE_ONE_TEXT = "<?php echo DOPBSP_AVAILABLE_ONE_TEXT?>",
        DOPBSP_AVAILABLE_TEXT = "<?php echo DOPBSP_AVAILABLE_TEXT?>",
        DOPBSP_BOOKED_TEXT = "<?php echo DOPBSP_BOOKED_TEXT?>",
        DOPBSP_UNAVAILABLE_TEXT = "<?php echo DOPBSP_UNAVAILABLE_TEXT?>",
                                    
        // Calendar Form 
        DOPBSP_DATE_START_LABEL = "<?php echo DOPBSP_DATE_START_LABEL?>",
        DOPBSP_DATE_START_LABEL = "<?php echo DOPBSP_DATE_START_LABEL?>",
        DOPBSP_DATE_END_LABEL = "<?php echo DOPBSP_DATE_END_LABEL?>",
        DOPBSP_STATUS_LABEL = "<?php echo DOPBSP_STATUS_LABEL?>",
        DOPBSP_STATUS_AVAILABLE_TEXT = "<?php echo DOPBSP_STATUS_AVAILABLE_TEXT?>",
        DOPBSP_STATUS_BOOKED_TEXT = "<?php echo DOPBSP_STATUS_BOOKED_TEXT?>",
        DOPBSP_STATUS_SPECIAL_TEXT = "<?php echo DOPBSP_STATUS_SPECIAL_TEXT?>",
        DOPBSP_STATUS_UNAVAILABLE_TEXT = "<?php echo DOPBSP_STATUS_UNAVAILABLE_TEXT?>",
        DOPBSP_PRICE_LABEL = "<?php echo DOPBSP_PRICE_LABEL?>",
        DOPBSP_PROMO_LABEL = "<?php echo DOPBSP_PROMO_LABEL?>",
        DOPBSP_AVAILABLE_LABEL = "<?php echo DOPBSP_AVAILABLE_LABEL?>",
        DOPBSP_HOURS_DEFINITIONS_CHANGE_LABEL = "<?php echo DOPBSP_HOURS_DEFINITIONS_CHANGE_LABEL?>",
        DOPBSP_HOURS_DEFINITIONS_LABEL = "<?php echo DOPBSP_HOURS_DEFINITIONS_LABEL?>",
        DOPBSP_HOURS_SET_DEFAULT_DATA_LABEL = "<?php echo DOPBSP_HOURS_SET_DEFAULT_DATA_LABEL?>",
        DOPBSP_HOURS_START_LABEL = "<?php echo DOPBSP_HOURS_START_LABEL?>",
        DOPBSP_HOURS_END_LABEL = "<?php echo DOPBSP_HOURS_END_LABEL?>",
        DOPBSP_HOURS_INFO_LABEL = "<?php echo DOPBSP_HOURS_INFO_LABEL?>",
        DOPBSP_HOURS_NOTES_LABEL = "<?php echo DOPBSP_HOURS_NOTES_LABEL?>",
        DOPBSP_GROUP_DAYS_LABEL = "<?php echo DOPBSP_GROUP_DAYS_LABEL?>",
        DOPBSP_GROUP_HOURS_LABEL = "<?php echo DOPBSP_GROUP_HOURS_LABEL?>",
        DOPBSP_RESET_CONFIRMATION = "<?php echo DOPBSP_RESET_CONFIRMATION?>",
        
        // Add Calendar
        DOPBSP_ADD_CALENDAR_NAME = "<?php echo DOPBSP_ADD_CALENDAR_NAME?>",
        DOPBSP_ADD_CALENDAR_SUBMIT = "<?php echo DOPBSP_ADD_CALENDAR_SUBMIT?>",
        DOPBSP_ADD_CALENDAR_SUBMITED = "<?php echo DOPBSP_ADD_CALENDAR_SUBMITED?>",
        DOPBSP_ADD_CALENDAR_SUCCESS = "<?php echo DOPBSP_ADD_CALENDAR_SUCCESS?>",

        // Edit Calendar
        DOPBSP_EDIT_CALENDAR_SUBMIT = "<?php echo DOPBSP_EDIT_CALENDAR_SUBMIT?>",
        DOPBSP_EDIT_CALENDAR_SUCCESS = "<?php echo DOPBSP_EDIT_CALENDAR_SUCCESS?>",

        // Delete Calendar
        DOPBSP_DELETE_CALENDAR_CONFIRMATION = "<?php echo DOPBSP_DELETE_CALENDAR_CONFIRMATION?>",
        DOPBSP_DELETE_CALENDAR_SUBMIT = "<?php echo DOPBSP_DELETE_CALENDAR_SUBMIT?>",
        DOPBSP_DELETE_CALENDAR_SUBMITED = "<?php echo DOPBSP_DELETE_CALENDAR_SUBMITED?>",
        DOPBSP_DELETE_CALENDAR_SUCCESS = "<?php echo DOPBSP_DELETE_CALENDAR_SUCCESS?>",
        
        // Reservations
        DOPBSP_SHOW_RESERVATIONS = "<?php echo DOPBSP_SHOW_RESERVATIONS?>",
        DOPBSP_NO_RESERVATIONS = "<?php echo DOPBSP_NO_RESERVATIONS?>",
        
        DOPBSP_RESERVATIONS_ID = "<?php echo DOPBSP_RESERVATIONS_ID?>",
    
        DOPBSP_RESERVATIONS_CHECK_IN_LABEL = "<?php echo DOPBSP_RESERVATIONS_CHECK_IN_LABEL?>",
        DOPBSP_RESERVATIONS_CHECK_OUT_LABEL = "<?php echo DOPBSP_RESERVATIONS_CHECK_OUT_LABEL?>",
        DOPBSP_RESERVATIONS_START_HOURS_LABEL = "<?php echo DOPBSP_RESERVATIONS_START_HOURS_LABEL?>",
        DOPBSP_RESERVATIONS_END_HOURS_LABEL = "<?php echo DOPBSP_RESERVATIONS_END_HOURS_LABEL?>",
        
        DOPBSP_RESERVATIONS_FIRST_NAME_LABEL = "<?php echo DOPBSP_RESERVATIONS_FIRST_NAME_LABEL?>",
        DOPBSP_RESERVATIONS_LAST_NAME_LABEL = "<?php echo DOPBSP_RESERVATIONS_LAST_NAME_LABEL?>",
        DOPBSP_RESERVATIONS_STATUS_LABEL = "<?php echo DOPBSP_RESERVATIONS_STATUS_LABEL?>",
        DOPBSP_RESERVATIONS_STATUS_PENDING = "<?php echo DOPBSP_RESERVATIONS_STATUS_PENDING?>",
        DOPBSP_RESERVATIONS_STATUS_APPROVED = "<?php echo DOPBSP_RESERVATIONS_STATUS_APPROVED?>",
        DOPBSP_RESERVATIONS_DATE_CREATED_LABEL = "<?php echo DOPBSP_RESERVATIONS_DATE_CREATED_LABEL?>",
        DOPBSP_RESERVATIONS_PAYMENT_METHOD_LABEL = "<?php echo DOPBSP_RESERVATIONS_PAYMENT_METHOD_LABEL?>",
        DOPBSP_RESERVATIONS_PAYMENT_METHOD_ARRIVAL = "<?php echo DOPBSP_RESERVATIONS_PAYMENT_METHOD_ARRIVAL?>",
        DOPBSP_RESERVATIONS_PAYMENT_METHOD_PAYPAL = "<?php echo DOPBSP_RESERVATIONS_PAYMENT_METHOD_PAYPAL?>",
        DOPBSP_RESERVATIONS_PAYMENT_METHOD_PAYPAL_TRANSACTION_ID_LABEL = "<?php echo DOPBSP_RESERVATIONS_PAYMENT_METHOD_PAYPAL_TRANSACTION_ID_LABEL?>",
        DOPBSP_RESERVATIONS_TOTAL_PRICE_LABEL = "<?php echo DOPBSP_RESERVATIONS_TOTAL_PRICE_LABEL?>",   
        DOPBSP_RESERVATIONS_NO_ITEMS_LABEL = "<?php echo DOPBSP_RESERVATIONS_NO_ITEMS_LABEL?>",
        DOPBSP_RESERVATIONS_PRICE_LABEL = "<?php echo DOPBSP_RESERVATIONS_PRICE_LABEL?>",
        DOPBSP_RESERVATIONS_EMAIL_LABEL = "<?php echo DOPBSP_RESERVATIONS_EMAIL_LABEL?>",
        DOPBSP_RESERVATIONS_PHONE_LABEL = "<?php echo DOPBSP_RESERVATIONS_PHONE_LABEL?>",
        DOPBSP_RESERVATIONS_NO_PEOPLE_LABEL = "<?php echo DOPBSP_RESERVATIONS_NO_PEOPLE_LABEL?>",
        DOPBSP_RESERVATIONS_NO_CHILDREN_LABEL = "<?php echo DOPBSP_RESERVATIONS_NO_CHILDREN_LABEL?>",
        DOPBSP_RESERVATIONS_MESSAGE_LABEL = "<?php echo DOPBSP_RESERVATIONS_MESSAGE_LABEL?>",
    
        DOPBSP_RESERVATIONS_JUMP_TO_DAY_LABEL = "<?php echo DOPBSP_RESERVATIONS_JUMP_TO_DAY_LABEL?>",
        DOPBSP_RESERVATIONS_APPROVE_LABEL = "<?php echo DOPBSP_RESERVATIONS_APPROVE_LABEL?>",
        DOPBSP_RESERVATIONS_REJECT_LABEL = "<?php echo DOPBSP_RESERVATIONS_REJECT_LABEL?>",
        DOPBSP_RESERVATIONS_CANCEL_LABEL = "<?php echo DOPBSP_RESERVATIONS_CANCEL_LABEL?>",
    
        DOPBSP_RESERVATIONS_APPROVE_CONFIRMATION = "<?php echo DOPBSP_RESERVATIONS_APPROVE_CONFIRMATION?>",
        DOPBSP_RESERVATIONS_APPROVE_SUCCESS = "<?php echo DOPBSP_RESERVATIONS_APPROVE_SUCCESS?>",
        DOPBSP_RESERVATIONS_REJECT_CONFIRMATION = "<?php echo DOPBSP_RESERVATIONS_REJECT_CONFIRMATION?>",
        DOPBSP_RESERVATIONS_REJECT_SUCCESS = "<?php echo DOPBSP_RESERVATIONS_REJECT_SUCCESS?>",
        DOPBSP_RESERVATIONS_CANCEL_CONFIRMATION = "<?php echo DOPBSP_RESERVATIONS_CANCEL_CONFIRMATION?>",
        DOPBSP_RESERVATIONS_CANCEL_SUCCESS = "<?php echo DOPBSP_RESERVATIONS_CANCEL_SUCCESS?>",
    
        // Email
        DOPBSP_EMAIL_APPROVED_SUBJECT = "<?php echo DOPBSP_EMAIL_APPROVED_SUBJECT?>",
        DOPBSP_EMAIL_APPROVED_MESSAGE = "<?php echo DOPBSP_EMAIL_APPROVED_MESSAGE?>", 
        
        DOPBSP_EMAIL_REJECTED_SUBJECT = "<?php echo DOPBSP_EMAIL_REJECTED_SUBJECT?>", 
        DOPBSP_EMAIL_REJECTED_MESSAGE = "<?php echo DOPBSP_EMAIL_REJECTED_MESSAGE?>", 
        
        DOPBSP_EMAIL_CANCELED_SUBJECT = "<?php echo DOPBSP_EMAIL_CANCELED_SUBJECT?>", 
        DOPBSP_EMAIL_CANCELED_MESSAGE = "<?php echo DOPBSP_EMAIL_CANCELED_MESSAGE?>",
            
        // TinyMCE
        DOPBSP_TINYMCE_ADD = "<?php echo DOPBSP_TINYMCE_ADD?>",

        // Settings
        DOPBSP_GENERAL_STYLES_SETTINGS = "<?php echo DOPBSP_GENERAL_STYLES_SETTINGS?>",
        DOPBSP_CALENDAR_NAME = "<?php echo DOPBSP_CALENDAR_NAME?>",
        DOPBSP_AVAILABLE_DAYS = "<?php echo DOPBSP_AVAILABLE_DAYS?>",
        DOPBSP_CURRENCY = "<?php echo DOPBSP_CURRENCY?>",
        DOPBSP_DATE_TYPE = "<?php echo DOPBSP_DATE_TYPE?>",
        DOPBSP_PREDEFINED = "<?php echo DOPBSP_PREDEFINED?>",
        DOPBSP_TEMPLATE = "<?php echo DOPBSP_TEMPLATE?>",
        DOPBSP_MIN_STAY = "<?php echo DOPBSP_MIN_STAY?>",
        DOPBSP_MAX_STAY = "<?php echo DOPBSP_MAX_STAY?>",
        DOPBSP_PAGE_URL = "<?php echo DOPBSP_PAGE_URL?>",
        
        DOPBSP_NOTIFICATIONS_STYLES_SETTINGS = "<?php echo DOPBSP_NOTIFICATIONS_STYLES_SETTINGS?>",
        DOPBSP_NOTIFICATIONS_TEMPLATE = "<?php echo DOPBSP_NOTIFICATIONS_TEMPLATE?>",
        DOPBSP_NOTIFICATIONS_EMAIL = "<?php echo DOPBSP_NOTIFICATIONS_EMAIL?>",
        DOPBSP_NOTIFICATIONS_SMTP_ENABLED = "<?php echo DOPBSP_NOTIFICATIONS_SMTP_ENABLED?>",
        DOPBSP_NOTIFICATIONS_SMTP_HOST_NAME = "<?php echo DOPBSP_NOTIFICATIONS_SMTP_HOST_NAME?>",
        DOPBSP_NOTIFICATIONS_SMTP_HOST_PORT = "<?php echo DOPBSP_NOTIFICATIONS_SMTP_HOST_PORT?>",
        DOPBSP_NOTIFICATIONS_SMTP_SSL = "<?php echo DOPBSP_NOTIFICATIONS_SMTP_SSL?>",
        DOPBSP_NOTIFICATIONS_SMTP_USER = "<?php echo DOPBSP_NOTIFICATIONS_SMTP_USER?>",
        DOPBSP_NOTIFICATIONS_SMTP_PASSWORD = "<?php echo DOPBSP_NOTIFICATIONS_SMTP_PASSWORD?>",
        
        DOPBSP_HOURS_STYLES_SETTINGS = "<?php echo DOPBSP_HOURS_STYLES_SETTINGS?>",
        DOPBSP_MULTIPLE_DAYS_SELECT = "<?php echo DOPBSP_MULTIPLE_DAYS_SELECT?>",
        DOPBSP_MORNING_CHECK_OUT = "<?php echo DOPBSP_MORNING_CHECK_OUT?>",
        DOPBSP_HOURS_ENABLED = "<?php echo DOPBSP_HOURS_ENABLED?>",
        DOPBSP_HOURS_DEFINITIONS = "<?php echo DOPBSP_HOURS_DEFINITIONS?>",
        DOPBSP_MULTIPLE_HOURS_SELECT = "<?php echo DOPBSP_MULTIPLE_HOURS_SELECT?>",
        DOPBSP_HOURS_AMPM = "<?php echo DOPBSP_HOURS_AMPM?>",
        
        DOPBSP_DISCOUNTS_NO_DAYS_SETTINGS = "<?php echo DOPBSP_DISCOUNTS_NO_DAYS_SETTINGS?>",
        DOPBSP_DISCOUNTS_NO_DAYS = "<?php echo DOPBSP_DISCOUNTS_NO_DAYS?>",
        DOPBSP_DISCOUNTS_NO_DAYS_DAYS = "<?php echo DOPBSP_DISCOUNTS_NO_DAYS_DAYS?>",
        
        DOPBSP_DEPOSIT_SETTINGS = "<?php echo DOPBSP_DEPOSIT_SETTINGS?>",
        DOPBSP_DEPOSIT = "<?php echo DOPBSP_DEPOSIT?>",
        
        DOPBSP_FORM_STYLES_SETTINGS = "<?php echo DOPBSP_FORM_STYLES_SETTINGS?>",
        DOPBSP_NAME_ENABLED = "<?php echo DOPBSP_NAME_ENABLED?>",
        DOPBSP_EMAIL_ENABLED = "<?php echo DOPBSP_EMAIL_ENABLED?>",
        DOPBSP_PHONE_ENABLED = "<?php echo DOPBSP_PHONE_ENABLED?>",
        DOPBSP_NO_PEOPLE_ENABLED = "<?php echo DOPBSP_NO_PEOPLE_ENABLED?>",
        DOPBSP_MIN_NO_PEOPLE = "<?php echo DOPBSP_MIN_NO_PEOPLE?>",
        DOPBSP_MAX_NO_PEOPLE = "<?php echo DOPBSP_MAX_NO_PEOPLE?>",
        DOPBSP_NO_CHILDREN_ENABLED = "<?php echo DOPBSP_NO_CHILDREN_ENABLED?>",
        DOPBSP_MIN_NO_CHILDREN = "<?php echo DOPBSP_MIN_NO_CHILDREN?>",
        DOPBSP_MAX_NO_CHILDREN = "<?php echo DOPBSP_MAX_NO_CHILDREN?>",
        DOPBSP_MESSAGE_ENABLED = "<?php echo DOPBSP_MESSAGE_ENABLED?>",
        DOPBSP_PAYMENT_ARRIVAL_ENABLED = "<?php echo DOPBSP_PAYMENT_ARRIVAL_ENABLED?>",
        
        DOPBSP_PAYMENT_PAYPAL_STYLES_SETTINGS = "<?php echo DOPBSP_PAYMENT_PAYPAL_STYLES_SETTINGS?>",
        DOPBSP_PAYMENT_PAYPAL_ENABLED = "<?php echo DOPBSP_PAYMENT_PAYPAL_ENABLED?>",
        DOPBSP_PAYMENT_PAYPAL_USERNAME = "<?php echo DOPBSP_PAYMENT_PAYPAL_USERNAME?>",
        DOPBSP_PAYMENT_PAYPAL_PASSWORD = "<?php echo DOPBSP_PAYMENT_PAYPAL_PASSWORD?>",
        DOPBSP_PAYMENT_PAYPAL_SIGNATURE = "<?php echo DOPBSP_PAYMENT_PAYPAL_SIGNATURE?>",
        DOPBSP_PAYMENT_PAYPAL_SANDBOX_ENABLED = "<?php echo DOPBSP_PAYMENT_PAYPAL_SANDBOX_ENABLED?>",
        
        DOPBSP_TERMS_AND_CONDITIONS_ENABLED = "<?php echo DOPBSP_TERMS_AND_CONDITIONS_ENABLED?>",
        DOPBSP_TERMS_AND_CONDITIONS_LINK = "<?php echo DOPBSP_TERMS_AND_CONDITIONS_LINK?>",
    
        DOPBSP_GO_TOP = "<?php echo DOPBSP_GO_TOP?>",
        
        // Settings Info
        DOPBSP_CALENDAR_NAME_INFO = "<?php echo DOPBSP_CALENDAR_NAME_INFO?>",
        DOPBSP_AVAILABLE_DAYS_INFO = "<?php echo DOPBSP_AVAILABLE_DAYS_INFO?>",
        DOPBSP_CURRENCY_INFO = "<?php echo DOPBSP_CURRENCY_INFO?>",
        DOPBSP_DATE_TYPE_INFO = "<?php echo DOPBSP_DATE_TYPE_INFO?>",
        DOPBSP_PREDEFINED_INFO = "<?php echo DOPBSP_PREDEFINED_INFO?>",
        DOPBSP_TEMPLATE_INFO = "<?php echo DOPBSP_TEMPLATE_INFO?>",
        DOPBSP_MIN_STAY_INFO = "<?php echo DOPBSP_MIN_STAY_INFO?>",
        DOPBSP_MAX_STAY_INFO = "<?php echo DOPBSP_MAX_STAY_INFO?>",
        DOPBSP_PAGE_URL_INFO = "<?php echo DOPBSP_PAGE_URL_INFO?>",
        
        DOPBSP_NOTIFICATIONS_TEMPLATE_INFO = "<?php echo DOPBSP_NOTIFICATIONS_TEMPLATE_INFO?>",
        DOPBSP_NOTIFICATIONS_EMAIL_INFO = "<?php echo DOPBSP_NOTIFICATIONS_EMAIL_INFO?>",
        DOPBSP_NOTIFICATIONS_SMTP_ENABLED_INFO = "<?php echo DOPBSP_NOTIFICATIONS_SMTP_ENABLED_INFO?>",
        DOPBSP_NOTIFICATIONS_SMTP_HOST_NAME_INFO = "<?php echo DOPBSP_NOTIFICATIONS_SMTP_HOST_NAME_INFO?>",
        DOPBSP_NOTIFICATIONS_SMTP_HOST_PORT_INFO = "<?php echo DOPBSP_NOTIFICATIONS_SMTP_HOST_PORT_INFO?>",
        DOPBSP_NOTIFICATIONS_SMTP_SSL_INFO = "<?php echo DOPBSP_NOTIFICATIONS_SMTP_SSL_INFO?>",
        DOPBSP_NOTIFICATIONS_SMTP_USER_INFO = "<?php echo DOPBSP_NOTIFICATIONS_SMTP_USER_INFO?>",
        DOPBSP_NOTIFICATIONS_SMTP_PASSWORD_INFO = "<?php echo DOPBSP_NOTIFICATIONS_SMTP_PASSWORD_INFO?>",
        
        DOPBSP_MULTIPLE_DAYS_SELECT_INFO = "<?php echo DOPBSP_MULTIPLE_DAYS_SELECT_INFO?>",
        DOPBSP_MORNING_CHECK_OUT_INFO = "<?php echo DOPBSP_MORNING_CHECK_OUT_INFO?>",
        DOPBSP_HOURS_ENABLED_INFO = "<?php echo DOPBSP_HOURS_ENABLED_INFO?>",
        DOPBSP_HOURS_DEFINITIONS_INFO = "<?php echo DOPBSP_HOURS_DEFINITIONS_INFO?>",
        DOPBSP_MULTIPLE_HOURS_SELECT_INFO = "<?php echo DOPBSP_MULTIPLE_HOURS_SELECT_INFO?>",
        DOPBSP_HOURS_AMPM_INFO = "<?php echo DOPBSP_HOURS_AMPM_INFO?>",
        
        DOPBSP_DISCOUNTS_NO_DAYS_INFO = "<?php echo DOPBSP_DISCOUNTS_NO_DAYS_INFO?>",
        DOPBSP_DISCOUNTS_NO_DAYS_DAYS_INFO = "<?php echo DOPBSP_DISCOUNTS_NO_DAYS_DAYS_INFO?>",
        
        DOPBSP_DEPOSIT_INFO = "<?php echo DOPBSP_DEPOSIT_INFO?>",
        
        DOPBSP_NAME_ENABLED_INFO = "<?php echo DOPBSP_NAME_ENABLED_INFO?>",
        DOPBSP_EMAIL_ENABLED_INFO = "<?php echo DOPBSP_EMAIL_ENABLED_INFO?>",
        DOPBSP_PHONE_ENABLED_INFO = "<?php echo DOPBSP_PHONE_ENABLED_INFO?>",
        DOPBSP_NO_PEOPLE_ENABLED_INFO = "<?php echo DOPBSP_NO_PEOPLE_ENABLED_INFO?>",
        DOPBSP_MIN_NO_PEOPLE_INFO = "<?php echo DOPBSP_MIN_NO_PEOPLE_INFO?>",
        DOPBSP_MAX_NO_PEOPLE_INFO = "<?php echo DOPBSP_MAX_NO_PEOPLE_INFO?>",
        DOPBSP_NO_CHILDREN_ENABLED_INFO = "<?php echo DOPBSP_NO_CHILDREN_ENABLED_INFO?>",
        DOPBSP_MIN_NO_CHILDREN_INFO = "<?php echo DOPBSP_MIN_NO_CHILDREN_INFO?>",
        DOPBSP_MAX_NO_CHILDREN_INFO = "<?php echo DOPBSP_MAX_NO_CHILDREN_INFO?>",
        DOPBSP_MESSAGE_ENABLED_INFO = "<?php echo DOPBSP_MESSAGE_ENABLED_INFO?>",
        DOPBSP_PAYMENT_ARRIVAL_ENABLED_INFO = "<?php echo DOPBSP_PAYMENT_ARRIVAL_ENABLED_INFO?>",
        
        DOPBSP_PAYMENT_PAYPAL_ENABLED_INFO = "<?php echo DOPBSP_PAYMENT_PAYPAL_ENABLED_INFO?>",   
        DOPBSP_PAYMENT_PAYPAL_USERNAME_INFO = "<?php echo DOPBSP_PAYMENT_PAYPAL_USERNAME_INFO?>",
        DOPBSP_PAYMENT_PAYPAL_PASSWORD_INFO = "<?php echo DOPBSP_PAYMENT_PAYPAL_PASSWORD_INFO?>",  
        DOPBSP_PAYMENT_PAYPAL_SIGNATURE_INFO = "<?php echo DOPBSP_PAYMENT_PAYPAL_SIGNATURE_INFO?>",
        DOPBSP_PAYMENT_PAYPAL_SANDBOX_ENABLED_INFO = "<?php echo DOPBSP_PAYMENT_PAYPAL_SANDBOX_ENABLED_INFO?>",
        
        DOPBSP_TERMS_AND_CONDITIONS_ENABLED_INFO = "<?php echo DOPBSP_TERMS_AND_CONDITIONS_ENABLED_INFO?>",
        DOPBSP_TERMS_AND_CONDITIONS_LINK_INFO = "<?php echo DOPBSP_TERMS_AND_CONDITIONS_LINK_INFO?>",
        
        // Settings
        DOPBSP_TITLE_SETTINGS = "<?php echo DOPBSP_TITLE_SETTINGS?>",
    
        DOPBSP_USERS_PERMISSIONS = "<?php echo DOPBSP_USERS_PERMISSIONS?>",
        DOPBSP_USERS_ADMINISTRATORS = "<?php echo DOPBSP_USERS_ADMINISTRATORS?>",
        DOPBSP_USERS_AUTHORS = "<?php echo DOPBSP_USERS_AUTHORS?>",
        DOPBSP_USERS_CONTRIBUTORS = "<?php echo DOPBSP_USERS_CONTRIBUTORS?>",
        DOPBSP_USERS_EDITORS = "<?php echo DOPBSP_USERS_EDITORS?>",
        DOPBSP_USERS_SUBSCRIBERS = "<?php echo DOPBSP_USERS_SUBSCRIBERS?>";    
    </script>
    <div class="wrap DOPBSP-admin">
        <h2><?php echo DOPBSP_TITLE?></h2>
        <div id="DOPBSP-admin-message"></div>
        <select id="DOPBSP-admin-translation" onchange="dopbspChangeTranslation()">
            <option value="af"<?php echo isset($_COOKIE["DOPBookingSystemPROBackEndLanguage"]) && $_COOKIE["DOPBookingSystemPROBackEndLanguage"] == 'af' ? ' selected="selected"':''?>>Afrikaans (Afrikaans)</option>
            <option value="al"<?php echo isset($_COOKIE["DOPBookingSystemPROBackEndLanguage"]) && $_COOKIE["DOPBookingSystemPROBackEndLanguage"] == 'al' ? ' selected="selected"':''?>>Albanian (Shqiptar)</option>
            <option value="ar"<?php echo isset($_COOKIE["DOPBookingSystemPROBackEndLanguage"]) && $_COOKIE["DOPBookingSystemPROBackEndLanguage"] == 'ar' ? ' selected="selected"':''?>>Arabic (>العربية)</option>
            <option value="az"<?php echo isset($_COOKIE["DOPBookingSystemPROBackEndLanguage"]) && $_COOKIE["DOPBookingSystemPROBackEndLanguage"] == 'az' ? ' selected="selected"':''?>>Azerbaijani (Azərbaycan)</option>
            <option value="bs"<?php echo isset($_COOKIE["DOPBookingSystemPROBackEndLanguage"]) && $_COOKIE["DOPBookingSystemPROBackEndLanguage"] == 'bs' ? ' selected="selected"':''?>>Basque (Euskal)</option>
            <option value="by"<?php echo isset($_COOKIE["DOPBookingSystemPROBackEndLanguage"]) && $_COOKIE["DOPBookingSystemPROBackEndLanguage"] == 'by' ? ' selected="selected"':''?>>Belarusian (Беларускай)</option>
            <option value="bg"<?php echo isset($_COOKIE["DOPBookingSystemPROBackEndLanguage"]) && $_COOKIE["DOPBookingSystemPROBackEndLanguage"] == 'bg' ? ' selected="selected"':''?>>Bulgarian (Български)</option>
            <option value="ca"<?php echo isset($_COOKIE["DOPBookingSystemPROBackEndLanguage"]) && $_COOKIE["DOPBookingSystemPROBackEndLanguage"] == 'ca' ? ' selected="selected"':''?>>Catalan (Català)</option>
            <option value="cn"<?php echo isset($_COOKIE["DOPBookingSystemPROBackEndLanguage"]) && $_COOKIE["DOPBookingSystemPROBackEndLanguage"] == 'cn' ? ' selected="selected"':''?>>Chinese (中国的)</option>
            <option value="cr"<?php echo isset($_COOKIE["DOPBookingSystemPROBackEndLanguage"]) && $_COOKIE["DOPBookingSystemPROBackEndLanguage"] == 'cr' ? ' selected="selected"':''?>>Croatian (Hrvatski)</option>
            <option value="cz"<?php echo isset($_COOKIE["DOPBookingSystemPROBackEndLanguage"]) && $_COOKIE["DOPBookingSystemPROBackEndLanguage"] == 'cz' ? ' selected="selected"':''?>>Czech (Český)</option>
            <option value="dk"<?php echo isset($_COOKIE["DOPBookingSystemPROBackEndLanguage"]) && $_COOKIE["DOPBookingSystemPROBackEndLanguage"] == 'dk' ? ' selected="selected"':''?>>Danish (Dansk)</option>
            <option value="du"<?php echo isset($_COOKIE["DOPBookingSystemPROBackEndLanguage"]) && $_COOKIE["DOPBookingSystemPROBackEndLanguage"] == 'du' ? ' selected="selected"':''?>>Dutch (Nederlands)</option>
            <option value="en"<?php echo (isset($_COOKIE["DOPBookingSystemPROBackEndLanguage"]) && $_COOKIE["DOPBookingSystemPROBackEndLanguage"] == 'en') || !isset($_COOKIE["DOPBookingSystemPROBackEndLanguage"]) ? ' selected="selected"':''?>>English</option>
            <option value="eo"<?php echo isset($_COOKIE["DOPBookingSystemPROBackEndLanguage"]) && $_COOKIE["DOPBookingSystemPROBackEndLanguage"] == 'eo' ? ' selected="selected"':''?>>Esperanto (Esperanto)</option>
            <option value="et"<?php echo isset($_COOKIE["DOPBookingSystemPROBackEndLanguage"]) && $_COOKIE["DOPBookingSystemPROBackEndLanguage"] == 'et' ? ' selected="selected"':''?>>Estonian (Eesti)</option>
            <option value="fl"<?php echo isset($_COOKIE["DOPBookingSystemPROBackEndLanguage"]) && $_COOKIE["DOPBookingSystemPROBackEndLanguage"] == 'fl' ? ' selected="selected"':''?>>Filipino (na Filipino)</option>
            <option value="fi"<?php echo isset($_COOKIE["DOPBookingSystemPROBackEndLanguage"]) && $_COOKIE["DOPBookingSystemPROBackEndLanguage"] == 'fi' ? ' selected="selected"':''?>>Finnish (Suomi)</option>
            <option value="fr"<?php echo isset($_COOKIE["DOPBookingSystemPROBackEndLanguage"]) && $_COOKIE["DOPBookingSystemPROBackEndLanguage"] == 'fr' ? ' selected="selected"':''?>>French (Français)</option>
            <option value="gl"<?php echo isset($_COOKIE["DOPBookingSystemPROBackEndLanguage"]) && $_COOKIE["DOPBookingSystemPROBackEndLanguage"] == 'gl' ? ' selected="selected"':''?>>Galician (Galego)</option>
            <option value="de"<?php echo isset($_COOKIE["DOPBookingSystemPROBackEndLanguage"]) && $_COOKIE["DOPBookingSystemPROBackEndLanguage"] == 'de' ? ' selected="selected"':''?>>German (Deutsch)</option>
            <option value="gr"<?php echo isset($_COOKIE["DOPBookingSystemPROBackEndLanguage"]) && $_COOKIE["DOPBookingSystemPROBackEndLanguage"] == 'gr' ? ' selected="selected"':''?>>Greek (Ɛλληνικά)</option>
            <option value="ha"<?php echo isset($_COOKIE["DOPBookingSystemPROBackEndLanguage"]) && $_COOKIE["DOPBookingSystemPROBackEndLanguage"] == 'ha' ? ' selected="selected"':''?>>Haitian Creole (Kreyòl Ayisyen)</option>
            <option value="he"<?php echo isset($_COOKIE["DOPBookingSystemPROBackEndLanguage"]) && $_COOKIE["DOPBookingSystemPROBackEndLanguage"] == 'he' ? ' selected="selected"':''?>>Hebrew (עברית)</option>
            <option value="hi"<?php echo isset($_COOKIE["DOPBookingSystemPROBackEndLanguage"]) && $_COOKIE["DOPBookingSystemPROBackEndLanguage"] == 'hi' ? ' selected="selected"':''?>>Hindi (हिंदी)</option>
            <option value="hu"<?php echo isset($_COOKIE["DOPBookingSystemPROBackEndLanguage"]) && $_COOKIE["DOPBookingSystemPROBackEndLanguage"] == 'hu' ? ' selected="selected"':''?>>Hungarian (Magyar)</option>
            <option value="is"<?php echo isset($_COOKIE["DOPBookingSystemPROBackEndLanguage"]) && $_COOKIE["DOPBookingSystemPROBackEndLanguage"] == 'is' ? ' selected="selected"':''?>>Icelandic (Íslenska)</option>
            <option value="id"<?php echo isset($_COOKIE["DOPBookingSystemPROBackEndLanguage"]) && $_COOKIE["DOPBookingSystemPROBackEndLanguage"] == 'id' ? ' selected="selected"':''?>>Indonesian (Indonesia)</option>
            <option value="ir"<?php echo isset($_COOKIE["DOPBookingSystemPROBackEndLanguage"]) && $_COOKIE["DOPBookingSystemPROBackEndLanguage"] == 'ir' ? ' selected="selected"':''?>>Irish (Gaeilge)</option>
            <option value="it"<?php echo isset($_COOKIE["DOPBookingSystemPROBackEndLanguage"]) && $_COOKIE["DOPBookingSystemPROBackEndLanguage"] == 'it' ? ' selected="selected"':''?>>Italian (Italiano)</option>
            <option value="ja"<?php echo isset($_COOKIE["DOPBookingSystemPROBackEndLanguage"]) && $_COOKIE["DOPBookingSystemPROBackEndLanguage"] == 'ja' ? ' selected="selected"':''?>>Japanese (日本の)</option>
            <option value="ko"<?php echo isset($_COOKIE["DOPBookingSystemPROBackEndLanguage"]) && $_COOKIE["DOPBookingSystemPROBackEndLanguage"] == 'ko' ? ' selected="selected"':''?>>Korean (한국의)</option>            
            <option value="lv"<?php echo isset($_COOKIE["DOPBookingSystemPROBackEndLanguage"]) && $_COOKIE["DOPBookingSystemPROBackEndLanguage"] == 'lv' ? ' selected="selected"':''?>>Latvian (Latvijas)</option>
            <option value="lt"<?php echo isset($_COOKIE["DOPBookingSystemPROBackEndLanguage"]) && $_COOKIE["DOPBookingSystemPROBackEndLanguage"] == 'lt' ? ' selected="selected"':''?>>Lithuanian (Lietuvos)</option>            
            <option value="mk"<?php echo isset($_COOKIE["DOPBookingSystemPROBackEndLanguage"]) && $_COOKIE["DOPBookingSystemPROBackEndLanguage"] == 'mk' ? ' selected="selected"':''?>>Macedonian (македонски)</option>
            <option value="mg"<?php echo isset($_COOKIE["DOPBookingSystemPROBackEndLanguage"]) && $_COOKIE["DOPBookingSystemPROBackEndLanguage"] == 'mg' ? ' selected="selected"':''?>>Malay (Melayu)</option>
            <option value="ma"<?php echo isset($_COOKIE["DOPBookingSystemPROBackEndLanguage"]) && $_COOKIE["DOPBookingSystemPROBackEndLanguage"] == 'ma' ? ' selected="selected"':''?>>Maltese (Maltija)</option>
            <option value="no"<?php echo isset($_COOKIE["DOPBookingSystemPROBackEndLanguage"]) && $_COOKIE["DOPBookingSystemPROBackEndLanguage"] == 'no' ? ' selected="selected"':''?>>Norwegian (Norske)</option>            
            <option value="pe"<?php echo isset($_COOKIE["DOPBookingSystemPROBackEndLanguage"]) && $_COOKIE["DOPBookingSystemPROBackEndLanguage"] == 'pe' ? ' selected="selected"':''?>>Persian (فارسی)</option>
            <option value="pl"<?php echo isset($_COOKIE["DOPBookingSystemPROBackEndLanguage"]) && $_COOKIE["DOPBookingSystemPROBackEndLanguage"] == 'pl' ? ' selected="selected"':''?>>Polish (Polski)</option>
            <option value="pt"<?php echo isset($_COOKIE["DOPBookingSystemPROBackEndLanguage"]) && $_COOKIE["DOPBookingSystemPROBackEndLanguage"] == 'pt' ? ' selected="selected"':''?>>Portuguese (Português)</option>
            <option value="ro"<?php echo isset($_COOKIE["DOPBookingSystemPROBackEndLanguage"]) && $_COOKIE["DOPBookingSystemPROBackEndLanguage"] == 'ro' ? ' selected="selected"':''?>>Romanian (Română)</option>
            <option value="ru"<?php echo isset($_COOKIE["DOPBookingSystemPROBackEndLanguage"]) && $_COOKIE["DOPBookingSystemPROBackEndLanguage"] == 'ru' ? ' selected="selected"':''?>>Russian (Pусский)</option>
            <option value="sr"<?php echo isset($_COOKIE["DOPBookingSystemPROBackEndLanguage"]) && $_COOKIE["DOPBookingSystemPROBackEndLanguage"] == 'sr' ? ' selected="selected"':''?>>Serbian (Cрпски)</option>
            <option value="sk"<?php echo isset($_COOKIE["DOPBookingSystemPROBackEndLanguage"]) && $_COOKIE["DOPBookingSystemPROBackEndLanguage"] == 'sk' ? ' selected="selected"':''?>>Slovak (Slovenských)</option>
            <option value="sl"<?php echo isset($_COOKIE["DOPBookingSystemPROBackEndLanguage"]) && $_COOKIE["DOPBookingSystemPROBackEndLanguage"] == 'sl' ? ' selected="selected"':''?>>Slovenian (Slovenski)</option>
            <option value="sp"<?php echo isset($_COOKIE["DOPBookingSystemPROBackEndLanguage"]) && $_COOKIE["DOPBookingSystemPROBackEndLanguage"] == 'sp' ? ' selected="selected"':''?>>Spanish (Español)</option>
            <option value="sw"<?php echo isset($_COOKIE["DOPBookingSystemPROBackEndLanguage"]) && $_COOKIE["DOPBookingSystemPROBackEndLanguage"] == 'sw' ? ' selected="selected"':''?>>Swahili (Kiswahili)</option>
            <option value="se"<?php echo isset($_COOKIE["DOPBookingSystemPROBackEndLanguage"]) && $_COOKIE["DOPBookingSystemPROBackEndLanguage"] == 'se' ? ' selected="selected"':''?>>Swedish (Svenskt)</option>
            <option value="th"<?php echo isset($_COOKIE["DOPBookingSystemPROBackEndLanguage"]) && $_COOKIE["DOPBookingSystemPROBackEndLanguage"] == 'th' ? ' selected="selected"':''?>>Thai (ภาษาไทย)</option>
            <option value="tr"<?php echo isset($_COOKIE["DOPBookingSystemPROBackEndLanguage"]) && $_COOKIE["DOPBookingSystemPROBackEndLanguage"] == 'tr' ? ' selected="selected"':''?>>Turkish (Türk)</option>
            <option value="uk"<?php echo isset($_COOKIE["DOPBookingSystemPROBackEndLanguage"]) && $_COOKIE["DOPBookingSystemPROBackEndLanguage"] == 'uk' ? ' selected="selected"':''?>>Ukrainian (Український)</option>
            <option value="ur"<?php echo isset($_COOKIE["DOPBookingSystemPROBackEndLanguage"]) && $_COOKIE["DOPBookingSystemPROBackEndLanguage"] == 'ur' ? ' selected="selected"':''?>>Urdu (اردو)</option>
            <option value="vi"<?php echo isset($_COOKIE["DOPBookingSystemPROBackEndLanguage"]) && $_COOKIE["DOPBookingSystemPROBackEndLanguage"] == 'vi' ? ' selected="selected"':''?>>Vietnamese (Việt)</option>
            <option value="we"<?php echo isset($_COOKIE["DOPBookingSystemPROBackEndLanguage"]) && $_COOKIE["DOPBookingSystemPROBackEndLanguage"] == 'we' ? ' selected="selected"':''?>>Welsh (Cymraeg)</option>
            <option value="yi"<?php echo isset($_COOKIE["DOPBookingSystemPROBackEndLanguage"]) && $_COOKIE["DOPBookingSystemPROBackEndLanguage"] == 'yi' ? ' selected="selected"':''?>>Yiddish (ייִדיש)</option>
        </select>
        <input type="hidden" id="calendar_id" value="" />
        <br class="DOPBSP-clear" />
        <div class="main">
            <div class="column column1">
                <div class="column-header">
                    <div class="add-button" id="DOPBSP-add-calendar-btn">
                        <a href="javascript:dopbspAddCalendar()" title="<?php echo DOPBSP_ADD_CALENDAR_SUBMIT?>"></a>
                    </div>
                    <a href="javascript:void()" class="header-help" title="<?php echo DOPBSP_CALENDARS_HELP?>"></a>                    
                </div>
                <div class="column-content-container">
                    <div class="column-content">
                        &nbsp;
                    </div>
                </div>
            </div>
            <div class="column-separator"></div>
            <div class="column column2">
                <div class="column-header"></div>
                <div class="column-content-container">
                    <div class="column-content">
                        &nbsp;
                    </div>
                </div>
            </div>
            <div class="column-separator"></div>
            <div class="column column3">
                <div class="column-header"></div>
                <div class="column-content-container">
                    <div class="column-content">
                        &nbsp;
                    </div>
                </div>
            </div>
        </div>
        <br class="DOPBSP-clear" />
    </div>
<?php
            }

            function settings(){// Settings Template
?>
    <script type="text/JavaScript">
        var DOPBSP_curr_page = "Settings",
        DOPBSP_plugin_url = "<?php echo WP_PLUGIN_URL.'/dopbsp/'?>",
        DOPBSP_plugin_abs = "<?php echo ABSPATH.'wp-content/plugins/dopbsp/'?>",

        DOPBSP_TITLE = "<?php echo DOPBSP_TITLE?>",

        // Loading ...
        DOPBSP_LOAD = "<?php echo DOPBSP_LOAD?>",
        
        // Save ...
        DOPBSP_SAVE = "<?php echo DOPBSP_SAVE?>",
        DOPBSP_SAVE_SUCCESS = "<?php echo DOPBSP_SAVE_SUCCESS?>",
                
        // Months & Week Days
        DOPBSP_month_names = [<?php            
        global $DOPBSP_month_names;
        
        for ($i=0; $i<count($DOPBSP_month_names); $i++){
            if ($i == 0){
                echo '"'.$DOPBSP_month_names[$i].'"';
            }
            else{
                echo ', "'.$DOPBSP_month_names[$i].'"';                
            }
        }
?>],     
        DOPBSP_day_names = [<?php            
        global $DOPBSP_day_names;
        
        for ($i=0; $i<count($DOPBSP_day_names); $i++){
            if ($i == 0){
                echo '"'.$DOPBSP_day_names[$i].'"';
            }
            else{
                echo ', "'.$DOPBSP_day_names[$i].'"';                
            }
        }
?>],

        // Help
        DOPBSP_CALENDARS_HELP = "<?php echo DOPBSP_CALENDARS_HELP?>",
        DOPBSP_CALENDAR_EDIT_HELP = "<?php echo DOPBSP_CALENDAR_EDIT_HELP?>",
        DOPBSP_CALENDAR_EDIT_SETTINGS_HELP = "<?php echo DOPBSP_CALENDAR_EDIT_SETTINGS_HELP?>",

        // Form
        DOPBSP_SUBMIT = "<?php echo DOPBSP_SUBMIT?>",
        DOPBSP_DELETE = "<?php echo DOPBSP_DELETE?>",
        DOPBSP_BACK = "<?php echo DOPBSP_BACK?>",
        DOPBSP_BACK_SUBMIT = "<?php echo DOPBSP_BACK_SUBMIT?>",
        DOPBSP_ENABLED = "<?php echo DOPBSP_ENABLED?>",
        DOPBSP_DISABLED = "<?php echo DOPBSP_DISABLED?>",
        DOPBSP_DATE_TYPE_AMERICAN = "<?php echo DOPBSP_DATE_TYPE_AMERICAN?>",
        DOPBSP_DATE_TYPE_EUROPEAN = "<?php echo DOPBSP_DATE_TYPE_EUROPEAN?>",
        
        // Calendars    
        DOPBSP_SHOW_CALENDARS = "<?php echo DOPBSP_SHOW_CALENDARS?>",
        DOPBSP_CALENDARS_LOADED = "<?php echo DOPBSP_CALENDARS_LOADED?>",
        DOPBSP_CALENDAR_LOADED = "<?php echo DOPBSP_CALENDAR_LOADED?>",
        DOPBSP_NO_CALENDARS = "<?php echo DOPBSP_NO_CALENDARS?>",
        
        // Calendar 
        DOPBSP_ADD_MONTH_VIEW = "<?php echo DOPBSP_ADD_MONTH_VIEW?>",
        DOPBSP_REMOVE_MONTH_VIEW = "<?php echo DOPBSP_REMOVE_MONTH_VIEW?>",
        DOPBSP_PREVIOUS_MONTH = "<?php echo DOPBSP_PREVIOUS_MONTH?>",
        DOPBSP_NEXT_MONTH = "<?php echo DOPBSP_NEXT_MONTH?>",
        DOPBSP_AVAILABLE_ONE_TEXT = "<?php echo DOPBSP_AVAILABLE_ONE_TEXT?>",
        DOPBSP_AVAILABLE_TEXT = "<?php echo DOPBSP_AVAILABLE_TEXT?>",
        DOPBSP_BOOKED_TEXT = "<?php echo DOPBSP_BOOKED_TEXT?>",
        DOPBSP_UNAVAILABLE_TEXT = "<?php echo DOPBSP_UNAVAILABLE_TEXT?>",
                                    
        // Calendar Form 
        DOPBSP_DATE_START_LABEL = "<?php echo DOPBSP_DATE_START_LABEL?>",
        DOPBSP_DATE_START_LABEL = "<?php echo DOPBSP_DATE_START_LABEL?>",
        DOPBSP_DATE_END_LABEL = "<?php echo DOPBSP_DATE_END_LABEL?>",
        DOPBSP_STATUS_LABEL = "<?php echo DOPBSP_STATUS_LABEL?>",
        DOPBSP_STATUS_AVAILABLE_TEXT = "<?php echo DOPBSP_STATUS_AVAILABLE_TEXT?>",
        DOPBSP_STATUS_BOOKED_TEXT = "<?php echo DOPBSP_STATUS_BOOKED_TEXT?>",
        DOPBSP_STATUS_SPECIAL_TEXT = "<?php echo DOPBSP_STATUS_SPECIAL_TEXT?>",
        DOPBSP_STATUS_UNAVAILABLE_TEXT = "<?php echo DOPBSP_STATUS_UNAVAILABLE_TEXT?>",
        DOPBSP_PRICE_LABEL = "<?php echo DOPBSP_PRICE_LABEL?>",
        DOPBSP_PROMO_LABEL = "<?php echo DOPBSP_PROMO_LABEL?>",
        DOPBSP_AVAILABLE_LABEL = "<?php echo DOPBSP_AVAILABLE_LABEL?>",
        DOPBSP_HOURS_DEFINITIONS_CHANGE_LABEL = "<?php echo DOPBSP_HOURS_DEFINITIONS_CHANGE_LABEL?>",
        DOPBSP_HOURS_DEFINITIONS_LABEL = "<?php echo DOPBSP_HOURS_DEFINITIONS_LABEL?>",
        DOPBSP_HOURS_SET_DEFAULT_DATA_LABEL = "<?php echo DOPBSP_HOURS_SET_DEFAULT_DATA_LABEL?>",
        DOPBSP_HOURS_START_LABEL = "<?php echo DOPBSP_HOURS_START_LABEL?>",
        DOPBSP_HOURS_END_LABEL = "<?php echo DOPBSP_HOURS_END_LABEL?>",
        DOPBSP_HOURS_INFO_LABEL = "<?php echo DOPBSP_HOURS_INFO_LABEL?>",
        DOPBSP_HOURS_NOTES_LABEL = "<?php echo DOPBSP_HOURS_NOTES_LABEL?>",
        DOPBSP_GROUP_DAYS_LABEL = "<?php echo DOPBSP_GROUP_DAYS_LABEL?>",
        DOPBSP_GROUP_HOURS_LABEL = "<?php echo DOPBSP_GROUP_HOURS_LABEL?>",
        DOPBSP_RESET_CONFIRMATION = "<?php echo DOPBSP_RESET_CONFIRMATION?>",
        
        // Add Calendar
        DOPBSP_ADD_CALENDAR_NAME = "<?php echo DOPBSP_ADD_CALENDAR_NAME?>",
        DOPBSP_ADD_CALENDAR_SUBMIT = "<?php echo DOPBSP_ADD_CALENDAR_SUBMIT?>",
        DOPBSP_ADD_CALENDAR_SUBMITED = "<?php echo DOPBSP_ADD_CALENDAR_SUBMITED?>",
        DOPBSP_ADD_CALENDAR_SUCCESS = "<?php echo DOPBSP_ADD_CALENDAR_SUCCESS?>",

        // Edit Calendar
        DOPBSP_EDIT_CALENDAR_SUBMIT = "<?php echo DOPBSP_EDIT_CALENDAR_SUBMIT?>",
        DOPBSP_EDIT_CALENDAR_SUCCESS = "<?php echo DOPBSP_EDIT_CALENDAR_SUCCESS?>",

        // Delete Calendar
        DOPBSP_DELETE_CALENDAR_CONFIRMATION = "<?php echo DOPBSP_DELETE_CALENDAR_CONFIRMATION?>",
        DOPBSP_DELETE_CALENDAR_SUBMIT = "<?php echo DOPBSP_DELETE_CALENDAR_SUBMIT?>",
        DOPBSP_DELETE_CALENDAR_SUBMITED = "<?php echo DOPBSP_DELETE_CALENDAR_SUBMITED?>",
        DOPBSP_DELETE_CALENDAR_SUCCESS = "<?php echo DOPBSP_DELETE_CALENDAR_SUCCESS?>",
        
        // Reservations
        DOPBSP_SHOW_RESERVATIONS = "<?php echo DOPBSP_SHOW_RESERVATIONS?>",
        DOPBSP_NO_RESERVATIONS = "<?php echo DOPBSP_NO_RESERVATIONS?>",
        
        DOPBSP_RESERVATIONS_ID = "<?php echo DOPBSP_RESERVATIONS_ID?>",
    
        DOPBSP_RESERVATIONS_CHECK_IN_LABEL = "<?php echo DOPBSP_RESERVATIONS_CHECK_IN_LABEL?>",
        DOPBSP_RESERVATIONS_CHECK_OUT_LABEL = "<?php echo DOPBSP_RESERVATIONS_CHECK_OUT_LABEL?>",
        DOPBSP_RESERVATIONS_START_HOURS_LABEL = "<?php echo DOPBSP_RESERVATIONS_START_HOURS_LABEL?>",
        DOPBSP_RESERVATIONS_END_HOURS_LABEL = "<?php echo DOPBSP_RESERVATIONS_END_HOURS_LABEL?>",
        
        DOPBSP_RESERVATIONS_FIRST_NAME_LABEL = "<?php echo DOPBSP_RESERVATIONS_FIRST_NAME_LABEL?>",
        DOPBSP_RESERVATIONS_LAST_NAME_LABEL = "<?php echo DOPBSP_RESERVATIONS_LAST_NAME_LABEL?>",
        DOPBSP_RESERVATIONS_STATUS_LABEL = "<?php echo DOPBSP_RESERVATIONS_STATUS_LABEL?>",
        DOPBSP_RESERVATIONS_STATUS_PENDING = "<?php echo DOPBSP_RESERVATIONS_STATUS_PENDING?>",
        DOPBSP_RESERVATIONS_STATUS_APPROVED = "<?php echo DOPBSP_RESERVATIONS_STATUS_APPROVED?>",
        DOPBSP_RESERVATIONS_DATE_CREATED_LABEL = "<?php echo DOPBSP_RESERVATIONS_DATE_CREATED_LABEL?>",
        DOPBSP_RESERVATIONS_PAYMENT_METHOD_LABEL = "<?php echo DOPBSP_RESERVATIONS_PAYMENT_METHOD_LABEL?>",
        DOPBSP_RESERVATIONS_PAYMENT_METHOD_ARRIVAL = "<?php echo DOPBSP_RESERVATIONS_PAYMENT_METHOD_ARRIVAL?>",
        DOPBSP_RESERVATIONS_PAYMENT_METHOD_PAYPAL = "<?php echo DOPBSP_RESERVATIONS_PAYMENT_METHOD_PAYPAL?>",
        DOPBSP_RESERVATIONS_PAYMENT_METHOD_PAYPAL_TRANSACTION_ID_LABEL = "<?php echo DOPBSP_RESERVATIONS_PAYMENT_METHOD_PAYPAL_TRANSACTION_ID_LABEL?>",
        DOPBSP_RESERVATIONS_TOTAL_PRICE_LABEL = "<?php echo DOPBSP_RESERVATIONS_TOTAL_PRICE_LABEL?>",   
        DOPBSP_RESERVATIONS_NO_ITEMS_LABEL = "<?php echo DOPBSP_RESERVATIONS_NO_ITEMS_LABEL?>",
        DOPBSP_RESERVATIONS_PRICE_LABEL = "<?php echo DOPBSP_RESERVATIONS_PRICE_LABEL?>",
        DOPBSP_RESERVATIONS_EMAIL_LABEL = "<?php echo DOPBSP_RESERVATIONS_EMAIL_LABEL?>",
        DOPBSP_RESERVATIONS_PHONE_LABEL = "<?php echo DOPBSP_RESERVATIONS_PHONE_LABEL?>",
        DOPBSP_RESERVATIONS_NO_PEOPLE_LABEL = "<?php echo DOPBSP_RESERVATIONS_NO_PEOPLE_LABEL?>",
        DOPBSP_RESERVATIONS_NO_CHILDREN_LABEL = "<?php echo DOPBSP_RESERVATIONS_NO_CHILDREN_LABEL?>",
        DOPBSP_RESERVATIONS_MESSAGE_LABEL = "<?php echo DOPBSP_RESERVATIONS_MESSAGE_LABEL?>",
    
        DOPBSP_RESERVATIONS_JUMP_TO_DAY_LABEL = "<?php echo DOPBSP_RESERVATIONS_JUMP_TO_DAY_LABEL?>",
        DOPBSP_RESERVATIONS_APPROVE_LABEL = "<?php echo DOPBSP_RESERVATIONS_APPROVE_LABEL?>",
        DOPBSP_RESERVATIONS_REJECT_LABEL = "<?php echo DOPBSP_RESERVATIONS_REJECT_LABEL?>",
        DOPBSP_RESERVATIONS_CANCEL_LABEL = "<?php echo DOPBSP_RESERVATIONS_CANCEL_LABEL?>",
    
        DOPBSP_RESERVATIONS_APPROVE_CONFIRMATION = "<?php echo DOPBSP_RESERVATIONS_APPROVE_CONFIRMATION?>",
        DOPBSP_RESERVATIONS_APPROVE_SUCCESS = "<?php echo DOPBSP_RESERVATIONS_APPROVE_SUCCESS?>",
        DOPBSP_RESERVATIONS_REJECT_CONFIRMATION = "<?php echo DOPBSP_RESERVATIONS_REJECT_CONFIRMATION?>",
        DOPBSP_RESERVATIONS_REJECT_SUCCESS = "<?php echo DOPBSP_RESERVATIONS_REJECT_SUCCESS?>",
        DOPBSP_RESERVATIONS_CANCEL_CONFIRMATION = "<?php echo DOPBSP_RESERVATIONS_CANCEL_CONFIRMATION?>",
        DOPBSP_RESERVATIONS_CANCEL_SUCCESS = "<?php echo DOPBSP_RESERVATIONS_CANCEL_SUCCESS?>",
    
        // Email
        DOPBSP_EMAIL_APPROVED_SUBJECT = "<?php echo DOPBSP_EMAIL_APPROVED_SUBJECT?>",
        DOPBSP_EMAIL_APPROVED_MESSAGE = "<?php echo DOPBSP_EMAIL_APPROVED_MESSAGE?>", 
        
        DOPBSP_EMAIL_REJECTED_SUBJECT = "<?php echo DOPBSP_EMAIL_REJECTED_SUBJECT?>", 
        DOPBSP_EMAIL_REJECTED_MESSAGE = "<?php echo DOPBSP_EMAIL_REJECTED_MESSAGE?>",
        
        DOPBSP_EMAIL_CANCELED_SUBJECT = "<?php echo DOPBSP_EMAIL_CANCELED_SUBJECT?>", 
        DOPBSP_EMAIL_CANCELED_MESSAGE = "<?php echo DOPBSP_EMAIL_CANCELED_MESSAGE?>",
            
        // TinyMCE
        DOPBSP_TINYMCE_ADD = "<?php echo DOPBSP_TINYMCE_ADD?>",

        // Settings
        DOPBSP_GENERAL_STYLES_SETTINGS = "<?php echo DOPBSP_GENERAL_STYLES_SETTINGS?>",
        DOPBSP_CALENDAR_NAME = "<?php echo DOPBSP_CALENDAR_NAME?>",
        DOPBSP_AVAILABLE_DAYS = "<?php echo DOPBSP_AVAILABLE_DAYS?>",
        DOPBSP_CURRENCY = "<?php echo DOPBSP_CURRENCY?>",
        DOPBSP_DATE_TYPE = "<?php echo DOPBSP_DATE_TYPE?>",
        DOPBSP_PREDEFINED = "<?php echo DOPBSP_PREDEFINED?>",
        DOPBSP_TEMPLATE = "<?php echo DOPBSP_TEMPLATE?>",
        DOPBSP_MIN_STAY = "<?php echo DOPBSP_MIN_STAY?>",
        DOPBSP_MAX_STAY = "<?php echo DOPBSP_MAX_STAY?>",
        DOPBSP_PAGE_URL = "<?php echo DOPBSP_PAGE_URL?>",
        
        DOPBSP_NOTIFICATIONS_STYLES_SETTINGS = "<?php echo DOPBSP_NOTIFICATIONS_STYLES_SETTINGS?>",
        DOPBSP_NOTIFICATIONS_TEMPLATE = "<?php echo DOPBSP_NOTIFICATIONS_TEMPLATE?>",
        DOPBSP_NOTIFICATIONS_EMAIL = "<?php echo DOPBSP_NOTIFICATIONS_EMAIL?>",
        DOPBSP_NOTIFICATIONS_SMTP_ENABLED = "<?php echo DOPBSP_NOTIFICATIONS_SMTP_ENABLED?>",
        DOPBSP_NOTIFICATIONS_SMTP_HOST_NAME = "<?php echo DOPBSP_NOTIFICATIONS_SMTP_HOST_NAME?>",
        DOPBSP_NOTIFICATIONS_SMTP_HOST_PORT = "<?php echo DOPBSP_NOTIFICATIONS_SMTP_HOST_PORT?>",
        DOPBSP_NOTIFICATIONS_SMTP_SSL = "<?php echo DOPBSP_NOTIFICATIONS_SMTP_SSL?>",
        DOPBSP_NOTIFICATIONS_SMTP_USER = "<?php echo DOPBSP_NOTIFICATIONS_SMTP_USER?>",
        DOPBSP_NOTIFICATIONS_SMTP_PASSWORD = "<?php echo DOPBSP_NOTIFICATIONS_SMTP_PASSWORD?>",
        
        DOPBSP_HOURS_STYLES_SETTINGS = "<?php echo DOPBSP_HOURS_STYLES_SETTINGS?>",
        DOPBSP_MULTIPLE_DAYS_SELECT = "<?php echo DOPBSP_MULTIPLE_DAYS_SELECT?>",
        DOPBSP_MORNING_CHECK_OUT = "<?php echo DOPBSP_MORNING_CHECK_OUT?>",
        DOPBSP_HOURS_ENABLED = "<?php echo DOPBSP_HOURS_ENABLED?>",
        DOPBSP_HOURS_DEFINITIONS = "<?php echo DOPBSP_HOURS_DEFINITIONS?>",
        DOPBSP_MULTIPLE_HOURS_SELECT = "<?php echo DOPBSP_MULTIPLE_HOURS_SELECT?>",
        DOPBSP_HOURS_AMPM = "<?php echo DOPBSP_HOURS_AMPM?>",
        
        DOPBSP_DISCOUNTS_NO_DAYS_SETTINGS = "<?php echo DOPBSP_DISCOUNTS_NO_DAYS_SETTINGS?>",
        DOPBSP_DISCOUNTS_NO_DAYS = "<?php echo DOPBSP_DISCOUNTS_NO_DAYS?>",
        DOPBSP_DISCOUNTS_NO_DAYS_DAYS = "<?php echo DOPBSP_DISCOUNTS_NO_DAYS_DAYS?>",
        
        DOPBSP_DEPOSIT_SETTINGS = "<?php echo DOPBSP_DEPOSIT_SETTINGS?>",
        DOPBSP_DEPOSIT = "<?php echo DOPBSP_DEPOSIT?>",
        
        DOPBSP_FORM_STYLES_SETTINGS = "<?php echo DOPBSP_FORM_STYLES_SETTINGS?>",
        DOPBSP_NAME_ENABLED = "<?php echo DOPBSP_NAME_ENABLED?>",
        DOPBSP_EMAIL_ENABLED = "<?php echo DOPBSP_EMAIL_ENABLED?>",
        DOPBSP_PHONE_ENABLED = "<?php echo DOPBSP_PHONE_ENABLED?>",
        DOPBSP_NO_PEOPLE_ENABLED = "<?php echo DOPBSP_NO_PEOPLE_ENABLED?>",
        DOPBSP_MIN_NO_PEOPLE = "<?php echo DOPBSP_MIN_NO_PEOPLE?>",
        DOPBSP_MAX_NO_PEOPLE = "<?php echo DOPBSP_MAX_NO_PEOPLE?>",
        DOPBSP_NO_CHILDREN_ENABLED = "<?php echo DOPBSP_NO_CHILDREN_ENABLED?>",
        DOPBSP_MIN_NO_CHILDREN = "<?php echo DOPBSP_MIN_NO_CHILDREN?>",
        DOPBSP_MAX_NO_CHILDREN = "<?php echo DOPBSP_MAX_NO_CHILDREN?>",
        DOPBSP_MESSAGE_ENABLED = "<?php echo DOPBSP_MESSAGE_ENABLED?>",
        DOPBSP_PAYMENT_ARRIVAL_ENABLED = "<?php echo DOPBSP_PAYMENT_ARRIVAL_ENABLED?>",
        
        DOPBSP_PAYMENT_PAYPAL_STYLES_SETTINGS = "<?php echo DOPBSP_PAYMENT_PAYPAL_STYLES_SETTINGS?>",
        DOPBSP_PAYMENT_PAYPAL_ENABLED = "<?php echo DOPBSP_PAYMENT_PAYPAL_ENABLED?>",
        DOPBSP_PAYMENT_PAYPAL_USERNAME = "<?php echo DOPBSP_PAYMENT_PAYPAL_USERNAME?>",
        DOPBSP_PAYMENT_PAYPAL_PASSWORD = "<?php echo DOPBSP_PAYMENT_PAYPAL_PASSWORD?>",
        DOPBSP_PAYMENT_PAYPAL_SIGNATURE = "<?php echo DOPBSP_PAYMENT_PAYPAL_SIGNATURE?>",
        DOPBSP_PAYMENT_PAYPAL_SANDBOX_ENABLED = "<?php echo DOPBSP_PAYMENT_PAYPAL_SANDBOX_ENABLED?>",
    
        DOPBSP_TERMS_AND_CONDITIONS_ENABLED = "<?php echo DOPBSP_TERMS_AND_CONDITIONS_ENABLED?>",
        DOPBSP_TERMS_AND_CONDITIONS_LINK = "<?php echo DOPBSP_TERMS_AND_CONDITIONS_LINK?>",
        
        DOPBSP_GO_TOP = "<?php echo DOPBSP_GO_TOP?>",
        
        // Settings Info
        DOPBSP_CALENDAR_NAME_INFO = "<?php echo DOPBSP_CALENDAR_NAME_INFO?>",
        DOPBSP_AVAILABLE_DAYS_INFO = "<?php echo DOPBSP_AVAILABLE_DAYS_INFO?>",
        DOPBSP_CURRENCY_INFO = "<?php echo DOPBSP_CURRENCY_INFO?>",
        DOPBSP_DATE_TYPE_INFO = "<?php echo DOPBSP_DATE_TYPE_INFO?>",
        DOPBSP_PREDEFINED_INFO = "<?php echo DOPBSP_PREDEFINED_INFO?>",
        DOPBSP_TEMPLATE_INFO = "<?php echo DOPBSP_TEMPLATE_INFO?>",
        DOPBSP_MIN_STAY_INFO = "<?php echo DOPBSP_MIN_STAY_INFO?>",
        DOPBSP_MAX_STAY_INFO = "<?php echo DOPBSP_MAX_STAY_INFO?>",
        DOPBSP_PAGE_URL_INFO = "<?php echo DOPBSP_PAGE_URL_INFO?>",
        
        DOPBSP_NOTIFICATIONS_TEMPLATE_INFO = "<?php echo DOPBSP_NOTIFICATIONS_TEMPLATE_INFO?>",
        DOPBSP_NOTIFICATIONS_EMAIL_INFO = "<?php echo DOPBSP_NOTIFICATIONS_EMAIL_INFO?>",
        DOPBSP_NOTIFICATIONS_SMTP_ENABLED_INFO = "<?php echo DOPBSP_NOTIFICATIONS_SMTP_ENABLED_INFO?>",
        DOPBSP_NOTIFICATIONS_SMTP_HOST_NAME_INFO = "<?php echo DOPBSP_NOTIFICATIONS_SMTP_HOST_NAME_INFO?>",
        DOPBSP_NOTIFICATIONS_SMTP_HOST_PORT_INFO = "<?php echo DOPBSP_NOTIFICATIONS_SMTP_HOST_PORT_INFO?>",
        DOPBSP_NOTIFICATIONS_SMTP_SSL_INFO = "<?php echo DOPBSP_NOTIFICATIONS_SMTP_SSL_INFO?>",
        DOPBSP_NOTIFICATIONS_SMTP_USER_INFO = "<?php echo DOPBSP_NOTIFICATIONS_SMTP_USER_INFO?>",
        DOPBSP_NOTIFICATIONS_SMTP_PASSWORD_INFO = "<?php echo DOPBSP_NOTIFICATIONS_SMTP_PASSWORD_INFO?>",
        
        DOPBSP_MULTIPLE_DAYS_SELECT_INFO = "<?php echo DOPBSP_MULTIPLE_DAYS_SELECT_INFO?>",
        DOPBSP_MORNING_CHECK_OUT_INFO = "<?php echo DOPBSP_MORNING_CHECK_OUT_INFO?>",
        DOPBSP_HOURS_ENABLED_INFO = "<?php echo DOPBSP_HOURS_ENABLED_INFO?>",
        DOPBSP_HOURS_DEFINITIONS_INFO = "<?php echo DOPBSP_HOURS_DEFINITIONS_INFO?>",
        DOPBSP_MULTIPLE_HOURS_SELECT_INFO = "<?php echo DOPBSP_MULTIPLE_HOURS_SELECT_INFO?>",
        DOPBSP_HOURS_AMPM_INFO = "<?php echo DOPBSP_HOURS_AMPM_INFO?>",
        
        DOPBSP_DISCOUNTS_NO_DAYS_INFO = "<?php echo DOPBSP_DISCOUNTS_NO_DAYS_INFO?>",
        DOPBSP_DISCOUNTS_NO_DAYS_DAYS_INFO = "<?php echo DOPBSP_DISCOUNTS_NO_DAYS_DAYS_INFO?>",
        
        DOPBSP_DEPOSIT_INFO = "<?php echo DOPBSP_DEPOSIT_INFO?>",
        
        DOPBSP_NAME_ENABLED_INFO = "<?php echo DOPBSP_NAME_ENABLED_INFO?>",
        DOPBSP_EMAIL_ENABLED_INFO = "<?php echo DOPBSP_EMAIL_ENABLED_INFO?>",
        DOPBSP_PHONE_ENABLED_INFO = "<?php echo DOPBSP_PHONE_ENABLED_INFO?>",
        DOPBSP_NO_PEOPLE_ENABLED_INFO = "<?php echo DOPBSP_NO_PEOPLE_ENABLED_INFO?>",
        DOPBSP_MIN_NO_PEOPLE_INFO = "<?php echo DOPBSP_MIN_NO_PEOPLE_INFO?>",
        DOPBSP_MAX_NO_PEOPLE_INFO = "<?php echo DOPBSP_MAX_NO_PEOPLE_INFO?>",
        DOPBSP_NO_CHILDREN_ENABLED_INFO = "<?php echo DOPBSP_NO_CHILDREN_ENABLED_INFO?>",
        DOPBSP_MIN_NO_CHILDREN_INFO = "<?php echo DOPBSP_MIN_NO_CHILDREN_INFO?>",
        DOPBSP_MAX_NO_CHILDREN_INFO = "<?php echo DOPBSP_MAX_NO_CHILDREN_INFO?>",
        DOPBSP_MESSAGE_ENABLED_INFO = "<?php echo DOPBSP_MESSAGE_ENABLED_INFO?>",
        DOPBSP_PAYMENT_ARRIVAL_ENABLED_INFO = "<?php echo DOPBSP_PAYMENT_ARRIVAL_ENABLED_INFO?>",
        
        DOPBSP_PAYMENT_PAYPAL_ENABLED_INFO = "<?php echo DOPBSP_PAYMENT_PAYPAL_ENABLED_INFO?>",   
        DOPBSP_PAYMENT_PAYPAL_USERNAME_INFO = "<?php echo DOPBSP_PAYMENT_PAYPAL_USERNAME_INFO?>",
        DOPBSP_PAYMENT_PAYPAL_PASSWORD_INFO = "<?php echo DOPBSP_PAYMENT_PAYPAL_PASSWORD_INFO?>",  
        DOPBSP_PAYMENT_PAYPAL_SIGNATURE_INFO = "<?php echo DOPBSP_PAYMENT_PAYPAL_SIGNATURE_INFO?>",
        DOPBSP_PAYMENT_PAYPAL_SANDBOX_ENABLED_INFO = "<?php echo DOPBSP_PAYMENT_PAYPAL_SANDBOX_ENABLED_INFO?>",
        
        DOPBSP_TERMS_AND_CONDITIONS_ENABLED_INFO = "<?php echo DOPBSP_TERMS_AND_CONDITIONS_ENABLED_INFO?>",
        DOPBSP_TERMS_AND_CONDITIONS_LINK_INFO = "<?php echo DOPBSP_TERMS_AND_CONDITIONS_LINK_INFO?>",
        
        // Settings
        DOPBSP_TITLE_SETTINGS = "<?php echo DOPBSP_TITLE_SETTINGS?>",
    
        DOPBSP_USERS_PERMISSIONS = "<?php echo DOPBSP_USERS_PERMISSIONS?>",
        DOPBSP_USERS_ADMINISTRATORS = "<?php echo DOPBSP_USERS_ADMINISTRATORS?>",
        DOPBSP_USERS_AUTHORS = "<?php echo DOPBSP_USERS_AUTHORS?>",
        DOPBSP_USERS_CONTRIBUTORS = "<?php echo DOPBSP_USERS_CONTRIBUTORS?>",
        DOPBSP_USERS_EDITORS = "<?php echo DOPBSP_USERS_EDITORS?>",
        DOPBSP_USERS_SUBSCRIBERS = "<?php echo DOPBSP_USERS_SUBSCRIBERS?>";    
    </script>
    <div class="wrap DOPBSP-admin">
        <h2><?php echo DOPBSP_TITLE.' - '.DOPBSP_TITLE_SETTINGS?></h2>
        <div id="DOPBSP-admin-message"></div>
        <br class="DOPBSP-clear" />
        <div class="main">
            <form method="post" class="DOPBSP-form" action="" style="padding:0;"></form>
            <div class="column column1">
                <div class="column-content-container">
                    <div class="column-content">
                        <ul>
                            <li class="item item-selected"><?php echo DOPBSP_USERS_PERMISSIONS?></li>
                        </ul>                            
                    </div>
                </div>
            </div>
            <div class="column-separator"></div>
            <div class="column column2">
                <div class="column-content-container">
                    <div class="column-content">
                        <h3 class="settings"><?php echo DOPBSP_USERS_ADMINISTRATORS?></h3>
<?php
                global $wpdb;     
    $users_administrators = get_users('orderby=nicename&role=administrator');
    
    foreach ($users_administrators as $user){
        $user_permissions = $wpdb->get_row('SELECT * FROM '.DOPBSP_Users_table.' WHERE user_id='.$user->ID);
        
?>
                        <div class="setting-box">
                            <label for="user<?php echo $user->ID?>"><?php echo $user->user_nicename?></label>        
                            <span class="pre"></span>
                            <select name="<?php echo $user->ID?>" id="<?php echo $user->ID?>" onchange="dopbspEditUserPermissions(<?php echo $user->ID?>, '2', this.value)">
                                <option value="true"<?php echo $user_permissions->view_all == 'true' ? ' selected="selected"':''?>><?php echo DOPBSP_ENABLED?></option>
                                <option value="false"<?php echo $user_permissions->view_all == 'false' ? ' selected="selected"':''?>><?php echo DOPBSP_DISABLED?></option>
                            </select>
                            <span class="suf"></span>
                            <br class="DOPBSP-clear">
                        </div>
<?php
    }
?>                        
                        <a href="javascript:dopbspMoveTop()" class="go-top"><?php echo DOPBSP_GO_TOP?></a><h3 class="settings"><?php echo DOPBSP_USERS_AUTHORS?></h3>
<?php  
    $users_authors = get_users('orderby=nicename&role=author');
    
    foreach ($users_authors as $user){
        $user_permissions = $wpdb->get_row('SELECT * FROM '.DOPBSP_Users_table.' WHERE user_id='.$user->ID);
        
?>
                        <div class="setting-box">
                            <label for="user<?php echo $user->ID?>"><?php echo $user->user_nicename?></label>        
                            <span class="pre"></span>
                            <select name="user<?php echo $user->ID?>" id="user<?php echo $user->ID?>" onchange="dopbspEditUserPermissions(<?php echo $user->ID?>, '1', this.value)">
                                <option value="true"<?php echo $user_permissions->view == 'true' ? ' selected="selected"':''?>><?php echo DOPBSP_ENABLED?></option>
                                <option value="false"<?php echo $user_permissions->view == 'false' ? ' selected="selected"':''?>><?php echo DOPBSP_DISABLED?></option>
                            </select>
                            <span class="suf"></span>
                            <br class="DOPBSP-clear">
                        </div>
<?php
    }
?> 
                        <a href="javascript:dopbspMoveTop()" class="go-top"><?php echo DOPBSP_GO_TOP?></a><h3 class="settings"><?php echo DOPBSP_USERS_CONTRIBUTORS?></h3>
<?php  
    $users_contributors = get_users('orderby=nicename&role=contributor');
    
    foreach ($users_contributors as $user){
        $user_permissions = $wpdb->get_row('SELECT * FROM '.DOPBSP_Users_table.' WHERE user_id='.$user->ID);
        
?>
                        <div class="setting-box">
                            <label for="user<?php echo $user->ID?>"><?php echo $user->user_nicename?></label>        
                            <span class="pre"></span>
                            <select name="user<?php echo $user->ID?>" id="user<?php echo $user->ID?>" onchange="dopbspEditUserPermissions(<?php echo $user->ID?>, '1', this.value)">
                                <option value="true"<?php echo $user_permissions->view == 'true' ? ' selected="selected"':''?>><?php echo DOPBSP_ENABLED?></option>
                                <option value="false"<?php echo $user_permissions->view == 'false' ? ' selected="selected"':''?>><?php echo DOPBSP_DISABLED?></option>
                            </select>
                            <span class="suf"></span>
                            <br class="DOPBSP-clear">
                        </div>
<?php
    }
?> 
                        <a href="javascript:dopbspMoveTop()" class="go-top"><?php echo DOPBSP_GO_TOP?></a><h3 class="settings"><?php echo DOPBSP_USERS_EDITORS?></h3>
<?php  
    $users_editors = get_users('orderby=nicename&role=editor');
    
    foreach ($users_editors as $user){
        $user_permissions = $wpdb->get_row('SELECT * FROM '.DOPBSP_Users_table.' WHERE user_id='.$user->ID);
        
?>
                        <div class="setting-box">
                            <label for="user<?php echo $user->ID?>"><?php echo $user->user_nicename?></label>        
                            <span class="pre"></span>
                            <select name="user<?php echo $user->ID?>" id="user<?php echo $user->ID?>" onchange="dopbspEditUserPermissions(<?php echo $user->ID?>, '1', this.value)">
                                <option value="true"<?php echo $user_permissions->view == 'true' ? ' selected="selected"':''?>><?php echo DOPBSP_ENABLED?></option>
                                <option value="false"<?php echo $user_permissions->view == 'false' ? ' selected="selected"':''?>><?php echo DOPBSP_DISABLED?></option>
                            </select>
                            <span class="suf"></span>
                            <br class="DOPBSP-clear">
                        </div>
<?php
    }
?> 
                        <a href="javascript:dopbspMoveTop()" class="go-top"><?php echo DOPBSP_GO_TOP?></a><h3 class="settings"><?php echo DOPBSP_USERS_SUBSCRIBERS?></h3>
<?php  
    $users_subscribers = get_users('orderby=nicename&role=subscriber');
    
    foreach ($users_subscribers as $user){
        $user_permissions = $wpdb->get_row('SELECT * FROM '.DOPBSP_Users_table.' WHERE user_id='.$user->ID);
        
?>
                        <div class="setting-box">
                            <label for="user<?php echo $user->ID?>"><?php echo $user->user_nicename?></label>        
                            <span class="pre"></span>
                            <select name="user<?php echo $user->ID?>" id="user<?php echo $user->ID?>" onchange="dopbspEditUserPermissions(<?php echo $user->ID?>, '1', this.value)">
                                <option value="true"<?php echo $user_permissions->view == 'true' ? ' selected="selected"':''?>><?php echo DOPBSP_ENABLED?></option>
                                <option value="false"<?php echo $user_permissions->view == 'false' ? ' selected="selected"':''?>><?php echo DOPBSP_DISABLED?></option>
                            </select>
                            <span class="suf"></span>
                            <br class="DOPBSP-clear">
                        </div>
<?php
    }
?> 
                    </div>
                </div>
            </div>
            <div class="column column3">
                <div class="column-content-container">
                    <div class="column-content">
                        &nbsp;
                    </div>
                </div>
            </div>
        </div>
        <br class="DOPBSP-clear" />
    </div>
<?php
            }

            function help(){// Help Template
?>
    <script type="text/JavaScript">
        var DOPBSP_curr_page = "Help",
        DOPBSP_plugin_url = "<?php echo WP_PLUGIN_URL.'/dopbsp/'?>",
        DOPBSP_plugin_abs = "<?php echo ABSPATH.'wp-content/plugins/dopbsp/'?>",

        DOPBSP_TITLE = "<?php echo DOPBSP_TITLE?>",
        
        // Help
        DOPBSP_TITLE_HELP = "<?php echo DOPBSP_TITLE_HELP?>";
    </script>
    <div class="wrap DOPBSP-admin">
        <h2><?php echo DOPBSP_TITLE.' - '.DOPBSP_TITLE_HELP?></h2>
        <br class="DOPBSP-clear" />
        <div class="main">
            <form method="post" class="DOPBSP-form" action=""></form>
<?php
    global $DOPBSP_help_info;
    
    for ($i=0; $i<count($DOPBSP_help_info); $i++){
        echo '<div class="DOPBSP-question" id="DOPBSP-question_'.$i.'">'.($i+1).'. '.$DOPBSP_help_info[$i]['question'].'</div>';
        echo '<div class="DOPBSP-answer" id="DOPBSP-answer_'.$i.'">'.$DOPBSP_help_info[$i]['answer'].'</div>';
    }
?>
        </div>
        <br class="DOPBSP-clear" />
    </div>
<?php
            }
        }
    }
?>