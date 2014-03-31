<?php
/*
Plugin Name: Booking System PRO (WordPress Plugin)
Version: 1.2
Plugin URI: ?ref=MariusCristianDonea
Description: You will be able to insert it in any page or post you want with an inbuilt short code generator.<br /><br />If you like this plugin, feel free to rate it five stars at <a href="?ref=MariusCristianDonea" target="_blank">CodeCanyon</a> in your downloads section. If you encounter any problems please do not give a low rating but <a href="mailto:me@mariuscristiandonea.com">contact me</a> first so I can help you.
Author: Marius-Cristian Donea
Author URI: http://www.mariuscristiandonea.com

Change log:

        1.3 (2012-11-25)

                * Deposit feature has been added.
                * Discounts by number of days booked have been added.
                * Correct hours format is displayed.
	
	1.2 (2011-11-01)
 
                * Rejected reservation notification email fix.  
                * Reservation cancel added.
                * AM/PM hour format added.
                * Hours data save bug fixed.
                * You can set default hours values by day(s).
                * You can select minimum and/or maximum amount of days that can be booked.
                * Shortcode generator doesn't appear if you are not allowed to create calendars or you didn't create any calendars.
                * Past hours are removed from current day.
                * User permissions bug fix.
                * Morning Check Out added.
                * Language files added (but not translated).
                * SMTP SSL fix.

	1.1 (2011-09-05)
	
		* Database structure has been changed (now is much faster to save/load data & works on server with few resources).
                * Clean script to remove past days info to clear database from unecessary data.
                * Display corect month in future years bug fix.
                * Back End & Front End CSS incompatibility fixes.
                * You can set if indiviadual users can create or not calendars.
                * Administrators can view and edit users calendars.
                * PayPal bugs fixed.
                * You can use SMTP to send notification emails.
                * Delete calendar bug fix.
                * Reservation ID is displayed in notifications emails.
                * Emails template system added.
                * Terms & Conditions checkbox and link added.
                * You can now add calendar sidebar in a widget area.
                * ereg() function replaced with preg_match().
	
	1.0 (2011-07-15)
	
		* Initial release.
		
Installation: Upload the folder dopbsp from the zip file to "wp-content/plugins/" and activate the plugin in your admin panel or upload dopbsp.zip in the "Add new" section.
*/

    include_once 'views/templates.php';
    include_once 'views/currencies.php';
    include_once 'dopbsp-email.php';
    include_once 'dopbsp-frontend.php';
    include_once 'dopbsp-backend.php';
    include_once 'dopbsp-widget.php';
    
    if (isset($_COOKIE["DOPBookingSystemPROBackEndLanguage"])){
        include "translation/backend/".$_COOKIE["DOPBookingSystemPROBackEndLanguage"]."-widget.php";        
    }
    else{
        include "translation/backend/en-widget.php";
    }

    if (is_admin()){// If admin is loged in admin init administration panel.
        if (isset($_COOKIE["DOPBookingSystemPROBackEndLanguage"])){
            include "translation/backend/".$_COOKIE["DOPBookingSystemPROBackEndLanguage"].".php";        
        }
        else{
            include "translation/backend/en.php";
        }

        if (class_exists("DOPBookingSystemPROBackEnd")){
            $DOPBSP_pluginSeries = new DOPBookingSystemPROBackEnd();
        }

        if (!function_exists("DOPBookingSystemPROBackEnd_ap")){// Initialize the admin panel.
            function DOPBookingSystemPROBackEnd_ap(){
                global $DOPBSP_pluginSeries;

                if (!isset($DOPBSP_pluginSeries)){
                    return;
                }
                
                $DOPBSP_pluginSeries->initTables();
        
                switch (wp_get_current_user()->roles[0]){
                    case 'author':
                        $role_action = 'publish_posts';
                        break;
                    case 'contributor':
                        $role_action = 'edit_posts';
                        break;
                    case 'editor':
                        $role_action = 'edit_pages';
                        break;
                    case 'subscriber':
                        $role_action = 'read';
                        break;
                    default:
                        $role_action = 'manage_options';
                        break;
                }
                
                if (!$DOPBSP_pluginSeries->userHasPermissions(wp_get_current_user()->ID)){
                    $role_action = 'manage_options';                            
                }

                if (function_exists('add_options_page')){
                    add_menu_page(DOPBSP_TITLE, DOPBSP_TITLE, $role_action, 'dopbsp', array(&$DOPBSP_pluginSeries, 'printAdminPage'), plugins_url('assets/gui/images/dop-icon.png', __FILE__));
                    add_submenu_page('dopbsp', DOPBSP_TITLE_SETTINGS, DOPBSP_TITLE_SETTINGS, 'manage_options', 'dopbsp-settings', array(&$DOPBSP_pluginSeries, 'printSettingsPage'));
                    add_submenu_page('dopbsp', DOPBSP_TITLE_HELP, DOPBSP_TITLE_HELP, $role_action, 'dopbsp-help', array(&$DOPBSP_pluginSeries, 'printHelpPage'));
                }
            }
        }

        if (isset($DOPBSP_pluginSeries)){// Init AJAX functions.
            add_action('admin_menu', 'DOPBookingSystemPROBackEnd_ap');
            add_action('wp_ajax_dopbsp_show_calendars', array(&$DOPBSP_pluginSeries, 'showCalendars'));
            add_action('wp_ajax_dopbsp_add_calendar', array(&$DOPBSP_pluginSeries, 'addCalendar'));
            add_action('wp_ajax_dopbsp_show_calendar', array(&$DOPBSP_pluginSeries, 'showCalendar'));
            add_action('wp_ajax_dopbsp_load_schedule', array(&$DOPBSP_pluginSeries, 'loadSchedule'));
            add_action('wp_ajax_dopbsp_save_schedule', array(&$DOPBSP_pluginSeries, 'saveSchedule'));
            add_action('wp_ajax_dopbsp_delete_schedule', array(&$DOPBSP_pluginSeries, 'deleteSchedule'));
            add_action('wp_ajax_dopbsp_show_calendar_settings', array(&$DOPBSP_pluginSeries, 'showCalendarSettings'));
            add_action('wp_ajax_dopbsp_edit_calendar', array(&$DOPBSP_pluginSeries, 'editCalendar'));
            add_action('wp_ajax_dopbsp_delete_calendar', array(&$DOPBSP_pluginSeries, 'deleteCalendar'));        
            add_action('wp_ajax_dopbsp_show_no_reservations', array(&$DOPBSP_pluginSeries, 'showNoReservations'));
            add_action('wp_ajax_dopbsp_show_reservations', array(&$DOPBSP_pluginSeries, 'showReservations'));
            add_action('wp_ajax_dopbsp_approve_reservation', array(&$DOPBSP_pluginSeries, 'approveReservation'));
            add_action('wp_ajax_dopbsp_reject_reservation', array(&$DOPBSP_pluginSeries, 'rejectReservation'));
            add_action('wp_ajax_dopbsp_cancel_reservation', array(&$DOPBSP_pluginSeries, 'cancelReservation'));
            add_action('wp_ajax_dopbsp_edit_user_permissions', array(&$DOPBSP_pluginSeries, 'editUserPermissions'));
        }
    }
    else{// If you view the WordPress website init the gallery.
        if (class_exists("DOPBookingSystemPROFrontEnd")){
            $DOPBSP_pluginSeries = new DOPBookingSystemPROFrontEnd();
        }

        if (isset($DOPBSP_pluginSeries)){// Init AJAX functions.
            add_action('wp_ajax_dopbsp_load_schedule', array(&$DOPBSP_pluginSeries, 'loadSchedule'));
            add_action('wp_ajax_dopbsp_paypal_check', array(&$DOPBSP_pluginSeries, 'paypalCheck'));
            add_action('wp_ajax_dopbsp_book_request', array(&$DOPBSP_pluginSeries, 'bookRequest'));
        }
    }
        
    add_action('widgets_init', create_function('', 'return register_widget("DOPBookingSystemProWidget");'));
    
?>