<?php

/*
* Title                   : Booking System PRO (WordPress Plugin)
* Version                 : 1.2
* File                    : dopbsp-frontend.php
* File Version            : 1.2
* Created / Last Modified : 01 November 2012
* Author                  : Marius-Cristian Donea
* Copyright               : © 2012 Marius-Cristian Donea
* Website                 : http://www.mariuscristiandonea.com
* Description             : Booking System PRO Front End Class.
*/

    if (!class_exists("DOPBookingCalendarPROFrontEnd")){
        class DOPBookingSystemPROFrontEnd{
            function DOPBookingSystemPROFrontEnd(){// Constructor.
                add_action('wp_enqueue_scripts', array(&$this, 'addScripts'));
                $this->init();
            }
            
            function addScripts(){
                wp_register_script('jqueryUI', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.11/jquery-ui.min.js', array('jquery'));
                
                if (preg_match('/MSIE 7/i', $_SERVER['HTTP_USER_AGENT'])){
                    wp_register_script('DOPTS_json2', plugins_url('libraries/js/json2.js', __FILE__), array('jquery'));
                }
                wp_register_script('DOPBSP_DOPBookingSystemPROJS', plugins_url('assets/js/jquery.dop.FrontendBookingSystemPRO.js', __FILE__), array('jquery'));

                // Enqueue JavaScript.
                if (!wp_script_is('jquery', 'queue')){
                    wp_enqueue_script('jquery');
                }
                wp_enqueue_script('jqueryUI');
                
                if (preg_match('/MSIE 7/i', $_SERVER['HTTP_USER_AGENT'])){
                    wp_enqueue_script('DOPTS_json2');
                }
                wp_enqueue_script('DOPBSP_DOPBookingSystemPROJS');
            }

            function init(){// Init Gallery.
                $this->initConstants();
                add_shortcode('dopbsp', array(&$this, 'captionShortcode'));
            }

            function initConstants(){// Constants init.
                global $wpdb;

                // Paths
                define('DOPBSP_Plugin_AbsPath', ABSPATH.'wp-content/plugins/dopbsp/');
                define('DOPBSP_Plugin_URL', WP_PLUGIN_URL.'/dopbsp/');
                
                // Tables
                define('DOPBSP_Settings_table', $wpdb->prefix.'dopbsp_settings');
                define('DOPBSP_Calendars_table', $wpdb->prefix.'dopbsp_calendars');
                define('DOPBSP_Days_table', $wpdb->prefix.'dopbsp_days');
                define('DOPBSP_Reservations_table', $wpdb->prefix.'dopbsp_reservations');
            }

            function captionShortcode($atts){// Read Shortcodes.
                extract(shortcode_atts(array(
                    'class' => 'dopbsp',
                ), $atts));
                                
                if (array_key_exists('lang', $atts)){
                    $language = $atts['lang'];
                }
                else{
                    $language = 'en';
                }
                
                $_SESSION["DOPBookingSystemPROFrontEndLanguage"] = $language;
                $data = array();
                                
                array_push($data, '<link rel="stylesheet" type="text/css" href="'.plugins_url('templates/'.$this->getCalendarTemplate($atts['id']).'/css/jquery-ui-1.8.21.customDatepicker.css', __FILE__).'" />');
                array_push($data, '<link rel="stylesheet" type="text/css" href="'.plugins_url('templates/'.$this->getCalendarTemplate($atts['id']).'/css/jquery.dop.FrontendBookingSystemPRO.css', __FILE__).'" />');
                
                array_push($data, '<script type="text/JavaScript">');
                array_push($data, '    jQuery(document).ready(function(){');
                array_push($data, '        jQuery("#DOPBookingSystemPRO'.$atts['id'].'").DOPBookingSystemPRO('.$this->getCalendarSettings($atts['id'], $language).');');
                array_push($data, '    });');
                array_push($data, '</script>');
                
                array_push($data, '<div class="DOPBookingSystemPROContainer" id="DOPBookingSystemPRO'.$atts['id'].'"><a href="'.DOPBSP_Plugin_URL.'frontend-ajax.php"></a></div>');
                
                return implode("\n", $data);
            }
 
            function getCalendarTemplate($id){// Get Gallery Info.
                global $wpdb;                
                $settings = $wpdb->get_row('SELECT template FROM '.DOPBSP_Settings_table.' WHERE calendar_id="'.$id.'"');
                
                return $settings->template;
            }

            function getCalendarSettings($id, $language=en){// Get Gallery Info.
                include_once 'translation/frontend/'.$language.'.php';
                global $wpdb;
                global $DOPBSP_currencies;
                global $DOPBSP_month_names;
                global $DOPBSP_day_names;
                $data = array();
                                
                $settings = $wpdb->get_row('SELECT * FROM '.DOPBSP_Settings_table.' WHERE calendar_id="'.$id.'"');
                
                $discountsNoDays = explode(',', $settings->discounts_no_days);
                
                for ($i=0; $i<count($discountsNoDays); $i++){
                    $discountsNoDays[$i] = (float)$discountsNoDays[$i];
                }
                
                $data = array('AddtMonthViewText' => DOPBSP_ADD_MONTH_VIEW,
                              'AvailableDays' => explode(',', $settings->available_days),
                              'AvailableOneText' => DOPBSP_AVAILABLE_ONE_TEXT,
                              'AvailableText' => DOPBSP_AVAILABLE_TEXT,
                              'BookedText' => DOPBSP_BOOKED_TEXT,
                              'BookNowLabel' => DOPBSP_BOOK_NOW_LABEL,
                              'CheckInLabel' => DOPBSP_CHECK_IN_LABEL,
                              'CheckOutLabel' => DOPBSP_CHECK_OUT_LABEL,
                              'Currency' => $DOPBSP_currencies[(int)$settings->currency-1]['sign'],
                              'CurrencyCode' => $DOPBSP_currencies[(int)$settings->currency-1]['code'],
                              'DayNames' => $DOPBSP_day_names,
                              'Deposit' => $settings->deposit,
                              'DepositText' => DOPBSP_DEPOSIT_TEXT,
                              'DiscountsNoDays' => $discountsNoDays,
                              'DiscountText' => DOPBSP_DISCOUNT_TEXT,
                              'EmailEnabled' => $settings->email_enabled,
                              'EmailInvalid' => DOPBSP_EMAIL_INVALID,
                              'EmailLabel' => DOPBSP_EMAIL_LABEL,
                              'EndHourLabel' => DOPBSP_END_HOURS_LABEL,
                              'FirstNameInvalid' => DOPBSP_FIRST_NAME_INVALID,
                              'FirstNameLabel' => DOPBSP_FIRST_NAME_LABEL,
                              'HoursAMPM' => $settings->hours_ampm,
                              'HoursEnabled' => $settings->hours_enabled,
                              'HoursDefinitions' => json_decode($settings->hours_definitions),
                              'ID' => $id,
                              'LastNameInvalid' => DOPBSP_LAST_NAME_INVALID,
                              'LastNameLabel' => DOPBSP_LAST_NAME_LABEL,
                              'MaxNoChildren' => $settings->max_no_children,
                              'MaxNoPeople' => $settings->max_no_people,
                              'MaxYear' => $settings->max_year,
                              'MaxStay' => $settings->max_stay,
                              'MaxStayWarning' => DOPBSP_MAX_STAY_WARNING,
                              'MessageEnabled' => $settings->message_enabled,
                              'MessageInvalid' => DOPBSP_MESSAGE_INVALID,
                              'MessageLabel' => DOPBSP_MESSAGE_LABEL,
                              'MinNoChildren' => $settings->min_no_children,
                              'MinNoPeople' => $settings->min_no_people,
                              'MinStay' => $settings->min_stay,
                              'MinStayWarning' => DOPBSP_MIN_STAY_WARNING,
                              'MonthNames' => $DOPBSP_month_names,
                              'MorningCheckOut' => $settings->morning_check_out,
                              'MultipleDaysSelect' => $settings->multiple_days_select,
                              'MultipleHoursSelect' => $settings->multiple_hours_select,
                              'NameEnabled' => $settings->name_enabled,
                              'NextMonthText' => DOPBSP_NEXT_MONTH,
                              'NoAdultsLabel' => DOPBSP_NO_ADULTS_LABEL,
                              'NoChildrenEnabled' => $settings->no_children_enabled,
                              'NoChildrenLabel' => DOPBSP_NO_CHILDREN_LABEL,
                              'NoItemsLabel' => DOPBSP_NO_ITEMS_LABEL,
                              'NoPeopleLabel' => DOPBSP_NO_PEOPLE_LABEL,
                              'NoPeopleEnabled' => $settings->no_people_enabled,
                              'NoServicesAvailableText' => DOPBSP_NO_SERVICES_AVAILABLE,
                              'PaymentArrivalEnabled' => $settings->payment_arrival_enabled,
                              'PaymentArrivalLabel' => DOPBSP_PAYMENT_ARRIVAL_LABEL,
                              'PaymentArrivalSuccess' => DOPBSP_PAYMENT_ARRIVAL_SUCCESS,
                              'PaymentPayPalEnabled' => $settings->payment_paypal_enabled,
                              'PaymentPayPalLabel' => DOPBSP_PAYMENT_PAYPAL_LABEL,
                              'PaymentPayPalSuccess' => DOPBSP_PAYMENT_PAYPAL_SUCCESS,
                              'PaymentPayPalError' => DOPBSP_PAYMENT_PAYPAL_ERROR,
                              'PhoneEnabled' => $settings->phone_enabled,
                              'PhoneInvalid' => DOPBSP_PHONE_INVALID,
                              'PhoneLabel' => DOPBSP_PHONE_LABEL,
                              'PluginURL' => DOPBSP_Plugin_URL,
                              'PreviousMonthText' => DOPBSP_PREVIOUS_MONTH,
                              'RemoveMonthViewText' => DOPBSP_REMOVE_MONTH_VIEW,
                              'ServicesLabel' => DOPBSP_SERVICES_LABEL,
                              'StartHourLabel' => DOPBSP_START_HOURS_LABEL,
                              'TotalPriceLabel' => DOPBSP_TOTAL_PRICE_LABEL,
                              'TermsAndConditionsEnabled' => $settings->terms_and_conditions_enabled,
                              'TermsAndConditionsInvalid' => DOPBSP_TERMS_AND_CONDITIONS_INVALID,
                              'TermsAndConditionsLabel' => DOPBSP_TERMS_AND_CONDITIONS_LABEL,
                              'TermsAndConditionsLink' => $settings->terms_and_conditions_link,
                              'UnavailableText' => DOPBSP_UNAVAILABLE_TEXT);
                
                return json_encode($data);
            }
            
            function loadSchedule(){// Load Calendar Data.
                if (isset($_POST['calendar_id'])){
                    global $wpdb;
                    $schedule = array();
                    
                    $days = $wpdb->get_results('SELECT * FROM '.DOPBSP_Days_table.' WHERE calendar_id="'.$_POST['calendar_id'].'"');
                    
                    foreach ($days as $day):
                        $schedule[$day->day] = json_decode($day->data);
                    endforeach;
                    
                    if (count($schedule) > 0){
                        echo json_encode($schedule);
                    }
                    else{
                        echo '';
                    }

                    die();
                }
            }
            
            function bookRequest(){
                session_start();
                
                if (isset($_POST['calendar_id'])){
                    global $wpdb;
                    
                    if (isset($_SESSION["DOPBookingSystemPROFrontEndLanguage"])){
                        include_once "translation/frontend/".$_SESSION["DOPBookingSystemPROFrontEndLanguage"].".php";        
                    }
                    else{
                        include_once "translation/frontend/en.php";
                    }
                    
                    $wpdb->insert(DOPBSP_Reservations_table, array('calendar_id' => $_POST['calendar_id'],
                                                                   'check_in' => $_POST['check_in'],
                                                                   'check_out' => $_POST['check_out'],
                                                                   'start_hour' => $_POST['start_hour'],
                                                                   'end_hour' => $_POST['end_hour'],
                                                                   'no_items' => $_POST['no_items'],
                                                                   'currency' => $_POST['currency'],
                                                                   'currency_code' => $_POST['currency_code'],
                                                                   'total_price' => $_POST['total_price'],
                                                                   'discount' => $_POST['discount'],
                                                                   'price' => $_POST['price'],
                                                                   'deposit' => $_POST['deposit'],
                                                                   'first_name' => $_POST['first_name'],
                                                                   'last_name' => $_POST['last_name'],
                                                                   'email' => $_POST['email'],
                                                                   'phone' => $_POST['phone'],
                                                                   'no_people' => $_POST['no_people'],
                                                                   'no_children' => $_POST['no_children'],
                                                                   'message' => $_POST['message'],
                                                                   'payment_method' => $_POST['payment_method']));
                    $reservationId = $wpdb->insert_id;
                    $settings = $wpdb->get_row('SELECT * FROM '.DOPBSP_Settings_table.' WHERE calendar_id="'.$_POST['calendar_id'].'"');
                    
                    $DOPemail = new DOPBookingSystemPROEmail();
                    
                    if ($settings->notifications_email){
                        // ================================================================= Email to user
                        $message = DOPBSP_EMAIL_TO_USER_MESSAGE_PAYMENT_ARRIVAL;

                        $message_ids = '<strong>'.DOPBSP_EMAIL_RESERVATION_ID.'</strong> '.$reservationId;

                        $message_date = $_POST['check_in'] != '' ? '<strong>'.DOPBSP_CHECK_IN_LABEL.':</strong> '.$this->dateToFormat($_POST['check_in'], $settings->date_type):'';
                        $message_date .= $_POST['check_out'] != '' ? '<br /><strong>'.DOPBSP_CHECK_OUT_LABEL.':</strong> '.$this->dateToFormat($_POST['check_out'], $settings->date_type):'';
                        $message_date .= $_POST['start_hour'] != '' ?  '<br /><strong>'.DOPBSP_START_HOURS_LABEL.':</strong> '.($settings->hours_ampm == 'true' ? $this->timeToAMPM($_POST['start_hour']):$_POST['start_hour']):'';
                        $message_date .= $_POST['end_hour'] != '' ? '<br /><strong>'.DOPBSP_END_HOURS_LABEL.':</strong> '.($settings->hours_ampm == 'true' ? $this->timeToAMPM($_POST['end_hour']):$_POST['end_hour']):'';

                        $message_price = $_POST['no_items'] != '' ? '<strong>'.DOPBSP_NO_ITEMS_LABEL.':</strong> '.$_POST['no_items']:'';
                        $message_price .= $_POST['price'] != 0 ? '<br /><strong>'.DOPBSP_TOTAL_PRICE_LABEL.'</strong> '.$_POST['currency'].$_POST['price']:'';
                        $message_price .= $_POST['deposit'] != 0 ? '<br /><strong>'.DOPBSP_DEPOSIT_PRICE_LABEL.'</strong> '.$_POST['currency'].$_POST['deposit'].' ('.$settings->deposit.'%)'.
                                                                   '<br /><strong>'.DOPBSP_DEPOSIT_PRICE_LEFT_LABEL.'</strong> '.$_POST['currency'].($_POST['price']-$_POST['deposit']):'';
                        $message_price .= $_POST['total_price'] != 0 && $_POST['total_price'] != $_POST['price'] ? '<br /><strong>'.DOPBSP_DISCOUNT_PRICE_LABEL.'</strong> <span style="text-decoration: line-through;">'.$_POST['currency'].$_POST['total_price'].'</span> ('.$_POST['discount'].'% '.DOPBSP_DISCOUNT_TEXT.')':'';

                        $message_form = $_POST['first_name'] != '' ? '<strong>'.DOPBSP_FIRST_NAME_LABEL.':</strong> '.$_POST['first_name']:'';
                        $message_form .= $_POST['last_name'] != '' ? '<br /><strong>'.DOPBSP_LAST_NAME_LABEL.':</strong> '.$_POST['last_name']:'';
                        $message_form .= $_POST['email'] != '' ? '<br /><strong>'.DOPBSP_EMAIL_LABEL.':</strong> '.$_POST['email']:'';
                        $message_form .= $_POST['phone'] != '' ? '<br /><strong>'.DOPBSP_PHONE_LABEL.':</strong> '.$_POST['phone']:'';
                        $message_form .= $_POST['no_people'] != '' ? ($_POST['no_children'] == '' ? '<br /><strong>'.DOPBSP_NO_PEOPLE_LABEL:'<br /><strong>'.DOPBSP_NO_ADULTS_LABEL).':</strong> '.$_POST['no_people']:'';
                        $message_form .= $_POST['no_children'] != '' ? '<br /><strong>'.DOPBSP_NO_CHILDREN_LABEL.':</strong> '.$_POST['no_children']:'';
                        $message_form .= $_POST['message'] != '' ? '<br /><strong>'.DOPBSP_MESSAGE_LABEL.':</strong> '.$_POST['message']:'';

                        if ($settings->smtp_enabled == 'true'){
                            $DOPemail->sendSMTPEmail($_POST['email'],
                                                     $settings->notifications_email,
                                                     DOPBSP_EMAIL_TO_USER_SUBJECT,
                                                     $DOPemail->message($message,
                                                                        $message_ids,
                                                                        $message_date,
                                                                        $message_price,
                                                                        $message_form,
                                                                        DOPBSP_Plugin_URL.'emails/'.$settings->template_email.'/book-user-email.html'),
                                                     $settings->smtp_host_name,
                                                     $settings->smtp_host_port,
                                                     $settings->smtp_ssl,
                                                     $settings->smtp_user,
                                                     $settings->smtp_password);
                        }
                        else{
                            $DOPemail->sendEmail($_POST['email'],
                                                 $settings->notifications_email,
                                                 DOPBSP_EMAIL_TO_USER_SUBJECT,
                                                 $DOPemail->message($message,
                                                                    $message_ids,
                                                                    $message_date,
                                                                    $message_price,
                                                                    $message_form,
                                                                    DOPBSP_Plugin_URL.'emails/'.$settings->template_email.'/book-user-email.html'));
                        }

                        // ================================================================= Email to admin
                        $message = DOPBSP_EMAIL_TO_ADMIN_MESSAGE_PAYMENT_ARRIVAL;

                        if ($settings->smtp_enabled == 'true'){
                            $DOPemail->sendSMTPEmail($settings->notifications_email,
                                                     $_POST['email'],
                                                     DOPBSP_EMAIL_TO_ADMIN_SUBJECT,
                                                     $DOPemail->message($message,
                                                                        $message_ids,
                                                                        $message_date,
                                                                        $message_price,
                                                                        $message_form,
                                                                        DOPBSP_Plugin_URL.'emails/'.$settings->template_email.'/book-administrator-email.html'),
                                                     $settings->smtp_host_name,
                                                     $settings->smtp_host_port,
                                                     $settings->smtp_ssl,
                                                     $settings->smtp_user,
                                                     $settings->smtp_password);
                        }
                        else{
                            $DOPemail->sendEmail($settings->notifications_email,
                                                 $_POST['email'],
                                                 DOPBSP_EMAIL_TO_ADMIN_SUBJECT,
                                                 $DOPemail->message($message,
                                                                    $message_ids,
                                                                    $message_date,
                                                                    $message_price,
                                                                    $message_form,
                                                                    DOPBSP_Plugin_URL.'emails/'.$settings->template_email.'/book-administrator-email.html'));
                        }
                    }
                }
                
                echo '';                
                die();
            }
            
            function paypalCheck(){
                session_start();
                
                if (isset($_POST['calendar_id']) && isset($_SESSION['DOPBSP_PayPal'.$_POST['calendar_id']])){
                    $status = $_SESSION['DOPBSP_PayPal'.$_POST['calendar_id']];
                    $_SESSION['DOPBSP_PayPal'.$_POST['calendar_id']] = '';
                    
                    echo $status;                    
                }
                else{
                    echo 'no';
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
                    $result = $this->timeLongItem($hour-12);
                }
                else{
                    $result = $this->timeLongItem($hour);
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
        }
    }
?>