/*
* Title                   : Booking System PRO (WordPress Plugin)
* Version                 : 1.2
* File                    : dopbsp-backend.js
* File Version            : 1.2
* Created / Last Modified : 01 November 2012
* Author                  : Marius-Cristian Donea
* Copyright               : © 2012 Marius-Cristian Donea
* Website                 : http://www.mariuscristiandonea.com
* Description             : Booking System PRO Admin Scripts.
*/

//Declare global variables.
var currCalendar = 0,
clearClick = true,
calendarLoaded = false,
messageTimeout,
$jDOPBSP = jQuery.noConflict();

$jDOPBSP(document).ready(function(){
    dopbspResize();

    switch (DOPBSP_curr_page){
        case 'Calendars List':
            dopbspShowCalendars();
            break;
        case 'Help':
            dopbspInitHelp();
            break;
    }
});

function dopbspResize(){// ResiE admin panel.
    if (DOPBSP_curr_page != 'Settings'){
        if (!calendarLoaded){
            $jDOPBSP('.column2', '.DOPBSP-admin').width(($jDOPBSP('.DOPBSP-admin').width()-$jDOPBSP('.column1', '.DOPBSP-admin').width()-2)/2);
            $jDOPBSP('.column3', '.DOPBSP-admin').width(($jDOPBSP('.DOPBSP-admin').width()-$jDOPBSP('.column1', '.DOPBSP-admin').width()-2)/2);
        }
        else{
            $jDOPBSP('.column2', '.DOPBSP-admin').width(620);
            $jDOPBSP('.column3', '.DOPBSP-admin').width($jDOPBSP('.DOPBSP-admin').width()-$jDOPBSP('.column1', '.DOPBSP-admin').width()-$jDOPBSP('.column2', '.DOPBSP-admin').width()-2);
        }
    }
    else{
        $jDOPBSP('.column2', '.DOPBSP-admin').width($jDOPBSP('.DOPBSP-admin').width()-$jDOPBSP('.column1', '.DOPBSP-admin').width()-2);
        $jDOPBSP('.column3', '.DOPBSP-admin').width(0);
    }
    
    $jDOPBSP('.column-separator', '.DOPBSP-admin').height(0);
    $jDOPBSP('.column-separator', '.DOPBSP-admin').height($jDOPBSP('.DOPBSP-admin').height()-$jDOPBSP('h2', '.DOPBSP-admin').height()-parseInt($jDOPBSP('h2', '.DOPBSP-admin').css('padding-top'))-parseInt($jDOPBSP('h2', '.DOPBSP-admin').css('padding-bottom')));
    $jDOPBSP('.main', '.DOPBSP-admin').css('display', 'block');
    
    setTimeout(function(){
        dopbspResize();
    }, 100);
}

function dopbspResizeOneTime(){// ResiE admin panel.
    if (!calendarLoaded){
        $jDOPBSP('.column2', '.DOPBSP-admin').width(($jDOPBSP('.DOPBSP-admin').width()-$jDOPBSP('.column1', '.DOPBSP-admin').width()-2)/2);
        $jDOPBSP('.column3', '.DOPBSP-admin').width(($jDOPBSP('.DOPBSP-admin').width()-$jDOPBSP('.column1', '.DOPBSP-admin').width()-2)/2);
    }
    else{
        $jDOPBSP('.column2', '.DOPBSP-admin').width(620);
        $jDOPBSP('.column3', '.DOPBSP-admin').width($jDOPBSP('.DOPBSP-admin').width()-$jDOPBSP('.column1', '.DOPBSP-admin').width()-$jDOPBSP('.column2', '.DOPBSP-admin').width()-2);
    }
    
    $jDOPBSP('.column-separator', '.DOPBSP-admin').height(0);
    $jDOPBSP('.column-separator', '.DOPBSP-admin').height($jDOPBSP('.DOPBSP-admin').height()-$jDOPBSP('h2', '.DOPBSP-admin').height()-parseInt($jDOPBSP('h2', '.DOPBSP-admin').css('padding-top'))-parseInt($jDOPBSP('h2', '.DOPBSP-admin').css('padding-bottom')));
    $jDOPBSP('.main', '.DOPBSP-admin').css('display', 'block');
}

//****************************************************************************** Translation

function dopbspChangeTranslation(){
    dopbspSetCookie('DOPBookingSystemPROBackEndLanguage', $jDOPBSP('#DOPBSP-admin-translation').val(), 7);
    window.location.reload();
}

//****************************************************************************** Calendars

function dopbspShowCalendars(){// Show all calendars.
    if (clearClick){
        dopbspRemoveColumns(1);
        dopbspToggleMessage('show', DOPBSP_LOAD);
        
        $jDOPBSP('#DOPBSP-add-calendar-btn').css('display', 'block');
        $jDOPBSP('#DOPBSP-add-language-btn').css('display', 'none');
        $jDOPBSP('#DOPBSP-edit-calendars-btn').css('display', 'block');
        $jDOPBSP('#DOPBSP-languages-help').css('display', 'none');
        $jDOPBSP('#DOPBSP-languages-btn').css('display', 'block');
        $jDOPBSP('#DOPBSP-calendars-help').css('display', 'block');
        $jDOPBSP('#DOPBSP-calendars-btn').css('display', 'none');

        $jDOPBSP.post(ajaxurl, {action:'dopbsp_show_calendars'}, function(data){
            $jDOPBSP('.column-content', '.column1', '.DOPBSP-admin').html(data);
            dopbspCalendarsEvents();
            dopbspToggleMessage('hide', DOPBSP_CALENDARS_LOADED);
        });
    }
}

function dopbspAddCalendar(){// Add calendar via AJAX.
    if (clearClick){
        dopbspRemoveColumns(2);
        dopbspToggleMessage('show', DOPBSP_ADD_CALENDAR_SUBMITED);
        
        $jDOPBSP.post(ajaxurl, {action:'dopbsp_add_calendar'}, function(data){
            $jDOPBSP('.column-content', '.column1', '.DOPBSP-admin').html(data);
            dopbspCalendarsEvents();
            dopbspToggleMessage('hide', DOPBSP_ADD_CALENDAR_SUCCESS);
        });
    }
}

function dopbspCalendarsEvents(){// Init Calendar Events.
    $jDOPBSP('li', '.column1', '.DOPBSP-admin').click(function(){
        if (clearClick){
            var id = $jDOPBSP(this).attr('id').split('-')[2];
            
            if (currCalendar != id){
                currCalendar = id;
                $jDOPBSP('li', '.column1', '.DOPBSP-admin').removeClass('item-selected');
                $jDOPBSP(this).addClass('item-selected');
                dopbspShowCalendar(id);
            }
        }
    });
}

function dopbspShowCalendar(calendar_id){// Show Images List.
    if (clearClick){
        $jDOPBSP('#calendar_id').val(calendar_id);
        dopbspRemoveColumns(2);
        calendarLoaded = true;            
        dopbspToggleMessage('show', DOPBSP_LOAD);
        
        $jDOPBSP.post(ajaxurl, {action:'dopbsp_show_calendar', calendar_id:calendar_id}, function(data){
            var HeaderHTML = new Array();
            
            HeaderHTML.push('<div class="edit-button">');
            HeaderHTML.push('    <a href="javascript:dopbspShowCalendarSettings()" title="'+DOPBSP_EDIT_CALENDAR_SUBMIT+'"></a>');
            HeaderHTML.push('</div>');
            HeaderHTML.push('<div class="reservations-button">');
            HeaderHTML.push('    <a href="javascript:void(0)" id="DOPBSP-reservations" title="'+DOPBSP_SHOW_RESERVATIONS+'"><span></span></a>');
            HeaderHTML.push('</div>');
            HeaderHTML.push('<a href="javascript:void()" class="header-help" title="'+DOPBSP_CALENDAR_EDIT_HELP+'"></a>');
            
            $jDOPBSP('.column-header', '.column2', '.DOPBSP-admin').html(HeaderHTML.join(''));
            $jDOPBSP('.column-content', '.column2', '.DOPBSP-admin').html('<div id="DOPBSP-Calendar"></div>');
            
            $jDOPBSP('#DOPBSP-Calendar').DOPBookingSystemPRO($jDOPBSP.parseJSON(data));
                        
            $jDOPBSP.post(ajaxurl, {action:'dopbsp_show_no_reservations', calendar_id:calendar_id}, function(data){
                if (parseInt(data) != 0){
                    $jDOPBSP('#DOPBSP-reservations').addClass('new');
                    $jDOPBSP('#DOPBSP-reservations span').html(data);
                }
            });            
        });
    }
}

//****************************************************************************** Settings

function dopbspShowCalendarSettings(){// Show calendar settings.
    if (clearClick){
        $jDOPBSP('li', '.column2', '.DOPBSP-admin').removeClass('item-image-selected');
        dopbspRemoveColumns(2);
        dopbspToggleMessage('show', DOPBSP_LOAD);
        
        $jDOPBSP.post(ajaxurl, {action:'dopbsp_show_calendar_settings', calendar_id:$jDOPBSP('#calendar_id').val()}, function(data){
            var HeaderHTML = new Array(),
            json = $jDOPBSP.parseJSON(data);
            
            HeaderHTML.push('<input type="button" name="DOPBSP_calendar_submit" class="submit-style" onclick="dopbspEditCalendar()" title="'+DOPBSP_EDIT_CALENDAR_SUBMIT+'" value="'+DOPBSP_SUBMIT+'" />');
            HeaderHTML.push('<input type="button" name="DOPBSP_calendar_delete" class="submit-style" onclick="dopbspDeleteCalendar('+$jDOPBSP('#calendar_id').val()+')" title="'+DOPBSP_DELETE_CALENDAR_SUBMIT+'" value="'+DOPBSP_DELETE+'" />');
            HeaderHTML.push('<input type="button" name="DOPBSP_calendar_back" class="submit-style" onclick="dopbspShowCalendar('+$jDOPBSP('#calendar_id').val()+')" title="'+DOPBSP_BACK_SUBMIT+'" value="'+DOPBSP_BACK+'" />');
            HeaderHTML.push('<a href="javascript:void()" class="header-help" title="'+DOPBSP_CALENDAR_EDIT_SETTINGS_HELP+'"></a>');
            
            $jDOPBSP('.column-header', '.column2', '.DOPBSP-admin').html(HeaderHTML.join(''));
            dopbspSettingsForm(json, 2);
            
            dopbspToggleMessage('hide', DOPBSP_CALENDAR_LOADED);
        });
    }
}

function dopbspEditCalendar(){// Edit Calendar Settings.
    if (clearClick){
        dopbspToggleMessage('show', DOPBSP_SAVE);
        
        var availableDays = '', i,
        hoursDefinitions = new Array(),
        hours = new Array(),
        discountsNoDays = new Array();
            
        for (i=0; i<7; i++){    
            if ($jDOPBSP('#available_days'+i).is(':checked')){
                if (i == 0){
                    availableDays += 'true';
                }
                else{
                    availableDays += ',true';                    
                }                
            } 
            else{
                if (i == 0){
                    availableDays += 'false';
                }
                else{
                    availableDays += ',false';                    
                }
            }
        }
        
        if ($jDOPBSP('#hours_definitions').val() != ''){
            hoursDefinitions = $jDOPBSP('#hours_definitions').val().split('\n');

            for (i=0; i<hoursDefinitions.length; i++){
                hoursDefinitions[i] = hoursDefinitions[i].replace(/\s/g, "");
                                    
                if (hoursDefinitions[i] != ''){
                    hours.push({'value': hoursDefinitions[i]});
                }
            }
        }
        else{
            hours.push({'value': '00:00'});
        }
        
        $jDOPBSP('#discounts_no_days option').each(function(){
            discountsNoDays.push($jDOPBSP(this).attr('value'));
        });
        
        $jDOPBSP.post(ajaxurl, {action:'dopbsp_edit_calendar',
                                calendar_id: $jDOPBSP('#calendar_id').val(),
                                name: $jDOPBSP('#name').val(),
                                available_days: availableDays,
                                currency: $jDOPBSP('#currency').val(),
                                date_type: $jDOPBSP('#date_type').val(),
                                template: $jDOPBSP('#template').val(),
                                min_stay: $jDOPBSP('#min_stay').val(),
                                max_stay: $jDOPBSP('#max_stay').val(),
                                page_url: $jDOPBSP('#page_url').val(),
                                template_email: $jDOPBSP('#template_email').val(),
                                notifications_email: $jDOPBSP('#notifications_email').val(),
                                smtp_enabled: $jDOPBSP('#smtp_enabled').val(),
                                smtp_host_name: $jDOPBSP('#smtp_host_name').val(),
                                smtp_host_port: $jDOPBSP('#smtp_host_port').val(),
                                smtp_ssl: $jDOPBSP('#smtp_ssl').val(),
                                smtp_user: $jDOPBSP('#smtp_user').val(),
                                smtp_password: $jDOPBSP('#smtp_password').val(),
                                multiple_days_select: $jDOPBSP('#multiple_days_select').val(),
                                morning_check_out: $jDOPBSP('#morning_check_out').val(),
                                hours_enabled: $jDOPBSP('#hours_enabled').val(),
                                hours_definitions: hours,
                                multiple_hours_select: $jDOPBSP('#multiple_hours_select').val(),
                                hours_ampm: $jDOPBSP('#hours_ampm').val(),
                                discounts_no_days: discountsNoDays.join(','),
                                deposit: $jDOPBSP('#deposit').val(),
                                name_enabled: $jDOPBSP('#name_enabled').val(),
                                email_enabled: $jDOPBSP('#email_enabled').val(),
                                phone_enabled: $jDOPBSP('#phone_enabled').val(),
                                no_people_enabled: $jDOPBSP('#no_people_enabled').val(),
                                min_no_people: $jDOPBSP('#min_no_people').val(),
                                max_no_people: $jDOPBSP('#max_no_people').val(),
                                no_children_enabled: $jDOPBSP('#no_children_enabled').val(),
                                min_no_children: $jDOPBSP('#min_no_children').val(),
                                max_no_children: $jDOPBSP('#max_no_children').val(),
                                message_enabled: $jDOPBSP('#message_enabled').val(),
                                terms_and_conditions_enabled: $jDOPBSP('#terms_and_conditions_enabled').val(),
                                terms_and_conditions_link: $jDOPBSP('#terms_and_conditions_link').val(),
                                payment_arrival_enabled: $jDOPBSP('#payment_arrival_enabled').val(),
                                payment_paypal_enabled: $jDOPBSP('#payment_paypal_enabled').val(),
                                payment_paypal_username: $jDOPBSP('#payment_paypal_username').val(),
                                payment_paypal_password: $jDOPBSP('#payment_paypal_password').val(),
                                payment_paypal_signature: $jDOPBSP('#payment_paypal_signature').val(),
                                payment_paypal_sandbox_enabled: $jDOPBSP('#payment_paypal_sandbox_enabled').val()}, function(data){
            if ($jDOPBSP('#calendar_id').val() != '0'){
                $jDOPBSP('.name', '#DOPBSP-ID-'+$jDOPBSP('#calendar_id').val()).html($jDOPBSP('#name').val());
                dopbspToggleMessage('hide', DOPBSP_EDIT_CALENDAR_SUCCESS);
            }
            else{
                dopbspToggleMessage('hide', DOPBSP_EDIT_CALENDARS_SUCCESS);
            }
        });
    }
}

function dopbspDeleteCalendar(id){// Delete calendar
    if (clearClick){
        if (confirm(DOPBSP_DELETE_CALENDAR_CONFIRMATION)){
            dopbspToggleMessage('show', DOPBSP_DELETE_CALENDAR_SUBMITED);
            
            $jDOPBSP.post(ajaxurl, {action:'dopbsp_delete_calendar', id:id}, function(data){
                dopbspRemoveColumns(2);
                
                $jDOPBSP('#DOPBSP-ID-'+id).stop(true, true).animate({'opacity':0}, 600, function(){
                    $jDOPBSP(this).remove();
                    
                    if (data == '0'){
                        $jDOPBSP('.column-content', '.column1', '.DOPBSP-admin').html('<ul><li class="no-data">'+DOPBSP_NO_CALENDARS+'</li></ul>');
                    }
                    dopbspToggleMessage('hide', DOPBSP_DELETE_CALENDAR_SUCCESS);
                });
            });
        }
    }
}

function dopbspRemoveColumns(no){// Clear columns content.
    if (no <= 1){
        $jDOPBSP('.column-content', '.column1', '.DOPBSP-admin').html('');
    }
    if (no <= 2){
        $jDOPBSP('.column-header', '.column2', '.DOPBSP-admin').html('');
        $jDOPBSP('.column-content', '.column2', '.DOPBSP-admin').html('');
        calendarLoaded = false;
    }
    if (no <= 3){
        $jDOPBSP('.column-header', '.column3', '.DOPBSP-admin').html('');
        $jDOPBSP('.column-content', '.column3', '.DOPBSP-admin').html('');        
    }
}

function dopbspToggleMessage(action, message){// Display Info Messages.
    if (action == 'show'){
        clearClick = false;        
        clearTimeout(messageTimeout);
        $jDOPBSP('#DOPBSP-admin-message').addClass('loader');
        $jDOPBSP('#DOPBSP-admin-message').html(message);
        $jDOPBSP('#DOPBSP-admin-message').stop(true, true).animate({'opacity':1}, 600);
    }
    else{
        clearClick = true;
        $jDOPBSP('#DOPBSP-admin-message').removeClass('loader');
        $jDOPBSP('#DOPBSP-admin-message').html(message);
        
        messageTimeout = setTimeout(function(){
            $jDOPBSP('#DOPBSP-admin-message').stop(true, true).animate({'opacity':0}, 600, function(){
                $jDOPBSP('#DOPBSP-admin-message').html('');
            });
        }, 2000);
    }
}

function dopbspSettingsForm(data, column){// Settings Form.
    var HTML = new Array(), i,
    discountsNoDays = data['discounts_no_days'].split(','),
    discountsNoDaysValues = new Array(), 
    discountsNoDaysLabels = new Array();
    
    HTML.push('<form method="post" class="settings" action="" onsubmit="return false;">');

// General Settings
    HTML.push('    <h3 class="settings">'+DOPBSP_GENERAL_STYLES_SETTINGS+'</h3>');
    
    if ($jDOPBSP('#calendar_id').val() != '0'){
        HTML.push(dopbspSettingsFormInput('name', data['name'], DOPBSP_CALENDAR_NAME, '', '', '', 'help', DOPBSP_CALENDAR_NAME_INFO));
    }
    HTML.push(dopbspSettingsFormAvailableDays('available_days', data['available_days'], DOPBSP_AVAILABLE_DAYS, '', '', '', 'help', DOPBSP_AVAILABLE_DAYS_INFO));
    HTML.push(dopbspSettingsFormSelect('currency', data['currency'], DOPBSP_CURRENCY, '', '', '', 'help', DOPBSP_CURRENCY_INFO, data['currencies_ids'], data['currencies_labels']));
    HTML.push(dopbspSettingsFormSelect('date_type', data['date_type'], DOPBSP_DATE_TYPE, '', '', '', 'help', DOPBSP_DATE_TYPE_INFO, '1;;2', DOPBSP_DATE_TYPE_AMERICAN+';;'+DOPBSP_DATE_TYPE_EUROPEAN));
    HTML.push(dopbspSettingsFormSelect('template', data['template'], DOPBSP_TEMPLATE, '', '', '', 'help', DOPBSP_TEMPLATE_INFO, data['templates'], data['templates']));
    HTML.push(dopbspSettingsFormInput('min_stay', data['min_stay'], DOPBSP_MIN_STAY, '', '', '', 'help', DOPBSP_MIN_STAY_INFO));  
    HTML.push(dopbspSettingsFormInput('max_stay', data['max_stay'], DOPBSP_MAX_STAY, '', '', '', 'help', DOPBSP_MAX_STAY_INFO));  
    HTML.push(dopbspSettingsFormInput('page_url', data['page_url'], DOPBSP_PAGE_URL, '', '', '', 'help', DOPBSP_PAGE_URL_INFO));  
    
// Notifications Settings
    HTML.push('    <a href="javascript:dopbspMoveTop()" class="go-top">'+DOPBSP_GO_TOP+'</a><h3 class="settings">'+DOPBSP_NOTIFICATIONS_STYLES_SETTINGS+'</h3>'); 
    HTML.push(dopbspSettingsFormSelect('template_email', data['template_email'], DOPBSP_NOTIFICATIONS_TEMPLATE, '', '', '', 'help', DOPBSP_NOTIFICATIONS_TEMPLATE_INFO, data['templates_email'], data['templates_email']));
    HTML.push(dopbspSettingsFormInput('notifications_email', data['notifications_email'], DOPBSP_NOTIFICATIONS_EMAIL, '', '', '', 'help', DOPBSP_NOTIFICATIONS_EMAIL_INFO));  
    HTML.push(dopbspSettingsFormSelect('smtp_enabled', data['smtp_enabled'], DOPBSP_NOTIFICATIONS_SMTP_ENABLED, '', '', '', 'help', DOPBSP_NOTIFICATIONS_SMTP_ENABLED_INFO, 'true;;false', DOPBSP_ENABLED+';;'+DOPBSP_DISABLED));     
    HTML.push(dopbspSettingsFormInput('smtp_host_name', data['smtp_host_name'], DOPBSP_NOTIFICATIONS_SMTP_HOST_NAME, '', '', '', 'help', DOPBSP_NOTIFICATIONS_SMTP_HOST_NAME_INFO));  
    HTML.push(dopbspSettingsFormInput('smtp_host_port', data['smtp_host_port'], DOPBSP_NOTIFICATIONS_SMTP_HOST_PORT, '', '', '', 'help', DOPBSP_NOTIFICATIONS_SMTP_HOST_PORT_INFO));  
    HTML.push(dopbspSettingsFormSelect('smtp_ssl', data['smtp_ssl'], DOPBSP_NOTIFICATIONS_SMTP_SSL, '', '', '', 'help', DOPBSP_NOTIFICATIONS_SMTP_SSL_INFO, 'true;;false', DOPBSP_ENABLED+';;'+DOPBSP_DISABLED));                           
    HTML.push(dopbspSettingsFormInput('smtp_user', data['smtp_user'], DOPBSP_NOTIFICATIONS_SMTP_USER, '', '', '', 'help', DOPBSP_NOTIFICATIONS_SMTP_USER_INFO));  
    HTML.push(dopbspSettingsFormInput('smtp_password', data['smtp_password'], DOPBSP_NOTIFICATIONS_SMTP_PASSWORD, '', '', '', 'help', DOPBSP_NOTIFICATIONS_SMTP_PASSWORD_INFO));  
    
// Days/Hours Settings
    HTML.push('    <a href="javascript:dopbspMoveTop()" class="go-top">'+DOPBSP_GO_TOP+'</a><h3 class="settings">'+DOPBSP_HOURS_STYLES_SETTINGS+'</h3>'); 
    HTML.push(dopbspSettingsFormSelect('multiple_days_select', data['multiple_days_select'], DOPBSP_MULTIPLE_DAYS_SELECT, '', '', '', 'help', DOPBSP_MULTIPLE_DAYS_SELECT_INFO, 'true;;false', DOPBSP_ENABLED+';;'+DOPBSP_DISABLED));  
    HTML.push(dopbspSettingsFormSelect('morning_check_out', data['morning_check_out'], DOPBSP_MORNING_CHECK_OUT, '', '', '', 'help', DOPBSP_MORNING_CHECK_OUT_INFO, 'true;;false', DOPBSP_ENABLED+';;'+DOPBSP_DISABLED)); 
    HTML.push(dopbspSettingsFormSelect('hours_enabled', data['hours_enabled'], DOPBSP_HOURS_ENABLED, '', '', '', 'help', DOPBSP_HOURS_ENABLED_INFO, 'true;;false', DOPBSP_ENABLED+';;'+DOPBSP_DISABLED));  
    HTML.push(dopbspSettingsFormHoursDefinitions('hours_definitions', data['hours_definitions'], DOPBSP_HOURS_DEFINITIONS, '', '', '', 'help', DOPBSP_HOURS_DEFINITIONS_INFO));
    HTML.push(dopbspSettingsFormSelect('multiple_hours_select', data['multiple_hours_select'], DOPBSP_MULTIPLE_HOURS_SELECT, '', '', '', 'help', DOPBSP_MULTIPLE_HOURS_SELECT_INFO, 'true;;false', DOPBSP_ENABLED+';;'+DOPBSP_DISABLED));
    HTML.push(dopbspSettingsFormSelect('hours_ampm', data['hours_ampm'], DOPBSP_HOURS_AMPM, '', '', '', 'help', DOPBSP_HOURS_AMPM_INFO, 'true;;false', DOPBSP_ENABLED+';;'+DOPBSP_DISABLED));

// Discounts by Number of Days
    HTML.push('    <a href="javascript:dopbspMoveTop()" class="go-top">'+DOPBSP_GO_TOP+'</a><h3 class="settings">'+DOPBSP_DISCOUNTS_NO_DAYS_SETTINGS+'</h3>');
    
    for (i=2; i<=31; i++){
        discountsNoDaysValues.push(discountsNoDays[i-2]);
        discountsNoDaysLabels.push(i+' '+DOPBSP_DISCOUNTS_NO_DAYS_DAYS+' ('+(discountsNoDays[i-2] != 0 ? '-':'')+discountsNoDays[i-2]+'%)');
    }
    
    HTML.push(dopbspSettingsFormSelect('discounts_no_days', '-1', DOPBSP_DISCOUNTS_NO_DAYS, '', '', '', 'help', DOPBSP_DISCOUNTS_NO_DAYS_INFO, discountsNoDaysValues.join(';;'), discountsNoDaysLabels.join(';;')));
    HTML.push(dopbspSettingsFormInput('discount_no_days', discountsNoDays[0], '2 '+DOPBSP_DISCOUNTS_NO_DAYS_DAYS, '-', '%', 'small', 'help-small', DOPBSP_DISCOUNTS_NO_DAYS_DAYS_INFO));

// Deposit
    HTML.push('    <a href="javascript:dopbspMoveTop()" class="go-top">'+DOPBSP_GO_TOP+'</a><h3 class="settings">'+DOPBSP_DEPOSIT_SETTINGS+'</h3>');
    HTML.push(dopbspSettingsFormInput('deposit', data['deposit'], DOPBSP_DEPOSIT, '', '%', 'small', 'help-small', DOPBSP_DEPOSIT_INFO));

// Contact Form Settings
    HTML.push('    <a href="javascript:dopbspMoveTop()" class="go-top">'+DOPBSP_GO_TOP+'</a><h3 class="settings">'+DOPBSP_FORM_STYLES_SETTINGS+'</h3>');  
    HTML.push(dopbspSettingsFormSelect('name_enabled', data['name_enabled'], DOPBSP_NAME_ENABLED, '', '', '', 'help', DOPBSP_NAME_ENABLED_INFO, 'true;;false', DOPBSP_ENABLED+';;'+DOPBSP_DISABLED));
    HTML.push(dopbspSettingsFormSelect('email_enabled', data['email_enabled'], DOPBSP_EMAIL_ENABLED, '', '', '', 'help', DOPBSP_EMAIL_ENABLED_INFO, 'true;;false', DOPBSP_ENABLED+';;'+DOPBSP_DISABLED));
    HTML.push(dopbspSettingsFormSelect('phone_enabled', data['phone_enabled'], DOPBSP_PHONE_ENABLED, '', '', '', 'help', DOPBSP_PHONE_ENABLED_INFO, 'true;;false', DOPBSP_ENABLED+';;'+DOPBSP_DISABLED)); 
    HTML.push(dopbspSettingsFormSelect('no_people_enabled', data['no_people_enabled'], DOPBSP_NO_PEOPLE_ENABLED, '', '', '', 'help', DOPBSP_NO_PEOPLE_ENABLED_INFO, 'true;;false', DOPBSP_ENABLED+';;'+DOPBSP_DISABLED));   
    HTML.push(dopbspSettingsFormInput('min_no_people', data['min_no_people'], DOPBSP_MIN_NO_PEOPLE, '', '', 'small', 'help-small', DOPBSP_MIN_NO_PEOPLE_INFO));
    HTML.push(dopbspSettingsFormInput('max_no_people', data['max_no_people'], DOPBSP_MAX_NO_PEOPLE, '', '', 'small', 'help-small', DOPBSP_MAX_NO_PEOPLE_INFO));
    HTML.push(dopbspSettingsFormSelect('no_children_enabled', data['no_children_enabled'], DOPBSP_NO_CHILDREN_ENABLED, '', '', '', 'help', DOPBSP_NO_CHILDREN_ENABLED_INFO, 'true;;false', DOPBSP_ENABLED+';;'+DOPBSP_DISABLED));   
    HTML.push(dopbspSettingsFormInput('min_no_children', data['min_no_children'], DOPBSP_MIN_NO_CHILDREN, '', '', 'small', 'help-small', DOPBSP_MIN_NO_CHILDREN_INFO));
    HTML.push(dopbspSettingsFormInput('max_no_children', data['max_no_children'], DOPBSP_MAX_NO_CHILDREN, '', '', 'small', 'help-small', DOPBSP_MAX_NO_CHILDREN_INFO));
    HTML.push(dopbspSettingsFormSelect('message_enabled', data['message_enabled'], DOPBSP_MESSAGE_ENABLED, '', '', '', 'help', DOPBSP_MESSAGE_ENABLED_INFO, 'true;;false', DOPBSP_ENABLED+';;'+DOPBSP_DISABLED));
    HTML.push(dopbspSettingsFormSelect('payment_arrival_enabled', data['payment_arrival_enabled'], DOPBSP_PAYMENT_ARRIVAL_ENABLED, '', '', '', 'help', DOPBSP_PAYMENT_ARRIVAL_ENABLED_INFO, 'true;;false', DOPBSP_ENABLED+';;'+DOPBSP_DISABLED));
    HTML.push(dopbspSettingsFormSelect('terms_and_conditions_enabled', data['terms_and_conditions_enabled'], DOPBSP_TERMS_AND_CONDITIONS_ENABLED, '', '', '', 'help', DOPBSP_TERMS_AND_CONDITIONS_ENABLED_INFO, 'true;;false', DOPBSP_ENABLED+';;'+DOPBSP_DISABLED));
    HTML.push(dopbspSettingsFormInput('terms_and_conditions_link', data['terms_and_conditions_link'], DOPBSP_TERMS_AND_CONDITIONS_LINK, '', '', '', 'help', DOPBSP_TERMS_AND_CONDITIONS_LINK_INFO));

// PayPal Settings
    HTML.push('    <a href="javascript:dopbspMoveTop()" class="go-top">'+DOPBSP_GO_TOP+'</a><h3 class="settings">'+DOPBSP_PAYMENT_PAYPAL_STYLES_SETTINGS+'</h3>');  
    HTML.push(dopbspSettingsFormSelect('payment_paypal_enabled', data['payment_paypal_enabled'], DOPBSP_PAYMENT_PAYPAL_ENABLED, '', '', '', 'help', DOPBSP_PAYMENT_PAYPAL_ENABLED_INFO, 'true;;false', DOPBSP_ENABLED+';;'+DOPBSP_DISABLED));
    HTML.push(dopbspSettingsFormInput('payment_paypal_username', data['payment_paypal_username'], DOPBSP_PAYMENT_PAYPAL_USERNAME, '', '', '', 'help', DOPBSP_PAYMENT_PAYPAL_USERNAME_INFO));
    HTML.push(dopbspSettingsFormInput('payment_paypal_password', data['payment_paypal_password'], DOPBSP_PAYMENT_PAYPAL_PASSWORD, '', '', '', 'help', DOPBSP_PAYMENT_PAYPAL_PASSWORD_INFO));
    HTML.push(dopbspSettingsFormInput('payment_paypal_signature', data['payment_paypal_signature'], DOPBSP_PAYMENT_PAYPAL_SIGNATURE, '', '', '', 'help', DOPBSP_PAYMENT_PAYPAL_SIGNATURE_INFO));
    HTML.push(dopbspSettingsFormSelect('payment_paypal_sandbox_enabled', data['payment_paypal_sandbox_enabled'], DOPBSP_PAYMENT_PAYPAL_SANDBOX_ENABLED, '', '', '', 'help', DOPBSP_PAYMENT_PAYPAL_SANDBOX_ENABLED_INFO, 'true;;false', DOPBSP_ENABLED+';;'+DOPBSP_DISABLED));

    HTML.push('</form>');
    $jDOPBSP('.column-content', '.column'+column, '.DOPBSP-admin').html(HTML.join(''));
    
    $jDOPBSP('#discounts_no_days').unbind('change');
    $jDOPBSP('#discounts_no_days').bind('change', function(){
        $jDOPBSP('#discount_no_days').val($jDOPBSP('#discounts_no_days').val());
        $jDOPBSP('label', $jDOPBSP('#discount_no_days').parent()).html(($jDOPBSP(this).prop('selectedIndex')+2)+' '+DOPBSP_DISCOUNTS_NO_DAYS_DAYS);
    });
    
    $jDOPBSP('#discount_no_days').unbind('keyup');
    $jDOPBSP('#discount_no_days').bind('keyup', function(){
        dopbspCleanInput(this, '0123456789.', '0', '');
        $jDOPBSP('#discounts_no_days').find(":selected").val($jDOPBSP(this).val());
        $jDOPBSP('#discounts_no_days').find(":selected").text(($jDOPBSP('#discounts_no_days').prop('selectedIndex')+2)+' '+DOPBSP_DISCOUNTS_NO_DAYS_DAYS+' ('+($jDOPBSP(this).val() != '0' ? '-':'')+$jDOPBSP(this).val()+'%)');
    });
    
    $jDOPBSP('#deposit').unbind('keyup');
    $jDOPBSP('#deposit').bind('keyup', function(){
        dopbspCleanInput(this, '0123456789.', '0', '');
    });
}

function dopbspSettingsFormInput(id, value, label, pre, suf, input_class, help_class, help){// Create an Input Field.
    var inputHTML = new Array();

    inputHTML.push('    <div class="setting-box">');
    inputHTML.push('        <label for="'+id+'">'+label+'</label>');
    inputHTML.push('        <span class="pre">'+pre+'</span><input type="text" class="'+input_class+'" name="'+id+'" id="'+id+'" value="'+value+'" /><span class="suf">'+suf+'</span>');
    inputHTML.push('        <a href="javascript:void()" class="'+help_class+'" title="'+help+'"></a>');
    inputHTML.push('        <br class="DOPBSP-clear" />');
    inputHTML.push('    </div>');

    return inputHTML.join('');
}

function dopbspSettingsFormAvailableDays(id, value, label, pre, suf, textarea_class, help_class, help){// Create an Input Field.
    var inputHTML = new Array(),
    content = value.split(',');
    
    inputHTML.push('    <div class="setting-box">');
    inputHTML.push('        <label>'+label+'</label>');
    inputHTML.push('        <span class="pre">'+pre+'</span>');
    inputHTML.push('        <span class="days">');
    inputHTML.push('            <input type="checkbox" name="'+id+'0" id="'+id+'0"'+(content[0] == 'true' ? ' checked="checked"':'')+' /><label for="'+id+'0">'+DOPBSP_day_names[0]+'</label><br class="DOPBSP-clear" />');
    inputHTML.push('            <input type="checkbox" name="'+id+'1" id="'+id+'1"'+(content[1] == 'true' ? ' checked="checked"':'')+' /><label for="'+id+'1">'+DOPBSP_day_names[1]+'</label><br class="DOPBSP-clear" />');
    inputHTML.push('            <input type="checkbox" name="'+id+'2" id="'+id+'2"'+(content[2] == 'true' ? ' checked="checked"':'')+' /><label for="'+id+'2">'+DOPBSP_day_names[2]+'</label><br class="DOPBSP-clear" />');
    inputHTML.push('            <input type="checkbox" name="'+id+'3" id="'+id+'3"'+(content[3] == 'true' ? ' checked="checked"':'')+' /><label for="'+id+'3">'+DOPBSP_day_names[3]+'</label><br class="DOPBSP-clear" />');
    inputHTML.push('            <input type="checkbox" name="'+id+'4" id="'+id+'4"'+(content[4] == 'true' ? ' checked="checked"':'')+' /><label for="'+id+'4">'+DOPBSP_day_names[4]+'</label><br class="DOPBSP-clear" />');
    inputHTML.push('            <input type="checkbox" name="'+id+'5" id="'+id+'5"'+(content[5] == 'true' ? ' checked="checked"':'')+' /><label for="'+id+'5">'+DOPBSP_day_names[5]+'</label><br class="DOPBSP-clear" />');
    inputHTML.push('            <input type="checkbox" name="'+id+'6" id="'+id+'6"'+(content[6] == 'true' ? ' checked="checked"':'')+' /><label for="'+id+'6">'+DOPBSP_day_names[6]+'</label><br class="DOPBSP-clear" />');    
    inputHTML.push('        </span>');        
    inputHTML.push('        <span class="suf">'+suf+'</span>');
    inputHTML.push('        <a href="javascript:void()" class="'+help_class+'" title="'+help+'"></a>');
    inputHTML.push('        <br class="DOPBSP-clear" />');
    inputHTML.push('    </div>');

    return inputHTML.join('');
}

function dopbspSettingsFormHoursDefinitions(id, value, label, pre, suf, textarea_class, help_class, help){// Create an Input Field.
    var inputHTML = new Array(),
    content = new Array(), i;
    
    for (i=0; i<value.length; i++){
        content.push(value[i]['value']);
    }

    inputHTML.push('    <div class="setting-box">');
    inputHTML.push('        <label for="'+id+'">'+label+'</label>');
    inputHTML.push('        <span class="pre">'+pre+'</span><textarea type="text" class="'+textarea_class+'" name="'+id+'" id="'+id+'" cols="" rows="8">'+content.join('\n')+'</textarea><span class="suf">'+suf+'</span>');
    inputHTML.push('        <a href="javascript:void()" class="'+help_class+'" title="'+help+'"></a>');
    inputHTML.push('        <br class="DOPBSP-clear" />');
    inputHTML.push('    </div>');

    return inputHTML.join('');
}

function dopbspSettingsFormSelect(id, value, label, pre, suf, input_class, help_class, help, values, valueLabels){// Create a Combo Box.
    var selectHTML = new Array(), i,
    valuesList = values.split(';;'),
    valueLabelsList = valueLabels.split(';;');

    selectHTML.push('    <div class="setting-box">');
    selectHTML.push('        <label for="'+id+'">'+label+'</label>');
    selectHTML.push('        <span class="pre">'+pre+'</span>');
    selectHTML.push('            <select name="'+id+'" id="'+id+'">');
    
    for (i=0; i<valuesList.length; i++){
        if (valuesList[i] == value){
            selectHTML.push('        <option value="'+valuesList[i]+'" selected="selected">'+valueLabelsList[i]+'</option>');
        }
        else{
            selectHTML.push('        <option value="'+valuesList[i]+'">'+valueLabelsList[i]+'</option>');
        }
    }
    selectHTML.push('            </select>');
    selectHTML.push('        <span class="suf">'+suf+'</span>');
    selectHTML.push('        <a href="javascript:void()" class="'+help_class+'" title="'+help+'"></a>');
    selectHTML.push('        <br class="DOPBSP-clear" />');
    selectHTML.push('    </div>');

    return selectHTML.join('');
}

// ***************************************************************************** Administrator Settings

function dopbspEditUserPermissions(id, field, value){
    if (clearClick){
        dopbspToggleMessage('show', DOPBSP_SAVE);
        
        $jDOPBSP.post(ajaxurl, {action:'dopbsp_edit_user_permissions',
                                id: id,
                                field: field,
                                value: value}, function(data){
            dopbspToggleMessage('hide', DOPBSP_SAVE_SUCCESS);
        });
    }
}

//****************************************************************************** Help

function dopbspInitHelp(){
    var answers = new Array();
    
    $jDOPBSP('.DOPBSP-question').each(function(){        
        var no = $jDOPBSP(this).attr('id').split('_')[1],
        id = '#DOPBSP-answer_'+no;
        
        answers[no] = $jDOPBSP(id).html();
        $jDOPBSP(id).html('');
    });
    
    $jDOPBSP('.DOPBSP-question').click(function(){
        var no = $jDOPBSP(this).attr('id').split('_')[1],
        id = '#DOPBSP-answer_'+no;

        if ($jDOPBSP(id).css('display') == 'none'){
            $jDOPBSP('.DOPBSP-answer').css('display', 'none');
            $jDOPBSP('.DOPBSP-answer').html('');
            $jDOPBSP(id).html(answers[no]);
            $jDOPBSP(id).stop(true, true).slideDown(600);
        }
        else{
            $jDOPBSP(id).stop(true, true).slideUp(600);
        }
    });
}

//****************************************************************************** Prototypes

function dopbspSetCookie(c_name, value, expiredays){
    var exdate = new Date();
    
    exdate.setDate(exdate.getDate()+expiredays);
    document.cookie = c_name+"="+escape(value)+((expiredays==null) ? "" : ";expires="+exdate.toUTCString());
}

function dopbspMoveTop(){
    jQuery('html').stop(true, true).animate({'scrollTop':'0'}, 300);
    jQuery('body').stop(true, true).animate({'scrollTop':'0'}, 300);
}

function dopbspCleanInput(input, allowedCharacters, firstNotAllowed, min){
    var characters = $jDOPBSP(input).val().split(''),
    returnStr = '', i, startIndex = 0;

    if (characters.length > 1 && characters[0] == firstNotAllowed){
        startIndex = 1;
    }

    for (i=startIndex; i<characters.length; i++){
        if (allowedCharacters.indexOf(characters[i]) != -1){
            returnStr += characters[i];
        }
    }

    if (min > returnStr){
        returnStr = min;
    }

    $jDOPBSP(input).val(returnStr);
}