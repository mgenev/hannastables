<?php

/*
* Title                   : Booking System Pro (WordPress Plugin)
* Version                 : 1.2
* File                    : dopbsp-backend.php
* File Version            : 1.2
* Created / Last Modified : 01 November 2012
* Author                  : Marius-Cristian Donea
* Copyright               : © 2012 Marius-Cristian Donea
* Website                 : http://www.mariuscristiandonea.com
* Description             : Booking System PRO Back End Class.
*/

    if (!class_exists("DOPBookingSystemPROBackEnd")){
        class DOPBookingSystemPROBackEnd{
            private $DOPBSP_AddEditCalendars;

            function DOPBookingSystemPROBackEnd(){// Constructor.
                if (is_admin()){
                    if ($this->validPage()){
                        $this->DOPBSP_AddEditCalendars = new DOPBSPTemplates();
                        add_action('admin_enqueue_scripts', array(&$this, 'addStyles'));
                        add_action('admin_enqueue_scripts', array(&$this, 'addScripts'));
                    }

                    $this->addDOPBSPtoTinyMCE();
                    $this->init();
                }
            }
            
            function addStyles(){
                // Register Styles.
                wp_register_style('DOPBSP_DOPBookingSystemPROStyle', plugins_url('assets/gui/css/jquery.dop.BackendBookingSystemPRO.css', __FILE__));
                wp_register_style('DOPBSP_AdminStyle', plugins_url('assets/gui/css/backend-style.css', __FILE__));

                // Enqueue Styles.
                wp_enqueue_style('thickbox');
                wp_enqueue_style('DOPBSP_DOPBookingSystemPROStyle');
                wp_enqueue_style('DOPBSP_AdminStyle');
            }
            
            function addScripts(){
                // Register JavaScript.
                wp_register_script('jqueryUI', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.11/jquery-ui.min.js', array('jquery'));
                wp_register_script('DOPBSP_DOPBookingSystemPROJS', plugins_url('assets/js/jquery.dop.BackendBookingSystemPRO.js', __FILE__), array('jquery'));
                wp_register_script('DOPBSP_DOPBSPJS', plugins_url('assets/js/dopbsp-backend.js', __FILE__), array('jquery'));

                // Enqueue JavaScript.
                if (!wp_script_is('jquery', 'queue')){
                    wp_enqueue_script('jquery');
                }
                wp_enqueue_script('jqueryUI');
                wp_enqueue_script('DOPBSP_DOPBookingSystemPROJS');
                wp_enqueue_script('DOPBSP_DOPBSPJS');
            }
            
            function init(){// Admin init.
                $this->initConstants();
                
                if (is_admin()){
                    if ($this->validPage()){
                        $this->initTables();
                    }
                }
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
                define('DOPBSP_Users_table', $wpdb->prefix.'dopbsp_users');
            }

            function validPage(){// Valid Admin Page.
                if (isset($_GET['page'])){
                    if ($_GET['page'] == 'dopbsp' || $_GET['page'] == 'dopbsp-settings' || $_GET['page'] == 'dopbsp-help'){
                        return true;
                    }
                    else{
                        return false;
                    }
                }
                else{
                    return false;
                }
            }

            function initTables(){// Tables init.
                require_once(ABSPATH.'wp-admin/includes/upgrade.php');
                
                $sql_settings = "CREATE TABLE " . DOPBSP_Settings_table . " (
                                    id INT NOT NULL AUTO_INCREMENT,
                                    calendar_id INT NOT NULL,
                                    available_days VARCHAR(128) DEFAULT 'true,true,true,true,true,true,true' NOT NULL,
                                    currency INT DEFAULT 108 NOT NULL,
                                    date_type INT DEFAULT 1 NOT NULL,
                                    template VARCHAR(128) DEFAULT 'default' NOT NULL,
                                    template_email VARCHAR(128) DEFAULT 'default' NOT NULL,
                                    min_stay INT DEFAULT 1 NOT NULL,
                                    max_stay INT DEFAULT 0 NOT NULL,
                                    page_url VARCHAR(128) DEFAULT '' NOT NULL,  
                                    notifications_email VARCHAR(128) DEFAULT '' NOT NULL,                                       
                                    smtp_enabled VARCHAR(6) DEFAULT 'false' NOT NULL,                                     
                                    smtp_host_name VARCHAR(128) DEFAULT '' NOT NULL,
                                    smtp_host_port INT DEFAULT 25 NOT NULL,
                                    smtp_ssl VARCHAR(6) DEFAULT 'false' NOT NULL,                                   
                                    smtp_user VARCHAR(128) DEFAULT '' NOT NULL,                                   
                                    smtp_password VARCHAR(128) DEFAULT '' NOT NULL,
                                    multiple_days_select VARCHAR(6) DEFAULT 'true' NOT NULL,
                                    morning_check_out VARCHAR(6) DEFAULT 'false' NOT NULL,
                                    hours_enabled VARCHAR(6) DEFAULT 'false' NOT NULL,
                                    hours_definitions TEXT DEFAULT '' NOT NULL,
                                    multiple_hours_select VARCHAR(6) DEFAULT 'true' NOT NULL,
                                    hours_ampm VARCHAR(6) DEFAULT 'false' NOT NULL,
                                    discounts_no_days VARCHAR(256) DEFAULT '0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0' NOT NULL,
                                    deposit FLOAT DEFAULT 0 NOT NULL,
                                    name_enabled VARCHAR(6) DEFAULT 'true' NOT NULL,
                                    email_enabled VARCHAR(6) DEFAULT 'true' NOT NULL,
                                    phone_enabled VARCHAR(6) DEFAULT 'true' NOT NULL,
                                    no_people_enabled VARCHAR(6) DEFAULT 'true' NOT NULL,
                                    min_no_people INT DEFAULT 1 NOT NULL,
                                    max_no_people INT DEFAULT 4 NOT NULL,
                                    no_children_enabled VARCHAR(6) DEFAULT 'true' NOT NULL,
                                    min_no_children INT DEFAULT 0 NOT NULL,
                                    max_no_children INT DEFAULT 2 NOT NULL,
                                    message_enabled VARCHAR(6) DEFAULT 'true' NOT NULL,
                                    terms_and_conditions_enabled VARCHAR(6) DEFAULT 'false' NOT NULL,
                                    terms_and_conditions_link VARCHAR(128) DEFAULT '' NOT NULL,
                                    payment_arrival_enabled VARCHAR(6) DEFAULT 'true' NOT NULL,
                                    payment_paypal_enabled VARCHAR(6) DEFAULT 'false' NOT NULL,
                                    payment_paypal_username VARCHAR(128) DEFAULT '' NOT NULL,
                                    payment_paypal_password VARCHAR(128) DEFAULT '' NOT NULL,
                                    payment_paypal_signature VARCHAR(128) DEFAULT '' NOT NULL,  
                                    payment_paypal_sandbox_enabled VARCHAR(6) DEFAULT 'false' NOT NULL,
                                    max_year INT DEFAULT ".date('Y')." NOT NULL,
                                    UNIQUE KEY id (id)
                                );";
                
                $sql_calendars = "CREATE TABLE " . DOPBSP_Calendars_table . " (
                                    id int NOT NULL AUTO_INCREMENT,
                                    user_id int NOT NULL,
                                    name VARCHAR(128) DEFAULT '' NOT NULL,
                                    UNIQUE KEY id (id)
                                );";
                
                
                $sql_days = "CREATE TABLE " . DOPBSP_Days_table . " (
                                    calendar_id int NOT NULL,
                                    day VARCHAR(16) DEFAULT '' NOT NULL,
                                    year INT NOT NULL,
                                    data TEXT DEFAULT '' NOT NULL
                                );";

                $sql_reservations = "CREATE TABLE " . DOPBSP_Reservations_table . " (
                                    id int NOT NULL AUTO_INCREMENT,
                                    calendar_id int NOT NULL,
                                    check_in VARCHAR(16) DEFAULT '' NOT NULL,
                                    check_out VARCHAR(16) DEFAULT '' NOT NULL,
                                    start_hour VARCHAR(16) DEFAULT '' NOT NULL,
                                    end_hour VARCHAR(16) DEFAULT '' NOT NULL,
                                    no_items int DEFAULT 1 NOT NULL,
                                    currency VARCHAR(8) DEFAULT '' NOT NULL,
                                    currency_code VARCHAR(8) DEFAULT '' NOT NULL,
                                    total_price int DEFAULT 0 NOT NULL,
                                    discount int DEFAULT 0 NOT NULL,
                                    price int DEFAULT 0 NOT NULL,
                                    deposit int DEFAULT 0 NOT NULL,
                                    first_name VARCHAR(128) DEFAULT '' NOT NULL,
                                    last_name VARCHAR(128) DEFAULT '' NOT NULL,
                                    email VARCHAR(128) DEFAULT '' NOT NULL,
                                    phone VARCHAR(32) DEFAULT '' NOT NULL,                                                                 
                                    no_people int DEFAULT 1 NOT NULL,
                                    no_children int DEFAULT 0 NOT NULL,
                                    message TEXT DEFAULT '' NOT NULL,
                                    payment_method int DEFAULT 0 NOT NULL, 
                                    paypal_transaction_id VARCHAR(128) DEFAULT '' NOT NULL, 
                                    status VARCHAR(16) DEFAULT 'pending' NOT NULL, 
                                    date_created TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
                                    UNIQUE KEY id (id)
                                );";
                
                $sql_users = "CREATE TABLE " . DOPBSP_Users_table . " (
                                    id int NOT NULL AUTO_INCREMENT,
                                    user_id int DEFAULT 0 NOT NULL,
                                    type VARCHAR(16) DEFAULT '' NOT NULL,
                                    view VARCHAR(6) DEFAULT 'true' NOT NULL,
                                    view_all VARCHAR(6) DEFAULT 'false' NOT NULL,
                                    UNIQUE KEY id (id)
                                );";
                
                dbDelta($sql_settings);
                dbDelta($sql_calendars);
                dbDelta($sql_days);
                dbDelta($sql_reservations);
                dbDelta($sql_users);
                
//                global $wpdb;
//                $wpdb->query('ALTER TABLE '.DOPBSP_Users_table.' CONVERT TO CHARACTER SET latin1 COLLATE latin1_general_ci');
                
                $this->updateUsers();
            }

// Pages            
            function printAdminPage(){// Prints out the admin page.
                $this->DOPBSP_AddEditCalendars->calendarsList();
            }

            function printSettingsPage(){// Prints out the settings page.
                $this->DOPBSP_AddEditCalendars->settings();
            }
            
            function printHelpPage(){// Prints out the help page.
                $this->DOPBSP_AddEditCalendars->help();
            }

// Calendars            
            function showCalendars(){// Show Calendars List.
                global $wpdb;
                                    
                $calendarsHTML = array();
                array_push($calendarsHTML, '<ul>');
                
                if (wp_get_current_user()->roles[0] == 'administrator' && $this->administratorHasPermissions(wp_get_current_user()->ID)){
                    $calendars = $wpdb->get_results('SELECT * FROM '.DOPBSP_Calendars_table.' ORDER BY id DESC');
                }
                else{
                    $calendars = $wpdb->get_results('SELECT * FROM '.DOPBSP_Calendars_table.' WHERE user_id="'.wp_get_current_user()->ID.'" ORDER BY id DESC');
                }
                
                if ($wpdb->num_rows != 0){
                    foreach ($calendars as $calendar) {
                        array_push($calendarsHTML, '<li class="item" id="DOPBSP-ID-'.$calendar->id.'"><span class="id">ID '.$calendar->id.':</span> <span class="name">'.$this->shortCalendarName($calendar->name, 25).'</span></li>');
                    }
                }
                else{
                    array_push($calendarsHTML, '<li class="no-data">'.DOPBSP_NO_CALENDARS.'</li>');
                }
                
                array_push($calendarsHTML, '</ul>');
                echo implode('', $calendarsHTML);
                
            	die();                
            }
        
            function addCalendar(){// Add Calendar.
                global $wpdb;
                                
                $wpdb->insert(DOPBSP_Calendars_table, array('user_id' => wp_get_current_user()->ID,
                                                            'name' => DOPBSP_ADD_CALENDAR_NAME));
                $wpdb->insert(DOPBSP_Settings_table, array('calendar_id' => $wpdb->insert_id,
                                                           'hours_definitions' => '[{"value": "00:00"}]'));                                
                $this->showCalendars();

            	die();
            }

            function showCalendar(){// Show Calendar.
                if (isset($_POST['calendar_id'])){
                    global $wpdb;
                    global $DOPBSP_currencies;
                    global $DOPBSP_month_names;
                    global $DOPBSP_day_names;
                    $data = array();
                    
                    $settings = $wpdb->get_row('SELECT * FROM '.DOPBSP_Settings_table.' WHERE calendar_id="'.$_POST['calendar_id'].'"');
                                        
                    $data = array('AddtMonthViewText' => DOPBSP_ADD_MONTH_VIEW,
                                  'AvailableDays' => explode(',', $settings->available_days),
                                  'AvailableLabel' => DOPBSP_AVAILABLE_LABEL,
                                  'AvailableOneText' => DOPBSP_AVAILABLE_ONE_TEXT,
                                  'AvailableText' => DOPBSP_AVAILABLE_TEXT,
                                  'BookedText' => DOPBSP_BOOKED_TEXT,
                                  'Currency' => $DOPBSP_currencies[(int)$settings->currency-1]['sign'],
                                  'DateEndLabel' => DOPBSP_DATE_END_LABEL,
                                  'DateStartLabel' => DOPBSP_DATE_START_LABEL,
                                  'DateType' => 1,
                                  'DayNames' => $DOPBSP_day_names,
                                  'HoursEnabled' => $settings->hours_enabled,
                                  'GroupDaysLabel' => DOPBSP_GROUP_DAYS_LABEL,
                                  'GroupHoursLabel' => DOPBSP_GROUP_HOURS_LABEL,
                                  'HourEndLabel' => DOPBSP_HOURS_END_LABEL,
                                  'HourStartLabel' => DOPBSP_HOURS_START_LABEL,
                                  'HoursAMPM' => $settings->hours_ampm,
                                  'HoursDefinitions' => json_decode($settings->hours_definitions),
                                  'HoursDefinitionsChangeLabel' => DOPBSP_HOURS_DEFINITIONS_CHANGE_LABEL,
                                  'HoursDefinitionsLabel' => DOPBSP_HOURS_DEFINITIONS_LABEL,
                                  'HoursSetDefaultDataLabel' => DOPBSP_HOURS_SET_DEFAULT_DATA_LABEL, 
                                  'ID' => $_POST['calendar_id'],
                                  'InfoLabel' => DOPBSP_HOURS_INFO_LABEL,
                                  'MaxYear' => $settings->max_year,
                                  'MonthNames' => $DOPBSP_month_names,
                                  'NextMonthText' => DOPBSP_NEXT_MONTH,
                                  'NotesLabel' => DOPBSP_HOURS_NOTES_LABEL,
                                  'PreviousMonthText' => DOPBSP_PREVIOUS_MONTH,
                                  'PriceLabel' => DOPBSP_PRICE_LABEL,
                                  'PromoLabel' => DOPBSP_PROMO_LABEL,
                                  'RemoveMonthViewText' => DOPBSP_REMOVE_MONTH_VIEW,
                                  'ResetConfirmation' => DOPBSP_RESET_CONFIRMATION,
                                  'StatusAvailableText' => DOPBSP_STATUS_AVAILABLE_TEXT,
                                  'StatusBookedText' => DOPBSP_STATUS_BOOKED_TEXT,
                                  'StatusLabel' => DOPBSP_STATUS_LABEL,
                                  'StatusSpecialText' => DOPBSP_STATUS_SPECIAL_TEXT,
                                  'StatusUnavailableText' => DOPBSP_STATUS_UNAVAILABLE_TEXT,
                                  'UnavailableText' => DOPBSP_UNAVAILABLE_TEXT);
                    
                    echo json_encode($data);

                    die();
                }
            }
            
            function loadSchedule(){// Load Calendar Data.
                if (isset($_POST['calendar_id'])){
                    global $wpdb;
                    $schedule = array();
                    
                    $this->cleanSchedule();
                    $days = $wpdb->get_results('SELECT * FROM '.DOPBSP_Days_table.' WHERE calendar_id="'.$_POST['calendar_id'].'" AND year="'.$_POST['year'].'"');
                    
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
            
            function saveSchedule(){// Save Calendar Data.
                if (isset($_POST['calendar_id'])){
                    global $wpdb;
                    
                    $schedule = $_POST['schedule'];
                    $calendar_id = $_POST['calendar_id'];
                                        
                    while ($data = current($schedule)){
                        $day = key($schedule);
                        $day_items = explode('-', $day);
                        $result = $wpdb->get_results('SELECT * FROM '.DOPBSP_Days_table.' WHERE calendar_id='.$calendar_id.' AND day=\''.$day.'\'');
                                                
                        if ($wpdb->num_rows != 0){  
                            $wpdb->update(DOPBSP_Days_table, array('data' => json_encode($data)), array('calendar_id' => $calendar_id, 
                                                                                                        'day' => $day));
                        }
                        else{
                            $wpdb->insert(DOPBSP_Days_table, array('calendar_id' => $calendar_id,
                                                                   'day' => $day,
                                                                   'year' => $day_items[0],
                                                                   'data' => json_encode($data)));
                        }
                        
                        next($schedule);                        
                    }
                    
                    $max_year = $wpdb->get_row('SELECT MAX(year) AS year FROM '.DOPBSP_Days_table.' WHERE calendar_id="'.$calendar_id.'"');
                    
                    if ($max_year->year > 0){
                        $wpdb->update(DOPBSP_Settings_table, array('max_year' => $max_year->year), array('calendar_id' => $calendar_id));
                    }
                    else{
                        $wpdb->update(DOPBSP_Settings_table, array('max_year' => date('Y')), array('calendar_id' => $calendar_id));
                    }
                    
                    echo DOPBSP_EDIT_CALENDAR_SUCCESS;

                    die();
                }                
            }
            
            function deleteSchedule(){// Save Calendar Data.
                if (isset($_POST['calendar_id'])){
                    global $wpdb;
                    
                    $schedule = $_POST['schedule'];
                    $calendar_id = $_POST['calendar_id'];
                                        
                    while ($data = current($schedule)){
                        $day = key($schedule);
                        $wpdb->query('DELETE FROM '.DOPBSP_Days_table.' WHERE calendar_id='.$calendar_id.' AND day=\''.$day.'\'');                        
                        next($schedule);                        
                    }
                    
                    $max_year = $wpdb->get_row('SELECT MAX(year) AS year FROM '.DOPBSP_Days_table.' WHERE calendar_id="'.$calendar_id.'"'); 
                    
                    if ($max_year->year > 0){
                        $wpdb->update(DOPBSP_Settings_table, array('max_year' => $max_year->year), array('calendar_id' => $calendar_id));
                    }
                    else{
                        $wpdb->update(DOPBSP_Settings_table, array('max_year' => date('Y')), array('calendar_id' => $calendar_id));
                    }
                    
                    echo DOPBSP_EDIT_CALENDAR_SUCCESS;

                    die();
                }                
            }
            
            function cleanSchedule(){
                global $wpdb;
                $wpdb->query('DELETE FROM '.DOPBSP_Days_table.' WHERE day<\''.date('Y-m-d').'\'');
            }

            function showCalendarSettings(){// Show Calendar Info.
                global $wpdb;
                $result = array();
                
                $calendar = $wpdb->get_row('SELECT * FROM '.DOPBSP_Calendars_table.' WHERE id="'.$_POST['calendar_id'].'"');
                $settings = $wpdb->get_row('SELECT * FROM '.DOPBSP_Settings_table.' WHERE calendar_id="'.$_POST['calendar_id'].'"');
  
                $result['name'] = $calendar->name;
                
                $result['available_days'] = $settings->available_days;
                $result['currency'] = $settings->currency;
                $result['currencies_ids'] = $this->listCurrenciesIDs();
                $result['currencies_labels'] = $this->listCurrenciesLabels();
                $result['date_type'] = $settings->date_type;   
                $result['template'] = $settings->template;
                $result['templates'] = $this->listTemplates(); 
                $result['min_stay'] = $settings->min_stay;
                $result['max_stay'] = $settings->max_stay;
                $result['page_url'] = $settings->page_url;
                $result['template_email'] = $settings->template_email;
                $result['templates_email'] = $this->listEmailTemplates();  
                $result['notifications_email'] = $settings->notifications_email;  
                $result['smtp_enabled'] = $settings->smtp_enabled;
                $result['smtp_host_name'] = $settings->smtp_host_name;
                $result['smtp_host_port'] = $settings->smtp_host_port;
                $result['smtp_ssl'] = $settings->smtp_ssl;
                $result['smtp_user'] = $settings->smtp_user;
                $result['smtp_password'] = $settings->smtp_password;
                $result['multiple_days_select'] = $settings->multiple_days_select;
                $result['morning_check_out'] = $settings->morning_check_out;
                $result['hours_enabled'] = $settings->hours_enabled;
                $result['hours_definitions'] = json_decode($settings->hours_definitions);
                $result['multiple_hours_select'] = $settings->multiple_hours_select;
                $result['hours_ampm'] = $settings->hours_ampm;
                $result['discounts_no_days'] = $settings->discounts_no_days;
                $result['deposit'] = $settings->deposit;
                $result['name_enabled'] = $settings->name_enabled;
                $result['email_enabled'] = $settings->email_enabled;
                $result['phone_enabled'] = $settings->phone_enabled;
                $result['no_people_enabled'] = $settings->no_people_enabled;
                $result['min_no_people'] = $settings->min_no_people;
                $result['max_no_people'] = $settings->max_no_people;
                $result['no_children_enabled'] = $settings->no_children_enabled;
                $result['min_no_children'] = $settings->min_no_children;
                $result['max_no_children'] = $settings->max_no_children;
                $result['message_enabled'] = $settings->message_enabled;
                $result['terms_and_conditions_enabled'] = $settings->terms_and_conditions_enabled;
                $result['terms_and_conditions_link'] = $settings->terms_and_conditions_link;
                $result['payment_arrival_enabled'] = $settings->payment_arrival_enabled;
                $result['payment_paypal_enabled'] = $settings->payment_paypal_enabled;  
                $result['payment_paypal_username'] = $settings->payment_paypal_username;   
                $result['payment_paypal_password'] = $settings->payment_paypal_password;   
                $result['payment_paypal_signature'] = $settings->payment_paypal_signature;   
                $result['payment_paypal_sandbox_enabled'] = $settings->payment_paypal_sandbox_enabled;                           
                                            
                echo json_encode($result);
            	die();
            }
            
            function editCalendar(){// Edit Calendar Settings.
                global $wpdb;
                
                $settings = array('available_days' => $_POST['available_days'],
                                  'currency' => $_POST['currency'],
                                  'date_type' => $_POST['date_type'],
                                  'template' => $_POST['template'],
                                  'min_stay' => $_POST['min_stay'],
                                  'max_stay' => $_POST['max_stay'],
                                  'page_url' => $_POST['page_url'],
                                  'template_email' => $_POST['template_email'],
                                  'notifications_email' => $_POST['notifications_email'],
                                  'smtp_enabled' => $_POST['smtp_enabled'],
                                  'smtp_host_name' => $_POST['smtp_host_name'],
                                  'smtp_host_port' => $_POST['smtp_host_port'],
                                  'smtp_ssl' => $_POST['smtp_ssl'],
                                  'smtp_user' => $_POST['smtp_user'],
                                  'smtp_password' => $_POST['smtp_password'],
                                  'multiple_days_select' => $_POST['multiple_days_select'],
                                  'morning_check_out' => $_POST['morning_check_out'],
                                  'hours_enabled' => $_POST['hours_enabled'],
                                  'hours_definitions' => json_encode($_POST['hours_definitions']),
                                  'multiple_hours_select' => $_POST['multiple_hours_select'],
                                  'hours_ampm' => $_POST['hours_ampm'],
                                  'discounts_no_days' => $_POST['discounts_no_days'],
                                  'deposit' => $_POST['deposit'],
                                  'name_enabled' => $_POST['name_enabled'],
                                  'email_enabled' => $_POST['email_enabled'],
                                  'phone_enabled' => $_POST['phone_enabled'],
                                  'no_people_enabled' => $_POST['no_people_enabled'],
                                  'min_no_people' => $_POST['min_no_people'],
                                  'max_no_people' => $_POST['max_no_people'],
                                  'no_children_enabled' => $_POST['no_children_enabled'],
                                  'min_no_children' => $_POST['min_no_children'],
                                  'max_no_children' => $_POST['max_no_children'],
                                  'message_enabled' => $_POST['message_enabled'],
                                  'terms_and_conditions_enabled' => $_POST['terms_and_conditions_enabled'],
                                  'terms_and_conditions_link' => $_POST['terms_and_conditions_link'],
                                  'payment_arrival_enabled' => $_POST['payment_arrival_enabled'],
                                  'payment_paypal_enabled' => $_POST['payment_paypal_enabled'],
                                  'payment_paypal_username' => $_POST['payment_paypal_username'],
                                  'payment_paypal_password' => $_POST['payment_paypal_password'],
                                  'payment_paypal_signature' => $_POST['payment_paypal_signature'],
                                  'payment_paypal_sandbox_enabled' => $_POST['payment_paypal_sandbox_enabled']);     
                
                $wpdb->update(DOPBSP_Calendars_table, array('name' => $_POST['name']), array(id => $_POST['calendar_id']));
                $wpdb->update(DOPBSP_Settings_table, $settings, array('calendar_id' => $_POST['calendar_id']));
                
                echo '';
                
            	die();
            }

            function deleteCalendar(){// Delete Calendar.
                global $wpdb;

                $wpdb->query('DELETE FROM '.DOPBSP_Settings_table.' WHERE calendar_id="'.$_POST['id'].'"');
                $wpdb->query('DELETE FROM '.DOPBSP_Calendars_table.' WHERE id="'.$_POST['id'].'"');
                $wpdb->query('DELETE FROM '.DOPBSP_Days_table.' WHERE calendar_id="'.$_POST['id'].'"');
                $wpdb->query('DELETE FROM '.DOPBSP_Reservations_table.' WHERE calendar_id="'.$_POST['id'].'"');
                
                $calendars = $wpdb->get_results('SELECT * FROM '.DOPBSP_Calendars_table.' ORDER BY id DESC');
                
                echo $wpdb->num_rows;

            	die();
            }

// Reservations            
            function showNoReservations(){
                global $wpdb;
                
                $reservations = $wpdb->get_results('SELECT * FROM '.DOPBSP_Reservations_table.' WHERE calendar_id="'.$_POST['calendar_id'].'" AND CURDATE() <= check_in AND status <> "rejected" AND status <> "canceled"');
                echo $wpdb->num_rows;
                
            	die();      
            }
            
            function showReservations(){
                global $wpdb;     
                global $DOPBSP_month_names;           
                $reservationsHTML = array();
                                
                $settings = $wpdb->get_row('SELECT * FROM '.DOPBSP_Settings_table.' WHERE calendar_id="'.$_POST['calendar_id'].'"');
                $reservations = $wpdb->get_results('SELECT * FROM '.DOPBSP_Reservations_table.' WHERE calendar_id="'.$_POST['calendar_id'].'" AND CURDATE() <= check_in AND status <> "rejected" AND status <> "canceled" ORDER BY check_in DESC');
                     
                array_push($reservationsHTML, '<ul>');
                
                foreach ($reservations as $reservation){
                    array_push($reservationsHTML, '<li id="DOPBSP_Reservation_ID'.$reservation->id.'">');
                    
                    array_push($reservationsHTML, '<div class="DOPBookingSystemPRO_Reservation">');
                    array_push($reservationsHTML, '    <div class="container">');
                         
                    // ********************************************************* Dates/Hours Info
                                                
                    array_push($reservationsHTML, '        <div class="section">');
                        
                    $dayPieces = explode('-', $reservation->check_in);
                    $ciMonth = (int)$dayPieces[1];
                    $ciYear = $dayPieces[0];
                    $day = $this->dateToFormat($reservation->check_in, $settings->date_type);
                    
                    array_push($reservationsHTML, '            <div class="toggle" id="DOPBSP_Reservation_ToggleID'.$reservation->id.'">+</div>');
                    array_push($reservationsHTML, '            <div class="section-item name">'.$reservation->first_name.' '.$reservation->last_name.'</div>');

                    array_push($reservationsHTML, '            <div class="section-item">');
                    array_push($reservationsHTML, '                <label class="left">'.DOPBSP_RESERVATIONS_CHECK_IN_LABEL.'</label>');
                    array_push($reservationsHTML, '                <span class="date">'.$day.'</span>');
                    array_push($reservationsHTML, '                <br class="DOPBSP-clear" />');  
                    array_push($reservationsHTML, '            </div>');
                    
                    if ($reservation->check_out != ''){
                        $day = $this->dateToFormat($reservation->check_out, $settings->date_type);

                        array_push($reservationsHTML, '            <div class="section-item">');
                        array_push($reservationsHTML, '                <label class="left">'.DOPBSP_RESERVATIONS_CHECK_OUT_LABEL.'</label>');
                        array_push($reservationsHTML, '                <span class="date">'.$day.'</span>');
                        array_push($reservationsHTML, '                <br class="DOPBSP-clear" />');  
                        array_push($reservationsHTML, '            </div>');
                    }
                    
                    if ($reservation->start_hour != ''){
                        array_push($reservationsHTML, '            <div class="section-item">');
                        array_push($reservationsHTML, '                <label class="left">'.DOPBSP_RESERVATIONS_START_HOURS_LABEL.'</label>');
                        array_push($reservationsHTML, '                <span class="date">'.($settings->hours_ampm == 'true' ? $this->timeToAMPM($reservation->start_hour):$reservation->start_hour).'</span>');
                        array_push($reservationsHTML, '                <br class="DOPBSP-clear" />');  
                        array_push($reservationsHTML, '            </div>');
                    }
                    
                    if ($reservation->end_hour != ''){
                        array_push($reservationsHTML, '            <div class="section-item">');
                        array_push($reservationsHTML, '                <label class="left">'.DOPBSP_RESERVATIONS_END_HOURS_LABEL.'</label>');
                        array_push($reservationsHTML, '                <span class="date">'.($settings->hours_ampm == 'true' ? $this->timeToAMPM($reservation->end_hour):$reservation->end_hour).'</span>');
                        array_push($reservationsHTML, '                <br class="DOPBSP-clear" />');  
                        array_push($reservationsHTML, '            </div>');
                    }
                    array_push($reservationsHTML, '        </div>');
                    
                    
                    // ********************************************************* Dates/Hours Info
                                                
                    array_push($reservationsHTML, '        <div class="section content" id="DOPBSP_Reservation_ContentID'.$reservation->id.'">');
                    array_push($reservationsHTML, '            <div class="section-item">');
                    array_push($reservationsHTML, '                <label class="left">'.DOPBSP_RESERVATIONS_STATUS_LABEL.'</label>');
                    array_push($reservationsHTML, '                <span class="text" id="DOPBSP_Reservation_StatusID'.$reservation->id.'">'.($reservation->status == 'approved' ? DOPBSP_RESERVATIONS_STATUS_APPROVED:DOPBSP_RESERVATIONS_STATUS_PENDING).'</span>');
                    array_push($reservationsHTML, '                <br class="DOPBSP-clear" />');  
                    array_push($reservationsHTML, '            </div>');
                    array_push($reservationsHTML, '            <div class="section-item">');
                    array_push($reservationsHTML, '                <label class="left">'.DOPBSP_RESERVATIONS_DATE_CREATED_LABEL.'</label>');
                    array_push($reservationsHTML, '                <span class="text">'.$reservation->date_created.'</span>');
                    array_push($reservationsHTML, '                <br class="DOPBSP-clear" />');  
                    array_push($reservationsHTML, '            </div>');
                    
                    if ($reservation->payment_method != 0){
                        array_push($reservationsHTML, '            <div class="section-item">');
                        array_push($reservationsHTML, '                <label class="left">'.DOPBSP_RESERVATIONS_PAYMENT_METHOD_LABEL.'</label>');
                        array_push($reservationsHTML, '                <span class="text">'.($reservation->payment_method == 1 ? DOPBSP_RESERVATIONS_PAYMENT_METHOD_ARRIVAL:DOPBSP_RESERVATIONS_PAYMENT_METHOD_PAYPAL).'</span>');
                        array_push($reservationsHTML, '                <br class="DOPBSP-clear" />');  
                        array_push($reservationsHTML, '            </div>');
                    }
                                        
                    if ($reservation->paypal_transaction_id != ''){
                        array_push($reservationsHTML, '            <div class="section-item">');
                        array_push($reservationsHTML, '                <label class="left">'.DOPBSP_RESERVATIONS_PAYMENT_METHOD_PAYPAL_TRANSACTION_ID_LABEL.'</label>');
                        array_push($reservationsHTML, '                <span class="text">'.$reservation->paypal_transaction_id.'</span>');
                        array_push($reservationsHTML, '                <br class="DOPBSP-clear" />');  
                        array_push($reservationsHTML, '            </div>');
                    }
                    array_push($reservationsHTML, '            <div class="section-item">');
                    array_push($reservationsHTML, '                <label class="left">'.DOPBSP_RESERVATIONS_NO_ITEMS_LABEL.'</label>');
                    array_push($reservationsHTML, '                <span class="text">'.$reservation->no_items.'</span>');
                    array_push($reservationsHTML, '                <br class="DOPBSP-clear" />');  
                    array_push($reservationsHTML, '            </div>');
                    
                    if ($reservation->price != 0){
                        array_push($reservationsHTML, '            <div class="section-item">');
                        array_push($reservationsHTML, '                <label class="left">'.DOPBSP_RESERVATIONS_PRICE_LABEL.'</label>');
                        array_push($reservationsHTML, '                <span class="text">'.$reservation->currency.$reservation->price.'</span>');
                        array_push($reservationsHTML, '                <br class="DOPBSP-clear" />');  
                        array_push($reservationsHTML, '            </div>');
                    }
                    
                    if ($reservation->deposit != 0){
                        array_push($reservationsHTML, '            <div class="section-item">');
                        array_push($reservationsHTML, '                <label class="left">'.DOPBSP_RESERVATIONS_DEPOSIT_PRICE_LABEL.'</label>');
                        array_push($reservationsHTML, '                <span class="text">'.$reservation->currency.$reservation->deposit.' ('.$settings->deposit.'%)</span>');
                        array_push($reservationsHTML, '                <br class="DOPBSP-clear" />');  
                        array_push($reservationsHTML, '            </div>');
                        array_push($reservationsHTML, '            <div class="section-item">');
                        array_push($reservationsHTML, '                <label class="left">'.DOPBSP_RESERVATIONS_DEPOSIT_PRICE_LEFT_LABEL.'</label>');
                        array_push($reservationsHTML, '                <span class="text">'.$reservation->currency.($reservation->price-$reservation->deposit).'</span>');
                        array_push($reservationsHTML, '                <br class="DOPBSP-clear" />');  
                        array_push($reservationsHTML, '            </div>');
                    }
                    
                    if ($reservation->total_price != 0 && $reservation->total_price != $reservation->price){
                        array_push($reservationsHTML, '            <div class="section-item">');
                        array_push($reservationsHTML, '                <label class="left">'.DOPBSP_RESERVATIONS_DISCOUNT_PRICE_LABEL.'</label>');
                        array_push($reservationsHTML, '                <span class="text"><span class="cut">'.$reservation->currency.$reservation->total_price.'</span> ('.$reservation->discount.'% '.DOPBSP_RESERVATIONS_DISCOUNT_PRICE_TEXT.')</span>');
                        array_push($reservationsHTML, '                <br class="DOPBSP-clear" />');  
                        array_push($reservationsHTML, '            </div>');
                    }
                    
                    if ($reservation->email != ''){
                        array_push($reservationsHTML, '            <div class="section-item">');
                        array_push($reservationsHTML, '                <label class="left">'.DOPBSP_RESERVATIONS_EMAIL_LABEL.'</label>');
                        array_push($reservationsHTML, '                <span class="text"><a href="mailto:'.$reservation->email.'">'.$reservation->email.'</a></span>');
                        array_push($reservationsHTML, '                <br class="DOPBSP-clear" />');  
                        array_push($reservationsHTML, '            </div>');
                    }
                    
                    if ($reservation->phone != ''){
                        array_push($reservationsHTML, '            <div class="section-item">');
                        array_push($reservationsHTML, '                <label class="left">'.DOPBSP_RESERVATIONS_PHONE_LABEL.'</label>');
                        array_push($reservationsHTML, '                <span class="text">'.$reservation->phone.'</span>');
                        array_push($reservationsHTML, '                <br class="DOPBSP-clear" />');  
                        array_push($reservationsHTML, '            </div>');
                    }
                    
                    if ($reservation->no_people != '' && $reservation->no_people != 0){
                        array_push($reservationsHTML, '            <div class="section-item">');
                        array_push($reservationsHTML, '                <label class="left">'.($reservation->no_children == '' ? DOPBSP_RESERVATIONS_NO_PEOPLE_LABEL:DOPBSP_RESERVATIONS_NO_ADULTS_LABEL).'</label>');
                        array_push($reservationsHTML, '                <span class="text">'.$reservation->no_people.'</span>');
                        array_push($reservationsHTML, '                <br class="DOPBSP-clear" />');  
                        array_push($reservationsHTML, '            </div>');
                    }
                    
                    if ($reservation->no_children != '' && $reservation->no_children != 0){
                        array_push($reservationsHTML, '            <div class="section-item">');
                        array_push($reservationsHTML, '                <label class="left">'.DOPBSP_RESERVATIONS_NO_CHILDREN_LABEL.'</label>');
                        array_push($reservationsHTML, '                <span class="text">'.$reservation->no_children.'</span>');
                        array_push($reservationsHTML, '                <br class="DOPBSP-clear" />');  
                        array_push($reservationsHTML, '            </div>');
                    }
                   
                    if ($reservation->message != ''){
                        array_push($reservationsHTML, '            <div class="section-item">');
                        array_push($reservationsHTML, '                <label class="left">'.DOPBSP_RESERVATIONS_MESSAGE_LABEL.'</label>');
                        array_push($reservationsHTML, '                <span class="text">'.$reservation->message.'</span>');
                        array_push($reservationsHTML, '                <br class="DOPBSP-clear" />');  
                        array_push($reservationsHTML, '            </div>');
                    }
                    array_push($reservationsHTML, '            <div class="section-item">');
                    array_push($reservationsHTML, '                <label class="left">&nbsp;</label>');
                    array_push($reservationsHTML, '                <span class="text">');                        
                    array_push($reservationsHTML, '                     <a href="javascript:void(0)" class="DOPBookingSystemPRO_Message_JumpDay" id="DOPBookingSystemPRO_Message_JumpDay_'.$ciYear.'-'.$ciMonth.'">'.DOPBSP_RESERVATIONS_JUMP_TO_DAY_LABEL.'</a>');    
                    
                    if ($reservation->status == 'pending'){              
                        array_push($reservationsHTML, '                     <a href="javascript:void(0)" class="DOPBookingSystemPRO_ReservationApprove" id="DOPBookingSystemPRO_ReservationApprove'.$reservation->id.'">'.DOPBSP_RESERVATIONS_APPROVE_LABEL.'</a>');                  
                        array_push($reservationsHTML, '                     <a href="javascript:void(0)" class="DOPBookingSystemPRO_ReservationReject" id="DOPBookingSystemPRO_ReservationReject'.$reservation->id.'">'.DOPBSP_RESERVATIONS_REJECT_LABEL.'</a>');
                        array_push($reservationsHTML, '                     <a href="javascript:void(0)" class="DOPBookingSystemPRO_ReservationCancel" id="DOPBookingSystemPRO_ReservationCancel'.$reservation->id.'" style="display: none;">'.DOPBSP_RESERVATIONS_CANCEL_LABEL.'</a>');
                    }
                    else{
                        array_push($reservationsHTML, '                     <a href="javascript:void(0)" class="DOPBookingSystemPRO_ReservationCancel" id="DOPBookingSystemPRO_ReservationCancel'.$reservation->id.'">'.DOPBSP_RESERVATIONS_CANCEL_LABEL.'</a>');
                    }
                    
                    array_push($reservationsHTML, '                </span>');
                    array_push($reservationsHTML, '                <br class="DOPBSP-clear" />');  
                    array_push($reservationsHTML, '            </div>');
                    array_push($reservationsHTML, '        </div>');                   
                    array_push($reservationsHTML, '    </div>');                      
                    array_push($reservationsHTML, '</div>');
                    
                    
                    array_push($reservationsHTML, '</li>');
                }
                array_push($reservationsHTML, '</ul>');
                
                echo implode("\n", $reservationsHTML);
                
            	die();      
            }
            
            function approveReservation(){                
                if (isset($_POST['reservation_id'])){
                    global $wpdb;
                    $notes = array();
                    
                    // =========================================================
                    
                    $DOPemail = new DOPBookingSystemPROEmail();
                    $reservationId = $_POST['reservation_id'];
                                        
                    $settings = $wpdb->get_row('SELECT * FROM '.DOPBSP_Settings_table.' WHERE calendar_id="'.$_POST['calendar_id'].'"');
                    $reservation = $wpdb->get_row('SELECT * FROM '.DOPBSP_Reservations_table.' WHERE id="'.$_POST['reservation_id'].'"');
                    
                    if ($settings->notifications_email){
                        $message = DOPBSP_EMAIL_APPROVED_MESSAGE;

                        $message_ids = '<strong>'.DOPBSP_RESERVATIONS_ID.'</strong> '.$reservationId;

                        $message_date = $reservation->check_in != '' ? '<strong>'.DOPBSP_RESERVATIONS_CHECK_IN_LABEL.':</strong> '.$this->dateToFormat($reservation->check_in, $settings->date_type):'';
                        $message_date .= $reservation->check_out != '' ? '<br /><strong>'.DOPBSP_RESERVATIONS_CHECK_OUT_LABEL.':</strong> '.$this->dateToFormat($reservation->check_out, $settings->date_type):'';
                        $message_date .= $reservation->start_hour != '' ?  '<br /><strong>'.DOPBSP_RESERVATIONS_START_HOURS_LABEL.':</strong> '.($settings->hours_ampm == 'true' ? $this->timeToAMPM($reservation->start_hour):$reservation->start_hour):'';
                        $message_date .= $reservation->end_hour != '' ? '<br /><strong>'.DOPBSP_RESERVATIONS_END_HOURS_LABEL.':</strong> '.($settings->hours_ampm == 'true' ? $this->timeToAMPM($reservation->end_hour):$reservation->end_hour):'';

                        $message_price = $reservation->no_items != '' ? '<strong>'.DOPBSP_RESERVATIONS_NO_ITEMS_LABEL.':</strong> '.$reservation->no_items:'';
                        $message_price .= $reservation->price != 0 ? '<br /><strong>'.DOPBSP_RESERVATIONS_TOTAL_PRICE_LABEL.'</strong> '.$reservation->currency.$reservation->price:'';
                        $message_price .= $reservation->deposit != 0 ? '<br /><strong>'.DOPBSP_DEPOSIT_PRICE_LABEL.'</strong> '.$reservation->currency.$reservation->deposit.' ('.$settings->deposit.'%)'.
                                                                       '<br /><strong>'.DOPBSP_DEPOSIT_PRICE_LEFT_LABEL.'</strong> '.$reservation->currency.($reservation->price-$reservation->deposit):'';
                        $message_price .= $reservation->total_price != 0 && $reservation->total_price != $reservation->price ? '<br /><strong>'.DOPBSP_DISCOUNT_PRICE_LABEL.'</strong> <span style="text-decoration: line-through;">'.$reservation->currency.$reservation->total_price.'</span> ('.$reservation->discount.'% '.DOPBSP_DISCOUNT_TEXT.')':'';
                
                        $message_form .= $reservation->first_name != '' ? '<strong>'.DOPBSP_RESERVATIONS_FIRST_NAME_LABEL.':</strong> '.$reservation->first_name:'';
                        $message_form .= $reservation->last_name != '' ? '<br /><strong>'.DOPBSP_RESERVATIONS_LAST_NAME_LABEL.':</strong> '.$reservation->last_name:'';
                        $message_form .= $reservation->email != '' ? '<br /><strong>'.DOPBSP_RESERVATIONS_EMAIL_LABEL.':</strong> '.$reservation->email:'';
                        $message_form .= $reservation->phone != '' ? '<br /><strong>'.DOPBSP_RESERVATIONS_PHONE_LABEL.':</strong> '.$reservation->phone:'';
                        $message_form .= $reservation->no_people != '' && $reservation->no_people != 0 ? ($reservation->no_children == '' && $reservation->no_children == 0 ? '<br /><strong>'.DOPBSP_RESERVATIONS_NO_PEOPLE_LABEL:'<br /><strong>'.DOPBSP_RESERVATIONS_NO_ADULTS_LABEL).':</strong> '.$reservation->no_people:'';
                        $message_form .= $reservation->no_children != '' && $reservation->no_children != 0 ? '<br /><strong>'.DOPBSP_RESERVATIONS_NO_CHILDREN_LABEL.':</strong> '.$reservation->no_children:'';
                        $message_form .= $reservation->message != '' ? '<br /><strong>'.DOPBSP_RESERVATIONS_MESSAGE_LABEL.':</strong> '.$reservation->message:'';
                        
                        if ($settings->smtp_enabled == 'true'){
                            $DOPemail->sendSMTPEmail($reservation->email,
                                                     $settings->notifications_email,
                                                     DOPBSP_EMAIL_APPROVED_SUBJECT,
                                                     $DOPemail->message($message,
                                                                        $message_ids,
                                                                        $message_date,
                                                                        $message_price,
                                                                        $message_form,
                                                                        DOPBSP_Plugin_URL.'emails/'.$settings->template_email.'/book-approved-email.html'),
                                                     $settings->smtp_host_name,
                                                     $settings->smtp_host_port,
                                                     $settings->smtp_ssl,
                                                     $settings->smtp_user,
                                                     $settings->smtp_password);
                        }
                        else{
                            $DOPemail->sendEmail($reservation->email,
                                                 $settings->notifications_email,
                                                 DOPBSP_EMAIL_APPROVED_SUBJECT,
                                                 $DOPemail->message($message,
                                                                    $message_ids,
                                                                    $message_date,
                                                                    $message_price,
                                                                    $message_form,
                                                                    DOPBSP_Plugin_URL.'emails/'.$settings->template_email.'/book-approved-email.html'));
                        }
                    }
                    
                    // =========================================================
                    
                    $wpdb->update(DOPBSP_Reservations_table, array('status' => 'approved'), array('id' => $_POST['reservation_id']));
                    
                    
                    array_push($notes, '<strong>'.DOPBSP_RESERVATIONS_ID.':</strong> '.$reservation->id);
                    
                    if ($reservation->price != 0){
                        array_push($notes, '<strong>'.DOPBSP_RESERVATIONS_TOTAL_PRICE_LABEL.'</strong> '.$reservation->currency.$reservation->price);
                    }
                    
                    if ($reservation->deposit != 0){
                        array_push($notes, '<strong>'.DOPBSP_DEPOSIT_PRICE_LABEL.'</strong> '.$reservation->currency.$reservation->deposit.' ('.$settings->deposit.'%)');
                        array_push($notes, '<strong>'.DOPBSP_DEPOSIT_PRICE_LEFT_LABEL.'</strong> '.$reservation->currency.($reservation->price-$reservation->deposit));
                    }
                    
                    if ($reservation->total_price != 0 && $reservation->total_price != $reservation->price){
                        array_push($notes, '<strong>'.DOPBSP_DISCOUNT_PRICE_LABEL.'</strong> <span style="text-decoration: line-through;">'.$reservation->currency.$reservation->total_price.'</span> ('.$reservation->discount.'% '.DOPBSP_DISCOUNT_TEXT.')');
                    }

                    if ($reservation->first_name != ''){
                        array_push($notes, '<strong>'.$reservation->first_name.' '.$reservation->last_name.'</strong>');
                    }

                    if ($reservation->email != ''){
                        array_push($notes, '<strong>'.DOPBSP_RESERVATIONS_EMAIL_LABEL.':</strong> '.$reservation->email);
                    }

                    if ($reservation->phone != ''){
                        array_push($notes, '<strong>'.DOPBSP_RESERVATIONS_PHONE_LABEL.':</strong> '.$reservation->phone);
                    }

                    if ($reservation->no_people != '' && $reservation->no_people != 0){
                        array_push($notes, '<strong>'.($reservation->no_children == '' && $reservation->no_children == 0 ? DOPBSP_RESERVATIONS_NO_PEOPLE_LABEL:DOPBSP_RESERVATIONS_NO_ADULTS_LABEL).':</strong> '.$reservation->no_people);
                    }

                    if ($reservation->no_children != '' && $reservation->no_children != 0){
                        array_push($notes, '<strong>'.DOPBSP_RESERVATIONS_NO_CHILDREN_LABEL.':</strong> '.$reservation->no_children);
                    }

                    if ($reservation->message != ''){
                        array_push($notes, '<strong>'.DOPBSP_RESERVATIONS_MESSAGE_LABEL.':</strong> '.$reservation->message);
                    }

                    array_push($notes, '------------------------------<br />');
                    
                    // =========================================================
                    
                    if ($reservation->check_out == ''){
                        $day = $wpdb->get_row('SELECT * FROM '.DOPBSP_Days_table.' WHERE calendar_id="'.$reservation->calendar_id.'" AND day="'.$reservation->check_in.'"');
                    }
                    else{
                        if ($settings->morning_check_out == 'true'){
                            $days = $wpdb->get_results('SELECT * FROM '.DOPBSP_Days_table.' WHERE calendar_id="'.$reservation->calendar_id.'" AND day>="'.$reservation->check_in.'" AND day<"'.$reservation->check_out.'"');
                        }
                        else{
                            $days = $wpdb->get_results('SELECT * FROM '.DOPBSP_Days_table.' WHERE calendar_id="'.$reservation->calendar_id.'" AND day>="'.$reservation->check_in.'" AND day<="'.$reservation->check_out.'"');
                        }
                    }

            
                    if ($reservation->check_out == '' && $reservation->start_hour == ''){ 
                        $data = json_decode($day->data);

                        if ($data->available == '' || (int)$data->available < 1){
                            $available = 1;
                        }
                        else{
                            $available = $data->available;
                        }

                        if ($available-$reservation->no_items == 0){
                                $data->price = '';
                                $data->promo = '';
                                $data->status = 'booked';
                        }

                        $data->available = $available-$reservation->no_items;
                        $data->notes = $data->notes.implode('<br />', $notes);

                        $wpdb->update(DOPBSP_Days_table, array('data' => json_encode($data)), array('calendar_id' => $reservation->calendar_id, 
                                                                                                    'day' => $day->day));
                    }
                    else if ($reservation->check_out != ''){                 
                        foreach ($days as $key => $day){
                            $data = json_decode($day->data);

                            if ($data->available == '' || (int)$data->available < 1){
                                $available = 1;
                            }
                            else{
                                $available = $data->available;
                            }

                            if ($available-$reservation->no_items == 0){
                                    $data->price = '';
                                    $data->promo = '';
                                    $data->status = 'booked';
                            }

                            $data->available = $available-$reservation->no_items;
                            $data->notes = $data->notes.implode('<br />', $notes);

                            $wpdb->update(DOPBSP_Days_table, array('data' => json_encode($data)), array('calendar_id' => $reservation->calendar_id, 
                                                                                                        'day' => $day->day));
                        }
                    }
                    else if ($reservation->start_hour != '' && $reservation->end_hour == ''){ 
                        $data = json_decode($day->data);
                        $start_hour = $reservation->start_hour;
                        $hour = $data->hours->$start_hour;

                        if ($hour->available == '' || (int)$hour->available < 1){
                            $available = 1;
                        }
                        else{
                            $available = (int)$hour->available;
                        }

                        if ($available-$reservation->no_items == 0){
                            $hour->price = '';
                            $hour->promo = '';
                            $hour->status = 'booked';
                        }

                        $hour->available = $available-$reservation->no_items;
                        $hour->notes = $hour->notes.implode('<br />', $notes);

                        $data->hours->$start_hour = $hour;
                        $wpdb->update(DOPBSP_Days_table, array('data' => json_encode($data)), array('calendar_id' => $reservation->calendar_id, 
                                                                                                    'day' => $day->day));
                    }
                    else if ($reservation->end_hour != ''){
                        $data = json_decode($day->data);

                        foreach ($data->hours as $key => $item){
                            if ($reservation->start_hour <= $key && $key <= $reservation->end_hour){
                                $hour = $data->hours->$key;

                                if ($hour->available == '' || (int)$hour->available < 1){
                                    $available = 1;
                                }
                                else{
                                    $available = (int)$hour->available;
                                }

                                if ($available-$reservation->no_items == 0){
                                    $hour->price = '';
                                    $hour->promo = '';
                                    $hour->status = 'booked';
                                }

                                $hour->available = $available-$reservation->no_items;
                                $hour->notes = $hour->notes.implode('<br />', $notes);

                                $data->hours->$key = $hour;
                            }
                        }

                        $wpdb->update(DOPBSP_Days_table, array('data' => json_encode($data)), array('calendar_id' => $reservation->calendar_id, 
                                                                                                    'day' => $day->day));
                    }
            
                    $ci = explode('-', $reservation->check_in);
                    echo $ci[0].'-'.(int)$ci[1];
                    die();
                }
            }
            
            function rejectReservation(){
                if (isset($_POST['reservation_id'])){
                    global $wpdb;

                    $wpdb->update(DOPBSP_Reservations_table, array('status' => 'rejected'), array('id' => $_POST['reservation_id']));
                    $DOPemail = new DOPBookingSystemPROEmail();
                    $reservationId = $_POST['reservation_id'];
                                        
                    $settings = $wpdb->get_row('SELECT * FROM '.DOPBSP_Settings_table.' WHERE calendar_id="'.$_POST['calendar_id'].'"');
                    $reservation = $wpdb->get_row('SELECT * FROM '.DOPBSP_Reservations_table.' WHERE id="'.$_POST['reservation_id'].'"');
                    
                    if ($settings->notifications_email){
                        $message = DOPBSP_EMAIL_REJECTED_MESSAGE;

                        $message_ids = '<strong>'.DOPBSP_RESERVATIONS_ID.'</strong> '.$reservationId;

                        $message_date = $reservation->check_in != '' ? '<strong>'.DOPBSP_RESERVATIONS_CHECK_IN_LABEL.':</strong> '.$this->dateToFormat($reservation->check_in, $settings->date_type):'';
                        $message_date .= $reservation->check_out != '' ? '<br /><strong>'.DOPBSP_RESERVATIONS_CHECK_OUT_LABEL.':</strong> '.$this->dateToFormat($reservation->check_out, $settings->date_type):'';
                        $message_date .= $reservation->start_hour != '' ?  '<br /><strong>'.DOPBSP_RESERVATIONS_START_HOURS_LABEL.':</strong> '.($settings->hours_ampm == 'true' ? $this->timeToAMPM($reservation->start_hour):$reservation->start_hour):'';
                        $message_date .= $reservation->end_hour != '' ? '<br /><strong>'.DOPBSP_RESERVATIONS_END_HOURS_LABEL.':</strong> '.($settings->hours_ampm == 'true' ? $this->timeToAMPM($reservation->end_hour):$reservation->end_hour):'';

                        $message_price = $reservation->no_items != '' ? '<strong>'.DOPBSP_RESERVATIONS_NO_ITEMS_LABEL.':</strong> '.$reservation->no_items:'';
                        $message_price .= $reservation->price != '' ? '<br /><strong>'.DOPBSP_RESERVATIONS_TOTAL_PRICE_LABEL.'</strong> '.$reservation->currency.$reservation->price:'';
                        $message_price .= $reservation->deposit != 0 ? '<br /><strong>'.DOPBSP_DEPOSIT_PRICE_LABEL.'</strong> '.$reservation->currency.$reservation->deposit.' ('.$settings->deposit.'%)'.
                                                                       '<br /><strong>'.DOPBSP_DEPOSIT_PRICE_LEFT_LABEL.'</strong> '.$reservation->currency.($reservation->price-$reservation->deposit):'';
                        $message_price .= $reservation->total_price != 0 && $reservation->total_price != $reservation->price ? '<br /><strong>'.DOPBSP_DISCOUNT_PRICE_LABEL.'</strong> <span style="text-decoration: line-through;">'.$reservation->currency.$reservation->total_price.'</span> ('.$reservation->discount.'% '.DOPBSP_DISCOUNT_TEXT.')':'';
                
                        $message_form .= $reservation->first_name != '' ? '<strong>'.DOPBSP_RESERVATIONS_FIRST_NAME_LABEL.':</strong> '.$reservation->first_name:'';
                        $message_form .= $reservation->last_name != '' ? '<br /><strong>'.DOPBSP_RESERVATIONS_LAST_NAME_LABEL.':</strong> '.$reservation->last_name:'';
                        $message_form .= $reservation->email != '' ? '<br /><strong>'.DOPBSP_RESERVATIONS_EMAIL_LABEL.':</strong> '.$reservation->email:'';
                        $message_form .= $reservation->phone != '' ? '<br /><strong>'.DOPBSP_RESERVATIONS_PHONE_LABEL.':</strong> '.$reservation->phone:'';
                        $message_form .= $reservation->no_people != '' && $reservation->no_people != 0 ? ($reservation->no_children == '' && $reservation->no_children == 0 ? '<br /><strong>'.DOPBSP_RESERVATIONS_NO_PEOPLE_LABEL:'<br /><strong>'.DOPBSP_RESERVATIONS_NO_ADULTS_LABEL).':</strong> '.$reservation->no_people:'';
                        $message_form .= $reservation->no_children != '' && $reservation->no_children != 0 ? '<br /><strong>'.DOPBSP_RESERVATIONS_NO_CHILDREN_LABEL.':</strong> '.$reservation->no_children:'';
                        $message_form .= $reservation->message != '' ? '<br /><strong>'.DOPBSP_RESERVATIONS_MESSAGE_LABEL.':</strong> '.$reservation->message:'';
                        
                        if ($settings->smtp_enabled == 'true'){
                            $DOPemail->sendSMTPEmail($reservation->email,
                                                     $settings->notifications_email,
                                                     DOPBSP_EMAIL_REJECTED_SUBJECT,
                                                     $DOPemail->message($message,
                                                                        $message_ids,
                                                                        $message_date,
                                                                        $message_price,
                                                                        $message_form,
                                                                        DOPBSP_Plugin_URL.'emails/'.$settings->template_email.'/book-rejected-email.html'),
                                                     $settings->smtp_host_name,
                                                     $settings->smtp_host_port,
                                                     $settings->smtp_ssl,
                                                     $settings->smtp_user,
                                                     $settings->smtp_password);
                        }
                        else{
                            $DOPemail->sendEmail($reservation->email,
                                                 $settings->notifications_email,
                                                 DOPBSP_EMAIL_REJECTED_SUBJECT,
                                                 $DOPemail->message($message,
                                                                    $message_ids,
                                                                    $message_date,
                                                                    $message_price,
                                                                    $message_form,
                                                                    DOPBSP_Plugin_URL.'emails/'.$settings->template_email.'/book-rejected-email.html'));
                        }
                    }

                    echo '';
                    die();
                }
            }
            
            function cancelReservation(){
                if (isset($_POST['reservation_id'])){
                    global $wpdb;
                    
                    $reservationId = $_POST['reservation_id'];
                    echo $reservationId;
                    $wpdb->update(DOPBSP_Reservations_table, array('status' => 'canceled'), array('id' => $reservationId));
                    $DOPemail = new DOPBookingSystemPROEmail();
                                        
                    $settings = $wpdb->get_row('SELECT * FROM '.DOPBSP_Settings_table.' WHERE calendar_id="'.$_POST['calendar_id'].'"');
                    $reservation = $wpdb->get_row('SELECT * FROM '.DOPBSP_Reservations_table.' WHERE id="'.$reservationId.'"');
                    
                    if ($settings->notifications_email){
                        $message = DOPBSP_EMAIL_CANCELED_MESSAGE;

                        $message_ids = '<strong>'.DOPBSP_RESERVATIONS_ID.'</strong> '.$reservationId;

                        $message_date = $reservation->check_in != '' ? '<strong>'.DOPBSP_RESERVATIONS_CHECK_IN_LABEL.':</strong> '.$this->dateToFormat($reservation->check_in, $settings->date_type):'';
                        $message_date .= $reservation->check_out != '' ? '<br /><strong>'.DOPBSP_RESERVATIONS_CHECK_OUT_LABEL.':</strong> '.$this->dateToFormat($reservation->check_out, $settings->date_type):'';
                        $message_date .= $reservation->start_hour != '' ?  '<br /><strong>'.DOPBSP_RESERVATIONS_START_HOURS_LABEL.':</strong> '.($settings->hours_ampm == 'true' ? $this->timeToAMPM($reservation->start_hour):$reservation->start_hour):'';
                        $message_date .= $reservation->end_hour != '' ? '<br /><strong>'.DOPBSP_RESERVATIONS_END_HOURS_LABEL.':</strong> '.($settings->hours_ampm == 'true' ? $this->timeToAMPM($reservation->end_hour):$reservation->end_hour):'';

                        $message_price = $reservation->no_items != '' ? '<strong>'.DOPBSP_RESERVATIONS_NO_ITEMS_LABEL.':</strong> '.$reservation->no_items:'';
                        $message_price .= $reservation->price != '' ? '<br /><strong>'.DOPBSP_RESERVATIONS_TOTAL_PRICE_LABEL.'</strong> '.$reservation->currency.$reservation->price:'';
                        $message_price .= $reservation->deposit != 0 ? '<br /><strong>'.DOPBSP_DEPOSIT_PRICE_LABEL.'</strong> '.$reservation->currency.$reservation->deposit.' ('.$settings->deposit.'%)'.
                                                                       '<br /><strong>'.DOPBSP_DEPOSIT_PRICE_LEFT_LABEL.'</strong> '.$reservation->currency.($reservation->price-$reservation->deposit):'';
                        $message_price .= $reservation->total_price != 0 && $reservation->total_price != $reservation->price ? '<br /><strong>'.DOPBSP_DISCOUNT_PRICE_LABEL.'</strong> <span style="text-decoration: line-through;">'.$reservation->currency.$reservation->total_price.'</span> ('.$reservation->discount.'% '.DOPBSP_DISCOUNT_TEXT.')':'';
                
                        $message_form .= $reservation->first_name != '' ? '<strong>'.DOPBSP_RESERVATIONS_FIRST_NAME_LABEL.':</strong> '.$reservation->first_name:'';
                        $message_form .= $reservation->last_name != '' ? '<br /><strong>'.DOPBSP_RESERVATIONS_LAST_NAME_LABEL.':</strong> '.$reservation->last_name:'';
                        $message_form .= $reservation->email != '' ? '<br /><strong>'.DOPBSP_RESERVATIONS_EMAIL_LABEL.':</strong> '.$reservation->email:'';
                        $message_form .= $reservation->phone != '' ? '<br /><strong>'.DOPBSP_RESERVATIONS_PHONE_LABEL.':</strong> '.$reservation->phone:'';
                        $message_form .= $reservation->no_people != '' && $reservation->no_people != 0 ? ($reservation->no_children == '' && $reservation->no_children == 0 ? '<br /><strong>'.DOPBSP_RESERVATIONS_NO_PEOPLE_LABEL:'<br /><strong>'.DOPBSP_RESERVATIONS_NO_ADULTS_LABEL).':</strong> '.$reservation->no_people:'';
                        $message_form .= $reservation->no_children != '' && $reservation->no_children != 0 ? '<br /><strong>'.DOPBSP_RESERVATIONS_NO_CHILDREN_LABEL.':</strong> '.$reservation->no_children:'';
                        $message_form .= $reservation->message != '' ? '<br /><strong>'.DOPBSP_RESERVATIONS_MESSAGE_LABEL.':</strong> '.$reservation->message:'';
                        
                        if ($settings->smtp_enabled == 'true'){
                            $DOPemail->sendSMTPEmail($reservation->email,
                                                     $settings->notifications_email,
                                                     DOPBSP_EMAIL_CANCELED_SUBJECT,
                                                     $DOPemail->message($message,
                                                                        $message_ids,
                                                                        $message_date,
                                                                        $message_price,
                                                                        $message_form,
                                                                        DOPBSP_Plugin_URL.'emails/'.$settings->template_email.'/book-canceled-email.html'),
                                                     $settings->smtp_host_name,
                                                     $settings->smtp_host_port,
                                                     $settings->smtp_ssl,
                                                     $settings->smtp_user,
                                                     $settings->smtp_password);
                        }
                        else{
                            $DOPemail->sendEmail($reservation->email,
                                                 $settings->notifications_email,
                                                 DOPBSP_EMAIL_CANCELED_SUBJECT,
                                                 $DOPemail->message($message,
                                                                    $message_ids,
                                                                    $message_date,
                                                                    $message_price,
                                                                    $message_form,
                                                                    DOPBSP_Plugin_URL.'emails/'.$settings->template_email.'/book-canceled-email.html'));
                        }
                    }

                    echo '';
                    die();
                }
            }

// Options
            function listTemplates(){
                $folder = DOPBSP_Plugin_AbsPath.'templates/';
                $folderData = opendir($folder);
                $list = array();
                
                while (($file = readdir($folderData)) !== false){
                    if ($file != '.' && $file != '..'){                        
                        array_push($list, $file);
                    }
                }
                closedir($folderData);
                
                return implode(';;', $list);
            }
            
            function listEmailTemplates(){
                $folder = DOPBSP_Plugin_AbsPath.'emails/';
                $folderData = opendir($folder);
                $list = array();
                
                while (($file = readdir($folderData)) !== false){
                    if ($file != '.' && $file != '..'){                        
                        array_push($list, $file);
                    }
                }
                closedir($folderData);
                
                return implode(';;', $list);
            }
            
            function listCurrenciesIDs(){
                global $DOPBSP_currencies;
                $result = array();
                
                for ($i=0; $i<count($DOPBSP_currencies); $i++){
                    array_push($result, $DOPBSP_currencies[$i]['id']);
                }
                
                return implode(';;', $result);
            }
            
            function listCurrenciesLabels(){
                global $DOPBSP_currencies;
                $result = array();
                
                for ($i=0; $i<count($DOPBSP_currencies); $i++){
                    array_push($result, $DOPBSP_currencies[$i]['name'].' ('.$DOPBSP_currencies[$i]['sign'].', '.$DOPBSP_currencies[$i]['code'].')');
                }
                
                return implode(';;', $result);          
            }
            
            function shortCalendarName($name, $size){// Return a short name for the calendar.
                $new_name = '';
                $pieces = str_split($name);
               
                if (count($pieces) <= $size){
                    $new_name = $name;
                }
                else{
                    for ($i=0; $i<$size-3; $i++){
                        $new_name .= $pieces[$i];
                    }
                    $new_name .= '...';
                }

                return $new_name;
            }
            
// Settings
            function updateUsers(){
                require_once(ABSPATH.'wp-includes/pluggable.php');
                global $wpdb;
                
                $users = get_users('orderby=id');
                
                foreach ($users as $user){
                    $control_data = $wpdb->get_results('SELECT * FROM '.DOPBSP_Users_table.' WHERE user_id='.$user->ID);

                    if ($wpdb->num_rows == 0){
                        if (get_userdata($user->ID)->roles[0] == 'subscriber'){
                            $wpdb->insert(DOPBSP_Users_table, array('user_id' => $user->ID,
                                                                    'type' => get_userdata($user->ID)->roles[0],
                                                                    'view' => 'false'));
                        }
                        else{
                            $wpdb->insert(DOPBSP_Users_table, array('user_id' => $user->ID,
                                                                    'type' => get_userdata($user->ID)->roles[0]));
                        }
                    }
                }
            }

            function administratorHasPermissions($id){
                global $wpdb;     
                
                $user = $wpdb->get_row('SELECT * FROM '.DOPBSP_Users_table.' WHERE id='.$id);
                
                if ($user->view_all == 'true'){
                    return true;                    
                }
                else{
                    return false;
                }
            }

            function userHasPermissions($id){
                global $wpdb;     
                
                $user = $wpdb->get_row('SELECT * FROM '.DOPBSP_Users_table.' WHERE user_id='.$id);
         
                if ($user->view == 'true'){
                    return true;                    
                }
                else{
                    return false;
                }
            }
            
            function editUserPermissions(){
                global $wpdb;
                
                if ($_POST['field'] == '1'){
                    $data = array('view' => $_POST['value']);
                }
                else{
                    $data = array('view_all' => $_POST['value']);
                }
                
                $wpdb->update(DOPBSP_Users_table, $data, array(user_id => $_POST['id']));
                
                echo '';
                
            	die();
            }
            
// Editor Changes
            function addDOPBSPtoTinyMCE(){// Add calendar button to TinyMCE Editor.
                add_filter('tiny_mce_version', array (&$this, 'changeTinyMCEVersion'));
                add_action('init', array (&$this, 'addDOPBSPButtons'));
            }

            function tinyMCECalendars(){// Send data to editor button.
                global $wpdb;
                $tinyMCE_data = '';
                $calendarsList = array();

                $calendars = $wpdb->get_results('SELECT * FROM '.DOPBSP_Calendars_table.' WHERE user_id="'.wp_get_current_user()->ID.'" ORDER BY id');
                
                foreach ($calendars as $calendar){
                    array_push($calendarsList, $calendar->id.';;'.$calendar->name);
                }
                $tinyMCE_data = DOPBSP_TINYMCE_ADD.';;;;;'.implode(';;;', $calendarsList);
                
                echo '<script type="text/JavaScript">'.
                     '    var DOPBSP_tinyMCE_data = "'.$tinyMCE_data.'"'.
                     '</script>';
            }

            function addDOPBSPButtons(){// Add Button.
                if (!current_user_can('edit_posts') && !current_user_can('edit_pages')){
                    return;
                }

                if ( get_user_option('rich_editing') == 'true'){
                    add_action('admin_head', array (&$this, 'tinyMCECalendars'));
                    add_filter('mce_external_plugins', array (&$this, 'addDOPBSPTinyMCEPlugin'), 5);
                    add_filter('mce_buttons', array (&$this, 'registerDOPBSPTinyMCEPlugin'), 5);
                }
            }

            function registerDOPBSPTinyMCEPlugin($buttons){// Register editor buttons.
                array_push($buttons, '', 'DOPBSP');
                return $buttons;
            }

            function addDOPBSPTinyMCEPlugin($plugin_array){// Add plugin to TinyMCE editor.
                $plugin_array['DOPBSP'] =  DOPBSP_Plugin_URL.'assets/js/tinymce-plugin.js';
                return $plugin_array;
            }

            function changeTinyMCEVersion($version){// TinyMCE version.
                $version = $version+100;
                return $version;
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