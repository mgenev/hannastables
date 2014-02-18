/*
* Title                   : Booking System PRO (WordPress Plugin)
* Version                 : 1.9
* File                    : dopbsp-backend-reservations.js
* File Version            : 1.1
* Created / Last Modified : 19 November 2013
* Author                  : Dot on Paper
* Copyright               : © 2012 Dot on Paper
* Website                 : http://www.dotonpaper.net
* Description             : Booking System PRO Reservations Scripts.
*/

//****************************************************************************** Reservations

function dopbspShowReservations(){
    if (clearReservationsClick){
        $jDOPBSP('.DOPBSP-admin .reservations-content').html('');
        $jDOPBSP('#DOPBSP-reservations-actions-filter').css('display', 'none');
        $jDOPBSP('#DOPBSP-reservations-view-filter').css('display', 'none');
        $jDOPBSP('#DOPBSP-reservations-period-filter').css('display', 'none');
        $jDOPBSP('#DOPBSP-reservations-status-filter').css('display', 'none');
        $jDOPBSP('#DOPBSP-reservations-payment-filter').css('display', 'none');
        $jDOPBSP('#DOPBSP-reservations-search-filter').css('display', 'none');
        $jDOPBSP('#DOPBSP-reservations-pagination-filter').css('display', 'none');
        $jDOPBSP('#DOPBSP-reservations-order-filter').css('display', 'none');

        if ($jDOPBSP('#calendar_id').val() != '0'){
            dopbspInitReservations();
        }
    }
}

function dopbspInitReservations(){// Init Reservations
    if (clearReservationsClick){
        $jDOPBSP('#DOPBookingSystemPROReservations_Info'+$jDOPBSP('#calendar_id').val()).remove();
        $jDOPBSP('.DOPBSP-admin .reservations-content').html('');
        $jDOPBSP('#DOPBSP-reservations-period-filter').css('display', 'none');
        $jDOPBSP('#DOPBSP-reservations-status-filter').css('display', 'none');
        $jDOPBSP('#DOPBSP-reservations-payment-filter').css('display', 'none');
        $jDOPBSP('#DOPBSP-reservations-search-filter').css('display', 'none');
        $jDOPBSP('#DOPBSP-reservations-pagination-filter').css('display', 'none');
        $jDOPBSP('#DOPBSP-reservations-order-filter').css('display', 'none');

        dopbspToggleReservationsMessage('show', DOPBSP_LOAD);

        $jDOPBSP.post(ajaxurl, {action: 'dopbsp_init_reservations',
                                calendar_id: $jDOPBSP('#calendar_id').val(),
                                view: $jDOPBSP('#DOPBSP-reservations-view').val()}, function(data){
            data = $jDOPBSP.parseJSON($jDOPBSP.trim(data));

            var hoursEnabled = data['HoursEnabled'] == 'true' ? true:false,
            hoursAMPM = data['HoursAMPM'] == 'true' ? true:false,
            paymentMethodArrivalEnabled = data['PaymentMethodArrivalEnabled'] == 'true' ? true:false,
            paymentMethodPayPalEnabled = data['PaymentMethodPayPalEnabled'] == 'true' ? true:false,
            hours = new Array('00:00', '01:00', '02:00', '03:00', '04:00', '05:00', '06:00', '07:00', '08:00', '09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00', '19:00', '20:00', '21:00', '22:00', '23:00', '24:00'),
            hoursHTML = new Array(), i;

    // Actions
            $jDOPBSP('#DOPBSP-reservations-actions-filter').css('display', 'block');
            $jDOPBSP('#DOPBSP-add-reservation').removeAttr('style');
            $jDOPBSP('#DOPBSP-reset-reservations-filter').removeAttr('style');
            $jDOPBSP('#DOPBSP-submit-reservation').css('display', 'none');
            $jDOPBSP('#DOPBSP-back-reservation').css('display', 'none');

    // View
            $jDOPBSP('#DOPBSP-reservations-view-filter').css('display', 'block');

    // Period
            if (hoursEnabled){
                for (i=0; i<hours.length; i++){
                    hoursHTML.push('<option value="'+hours[i]+'">'+(hoursAMPM ? dopbspTimeToAMPM(hours[i]):hours[i])+'</option>');
                }
            }

            $jDOPBSP('#DOPBSP-reservations-start-hour').html(hoursHTML.join(''));
            $jDOPBSP('#DOPBSP-reservations-end-hour').html(hoursHTML.join(''));
            $jDOPBSP('#DOPBSP-reservations-start-hour [value="00:00"]').attr('selected', 'selected');
            $jDOPBSP('#DOPBSP-reservations-end-hour [value="24:00"]').attr('selected', 'selected');

            hoursEnabled ? $jDOPBSP('#DOPBSP-reservations-start-hour-label').removeAttr('style'):$jDOPBSP('#DOPBSP-reservations-start-hour-label').css('display', 'none');
            hoursEnabled ? $jDOPBSP('#DOPBSP-reservations-start-hour').removeAttr('style'):$jDOPBSP('#DOPBSP-reservations-start-hour').css('display', 'none');
            hoursEnabled ? $jDOPBSP('#DOPBSP-reservations-end-hour-label').removeAttr('style'):$jDOPBSP('#DOPBSP-reservations-end-hour-label').css('display', 'none');
            hoursEnabled ? $jDOPBSP('#DOPBSP-reservations-end-hour').removeAttr('style'):$jDOPBSP('#DOPBSP-reservations-end-hour').css('display', 'none');

    // Status
            $jDOPBSP('#DOPBSP-reservations-pending').removeAttr('checked');
            $jDOPBSP('#DOPBSP-reservations-approved').removeAttr('checked');
            $jDOPBSP('#DOPBSP-reservations-rejected').removeAttr('checked');
            $jDOPBSP('#DOPBSP-reservations-canceled').removeAttr('checked');
            $jDOPBSP('#DOPBSP-reservations-expired').removeAttr('checked');

    // Payment
            $jDOPBSP('#DOPBSP-reservations-payment-none').removeAttr('checked');
            $jDOPBSP('#DOPBSP-reservations-payment-arrival').removeAttr('checked');
            $jDOPBSP('#DOPBSP-reservations-payment-paypal').removeAttr('checked');

            paymentMethodArrivalEnabled || paymentMethodPayPalEnabled ? $jDOPBSP('#DOPBSP-reservations-payment-none').css('display', 'none'):$jDOPBSP('#DOPBSP-reservations-payment-none').removeAttr('style');
            paymentMethodArrivalEnabled || paymentMethodPayPalEnabled ? $jDOPBSP('#DOPBSP-reservations-payment-none-label').css('display', 'none'):$jDOPBSP('#DOPBSP-reservations-payment-none-label').removeAttr('style');
            paymentMethodArrivalEnabled ? $jDOPBSP('#DOPBSP-reservations-payment-arrival').removeAttr('style'):$jDOPBSP('#DOPBSP-reservations-payment-arrival').css('display', 'none');
            paymentMethodArrivalEnabled ? $jDOPBSP('#DOPBSP-reservations-payment-arrival-label').removeAttr('style'):$jDOPBSP('#DOPBSP-reservations-payment-arrival-label').css('display', 'none');
            paymentMethodPayPalEnabled ? $jDOPBSP('#DOPBSP-reservations-payment-paypal').removeAttr('style'):$jDOPBSP('#DOPBSP-reservations-payment-paypal').css('display', 'none');
            paymentMethodPayPalEnabled ? $jDOPBSP('#DOPBSP-reservations-payment-paypal-label').removeAttr('style'):$jDOPBSP('#DOPBSP-reservations-payment-paypal-label').css('display', 'none');

    // Page
            $jDOPBSP('#DOPBSP-reservations-pagination-no-page [value="25"]').attr('selected', 'selected');

    // Order
            $jDOPBSP('#DOPBSP-reservations-order [value="ASC"]').attr('selected', 'selected');

            clearClick = true;

            if ($jDOPBSP('#DOPBSP-reservations-view').val() == 'calendar'){
                // Period
                $jDOPBSP('#DOPBSP-reservations-period-filter').css('display', hoursEnabled ? 'block':'none');
                $jDOPBSP('#DOPBSP-reservations-start-day-label').css('display', 'none');
                $jDOPBSP('#DOPBSP-reservations-start-day').css('display', 'none');
                $jDOPBSP('#DOPBSP-reservations-end-day-label').css('display', 'none');
                $jDOPBSP('#DOPBSP-reservations-end-day').css('display', 'none');

                // Status
                $jDOPBSP('#DOPBSP-reservations-status-filter').css('display', 'block');
                $jDOPBSP('#DOPBSP-reservations-expired-label').css('display', 'none');
                $jDOPBSP('#DOPBSP-reservations-expired').css('display', 'none');

                // Payment
                $jDOPBSP('#DOPBSP-reservations-payment-filter').css('display', 'block');

                $jDOPBSP('.DOPBSP-admin .reservations-content').html('<div id="DOPBSP-Calendar-reservations"></div>');
                $jDOPBSP('#DOPBSP-Calendar-reservations').DOPBookingSystemPROReservations(data);
            }
            else{
                // Period
                $jDOPBSP('#DOPBSP-reservations-period-filter').css('display', 'block');
                $jDOPBSP('#DOPBSP-reservations-start-day-label').removeAttr('style');
                $jDOPBSP('#DOPBSP-reservations-start-day').removeAttr('style');
                $jDOPBSP('#DOPBSP-reservations-end-day-label').removeAttr('style');
                $jDOPBSP('#DOPBSP-reservations-end-day').removeAttr('style');

                // Status
                $jDOPBSP('#DOPBSP-reservations-status-filter').css('display', 'block');
                $jDOPBSP('#DOPBSP-reservations-expired-label').removeAttr('style');
                $jDOPBSP('#DOPBSP-reservations-expired').removeAttr('style');

                // Payment
                $jDOPBSP('#DOPBSP-reservations-payment-filter').css('display', 'block');

                // Search
                $jDOPBSP('#DOPBSP-reservations-search-filter').css('display', 'block');

                // Pagination
                $jDOPBSP('#DOPBSP-reservations-pagination-filter').css('display', 'block');

                // Order
                $jDOPBSP('#DOPBSP-reservations-order-filter').css('display', 'block');

                dopbspInitListReservations(data);
            }
        });
    }
}

function dopbspResetReservationsFilters(){
    // Period    
    $jDOPBSP('#DOPBSP-reservations-start-day').val('');
    $jDOPBSP('#DOPBSP-reservations-end-day').val('');
    $jDOPBSP('#DOPBSP-reservations-start-hour [value="00:00"]').attr('selected', 'selected');
    $jDOPBSP('#DOPBSP-reservations-end-hour [value="24:00"]').attr('selected', 'selected');
    
    // Status
    $jDOPBSP('#DOPBSP-reservations-pending').removeAttr('checked');
    $jDOPBSP('#DOPBSP-reservations-approved').removeAttr('checked');
    $jDOPBSP('#DOPBSP-reservations-rejected').removeAttr('checked');
    $jDOPBSP('#DOPBSP-reservations-canceled').removeAttr('checked');
    $jDOPBSP('#DOPBSP-reservations-expired').removeAttr('checked');

    // Payment
    $jDOPBSP('#DOPBSP-reservations-payment-none').removeAttr('checked');
    $jDOPBSP('#DOPBSP-reservations-payment-arrival').removeAttr('checked');
    $jDOPBSP('#DOPBSP-reservations-payment-paypal').removeAttr('checked');
    
    // Search
    $jDOPBSP('#DOPBSP-reservations-search').val('');
    
    // Page
    $jDOPBSP('#DOPBSP-reservations-pagination-no-page [value="25"]').attr('selected', 'selected');

    // Order
    $jDOPBSP('#DOPBSP-reservations-order [value="ASC"]').attr('selected', 'selected');
    
    dopbspInitReservations();
}

function dopbspInitListReservations(data){// Init reservations list filters.
// Actions
    $jDOPBSP('#DOPBSP-reset-reservations-filter').unbind('click');
    $jDOPBSP('#DOPBSP-reset-reservations-filter').bind('click', function(){
        dopbspResetReservationsFilters();
    });
    
// Days    
    $jDOPBSP('#DOPBSP-reservations-start-day').datepicker('destroy');                      
    $jDOPBSP('#DOPBSP-reservations-start-day').datepicker({minDate: 0,
                                                           dateFormat: parseInt(data['DateType'], 10) == 1 ? 'MM dd, yy':'dd MM yy',
                                                           altField: '#DOPBSP-reservations-start-day-alt',
                                                           altFormat: 'yy-mm-dd',
                                                           firstDay: data['FirstDay'],
                                                           dayNames: data['DayNames'],
                                                           dayNamesMin: data['DayShortNames'],
                                                           monthNames: data['MonthNames'],
                                                           monthNamesMin: data['MonthShortNames']});
     $jDOPBSP('#DOPBSP-reservations-end-day').datepicker('destroy');  
     $jDOPBSP('#DOPBSP-reservations-end-day').datepicker({minDate: 0,
                                                          dateFormat: parseInt(data['DateType'], 10) == 1 ? 'MM dd, yy':'dd MM yy',
                                                          altField: '#DOPBSP-reservations-end-day-alt',
                                                          altFormat: 'yy-mm-dd',
                                                          firstDay: data['FirstDay'],
                                                          dayNames: data['DayNames'],
                                                          dayNamesMin: data['DayShortNames'],
                                                          monthNames: data['MonthNames'],
                                                          monthNamesMin: data['MonthShortNames']});
    $jDOPBSP('.ui-datepicker').removeClass('notranslate').addClass('notranslate');
                            
    $jDOPBSP('#DOPBSP-reservations-start-day').unbind('change');
    $jDOPBSP('#DOPBSP-reservations-start-day').bind('change', function(){
        var year = parseInt($jDOPBSP('#DOPBSP-reservations-start-day-alt').val().split('-')[0], 10),
        month = parseInt($jDOPBSP('#DOPBSP-reservations-start-day-alt').val().split('-')[1], 10)-1,
        day = parseInt($jDOPBSP('#DOPBSP-reservations-start-day-alt').val().split('-')[2], 10),
        minDateValue = dopbspDateDiference(new Date(), new Date(year, month, day));
        
        $jDOPBSP('#DOPBSP-reservations-end-day').datepicker('destroy');  
        $jDOPBSP('#DOPBSP-reservations-end-day').datepicker({minDate: minDateValue,
                                                             dateFormat: parseInt(data['DateType'], 10) == 1 ? 'MM dd, yy':'dd MM yy',
                                                             altField: '#DOPBSP-reservations-end-day-alt',
                                                             altFormat: 'yy-mm-dd',
                                                             firstDay: data['FirstDay'],
                                                             dayNames: data['DayNames'],
                                                             dayNamesMin: data['DayShortNames'],
                                                             monthNames: data['MonthNames'],
                                                             monthNamesMin: data['MonthShortNames']});
        $jDOPBSP('.ui-datepicker').removeClass('notranslate').addClass('notranslate');
        dopbspGetListReservations();
    });

    $jDOPBSP('#DOPBSP-reservations-end-day').unbind('change');
    $jDOPBSP('#DOPBSP-reservations-end-day').bind('change', function(){
        dopbspGetListReservations();
    });
    
// Hours
    if (data['HoursEnabled'] == 'true'){
        $jDOPBSP('#DOPBSP-reservations-start-hour').unbind('change');
        $jDOPBSP('#DOPBSP-reservations-start-hour').bind('change', function(){
            $jDOPBSP('#DOPBSP-reservations-end-hour').html('');

            $jDOPBSP('#DOPBSP-reservations-start-hour option').each(function(){
                if ($jDOPBSP(this).attr('value') >= $jDOPBSP('#DOPBSP-reservations-start-hour').val()){
                    $jDOPBSP('#DOPBSP-reservations-end-hour').append('<option value="'+$jDOPBSP(this).attr('value')+'">'+$jDOPBSP(this).html()+'</option>');
                }
            });
            $jDOPBSP('#DOPBSP-reservations-end-hour [value="24:00"]').attr('selected', 'selected');

            dopbspGetListReservations();
        });

        $jDOPBSP('#DOPBSP-reservations-end-hour').unbind('change');
        $jDOPBSP('#DOPBSP-reservations-end-hour').bind('change', function(){
            dopbspGetListReservations();
        });
    }

// Status
    $jDOPBSP('#DOPBSP-reservations-pending').unbind('click');
    $jDOPBSP('#DOPBSP-reservations-pending').bind('click', function(){
        dopbspGetListReservations();
    });

    $jDOPBSP('#DOPBSP-reservations-approved').unbind('click');
    $jDOPBSP('#DOPBSP-reservations-approved').bind('click', function(){
        dopbspGetListReservations();
    });

    $jDOPBSP('#DOPBSP-reservations-rejected').unbind('click');
    $jDOPBSP('#DOPBSP-reservations-rejected').bind('click', function(){
        dopbspGetListReservations();
    });

    $jDOPBSP('#DOPBSP-reservations-canceled').unbind('click');
    $jDOPBSP('#DOPBSP-reservations-canceled').bind('click', function(){
        dopbspGetListReservations();
    });

    $jDOPBSP('#DOPBSP-reservations-expired').unbind('click');
    $jDOPBSP('#DOPBSP-reservations-expired').bind('click', function(){
        dopbspGetListReservations();
    });
    
// Payment
    $jDOPBSP('#DOPBSP-reservations-payment-none').unbind('click');
    $jDOPBSP('#DOPBSP-reservations-payment-none').bind('click', function(){
        dopbspGetListReservations();
    });    

    $jDOPBSP('#DOPBSP-reservations-payment-arrival').unbind('click');
    $jDOPBSP('#DOPBSP-reservations-payment-arrival').bind('click', function(){
        dopbspGetListReservations();
    });
    
    $jDOPBSP('#DOPBSP-reservations-payment-paypal').unbind('click');
    $jDOPBSP('#DOPBSP-reservations-payment-paypal').bind('click', function(){
        dopbspGetListReservations();
    });    
    
// Search
    dopbspSetSearchReservations(data);
    
    $jDOPBSP('#DOPBSP-reservations-search').unbind('keyup');
    $jDOPBSP('#DOPBSP-reservations-search').bind('keyup', function(){
        dopbspGetListReservations(true);
    });

    $jDOPBSP('#DOPBSP-reservations-search-by').unbind('change');
    $jDOPBSP('#DOPBSP-reservations-search-by').bind('change', function(){
        $jDOPBSP('#DOPBSP-reservations-search').val('');
    });
    
// Pagination
    $jDOPBSP('#DOPBSP-reservations-no-pages').val(data['NoReservations']);
    dopbspSetNoPagesReservations();
            
    $jDOPBSP('#DOPBSP-reservations-pagination-page').unbind('change');
    $jDOPBSP('#DOPBSP-reservations-pagination-page').bind('change', function(){
        dopbspGetListReservations(false, false);
    });

    $jDOPBSP('#DOPBSP-reservations-pagination-no-page').unbind('change');
    $jDOPBSP('#DOPBSP-reservations-pagination-no-page').bind('change', function(){
        dopbspSetNoPagesReservations();
        dopbspGetListReservations(false, false);
    });
        
// Order
    dopbspSetOrderReservations(data);

    $jDOPBSP('#DOPBSP-reservations-order').unbind('change');
    $jDOPBSP('#DOPBSP-reservations-order').bind('change', function(){
        dopbspGetListReservations();
    });

    $jDOPBSP('#DOPBSP-reservations-order-by').unbind('change');
    $jDOPBSP('#DOPBSP-reservations-order-by').bind('change', function(){
        dopbspGetListReservations();
    });

    dopbspGetListReservations();
}

function dopbspSetSearchReservations(data){// Set reservations form fields.
    var i, searchHTML = new Array(),
    form = data['Form'];
    
    searchHTML.push('<option value="id">ID</option>');
    
    if (data['PaymentMethodPayPalEnabled'] == 'true'){
        searchHTML.push('<option value="paypal_id">'+DOPBSP_RESERVATIONS_FILTERS_PAYPAL_TRANSACTION_ID+'</option>');
    }
        
    for (i=0; i<form.length; i++){
        searchHTML.push('<option value="='+form[i]['name']+'">'+form[i]['translation']+'</option>');
    }
    $jDOPBSP('#DOPBSP-reservations-search-by').html(searchHTML.join(''));
}

function dopbspSetNoPagesReservations(){// Set reservations number of pages.
    var i, pagesHTML = new Array(),
    noPages = Math.ceil(parseInt($jDOPBSP('#DOPBSP-reservations-no-pages').val())/parseInt($jDOPBSP('#DOPBSP-reservations-pagination-no-page').val()));
    
    for (i=1; i<=noPages; i++){
        pagesHTML.push('<option value="'+i+'">'+i+'</option>');
    }
    
    if (noPages == 0){
        pagesHTML.push('<option value="1">1</option>');
        
    }
    $jDOPBSP('#DOPBSP-reservations-pagination-page').html(pagesHTML.join(''));
}

function dopbspSetOrderReservations(data){
    var orderHTML = new Array();
    
    orderHTML.push('<option value="check_in">'+DOPBSP_RESERVATIONS_CHECK_IN_LABEL+'</option>');
    
    if (data['MultipleDaysSelect'] == 'true' && data['HoursEnabled'] == 'false'){
        orderHTML.push('<option value="check_out">'+DOPBSP_RESERVATIONS_CHECK_OUT_LABEL+'</option>');
    }
    
    if (data['HoursEnabled'] == 'true'){
        orderHTML.push('<option value="start_hour">'+DOPBSP_RESERVATIONS_START_HOURS_LABEL+'</option>');
        
        if (data['MultipleHoursSelect'] == 'true'){
            orderHTML.push('<option value="end_hour">'+DOPBSP_RESERVATIONS_END_HOURS_LABEL+'</option>');
        }
    }
    orderHTML.push('<option value="id">ID</option>');
    orderHTML.push('<option value="status">'+DOPBSP_RESERVATIONS_STATUS_LABEL+'</option>');
    orderHTML.push('<option value="date_created">'+DOPBSP_RESERVATIONS_DATE_CREATED_LABEL+'</option>');
    orderHTML.push('<option value="no_items">'+DOPBSP_RESERVATIONS_NO_ITEMS_LABEL+'</option>');
    orderHTML.push('<option value="price">'+DOPBSP_RESERVATIONS_PRICE_LABEL+'</option>');
    
    $jDOPBSP('#DOPBSP-reservations-order-by').html(orderHTML.join(''));
}

function dopbspGetListReservations(stopAJAX, resetPages){// Show reservations list.
    dopbspToggleReservationsMessage('show', DOPBSP_LOAD);
    
    stopAJAX = stopAJAX == undefined ? false:stopAJAX;
    resetPages = resetPages == undefined ? true:resetPages;
    
    if (stopAJAX && ajaxRequestInProgress != undefined){
        ajaxRequestInProgress.abort();
    }
    
    ajaxRequestInProgress = $jDOPBSP.post(ajaxurl, {action: 'dopbsp_get_list_reservations',
                                                    calendar_id: $jDOPBSP('#calendar_id').val(),
                                                    without_calendar: $jDOPBSP('#DOPBSP-reservations-without-calendar').val() != undefined ? true:false,
                                                    start_day: $jDOPBSP('#DOPBSP-reservations-start-day-alt').val(),
                                                    end_day: $jDOPBSP('#DOPBSP-reservations-end-day-alt').val(),
                                                    start_hour: $jDOPBSP('#DOPBSP-reservations-start-hour').val(),
                                                    end_hour: $jDOPBSP('#DOPBSP-reservations-end-hour').val(),
                                                    status_pending: $jDOPBSP('#DOPBSP-reservations-pending').is(':checked') ? true:false,
                                                    status_approved: $jDOPBSP('#DOPBSP-reservations-approved').is(':checked') ? true:false,
                                                    status_rejected: $jDOPBSP('#DOPBSP-reservations-rejected').is(':checked') ? true:false,
                                                    status_canceled: $jDOPBSP('#DOPBSP-reservations-canceled').is(':checked') ? true:false,
                                                    status_expired: $jDOPBSP('#DOPBSP-reservations-expired').is(':checked') ? true:false,
                                                    payment_none: $jDOPBSP('#DOPBSP-reservations-payment-none').is(':checked') ? true:false,
                                                    payment_arrival: $jDOPBSP('#DOPBSP-reservations-payment-arrival').is(':checked') ? true:false,
                                                    payment_paypal: $jDOPBSP('#DOPBSP-reservations-payment-paypal').is(':checked') ? true:false,
                                                    search: $jDOPBSP('#DOPBSP-reservations-search').val(),
                                                    search_by: $jDOPBSP('#DOPBSP-reservations-search-by').val(),
                                                    page: $jDOPBSP('#DOPBSP-reservations-pagination-page').val(),
                                                    no_page: $jDOPBSP('#DOPBSP-reservations-pagination-no-page').val(),
                                                    order: $jDOPBSP('#DOPBSP-reservations-order').val(),
                                                    order_by: $jDOPBSP('#DOPBSP-reservations-order-by').val()}, function(data){
        data = $jDOPBSP.trim(data);
        
        if (resetPages){
            $jDOPBSP('#DOPBSP-reservations-no-pages').val(data.split(';;;;;;;;;;;')[0]);
            dopbspSetNoPagesReservations();
        }
        
        $jDOPBSP('.DOPBSP-admin .reservations-content').html(data.split(';;;;;;;;;;;')[1]);
        dopbspToggleReservationsMessage('hide', '');
        dopbspInitApproveReservation();
        dopbspInitRejectReservation(); 
        dopbspInitCancelReservation(); 
        dopbspInitDeleteReservation();
    });
}

function dopbspInitApproveReservation(){
    $jDOPBSP('.DOPBSP-reservations-approve-button').unbind('click');
    $jDOPBSP('.DOPBSP-reservations-approve-button').bind('click', function(){
        var id = $jDOPBSP(this).attr('id').split('DOPBSP-reservations-approve-button')[1],
        wasPending = $jDOPBSP('#DOPBSP_Reservation_ID'+id+' .flag').hasClass('pending') ? true:false,
        noReservations = 0;
        
        if (confirm(DOPBSP_RESERVATIONS_APPROVE_CONFIRMATION)){
            $jDOPBSP('#DOPBSP_Reservation_ID'+id+' .flag').removeClass('pending').removeClass('rejected').removeClass('canceled').removeClass('expired').addClass('approved');
            $jDOPBSP('#DOPBSP_Reservation_ID'+id+' .info-status').removeClass('pending').removeClass('rejected').removeClass('canceled').removeClass('expired').addClass('approved').html(DOPBSP_RESERVATIONS_STATUS_APPROVED);
            $jDOPBSP('#DOPBSP-reservations-approve-button'+id).css('display', 'none');
            $jDOPBSP('#DOPBSP-reservations-reject-button'+id).css('display', 'none');
            $jDOPBSP('#DOPBSP-reservations-cancel-button'+id).css('display', 'block');
            $jDOPBSP('#DOPBSP-reservations-delete-button'+id).css('display', 'none');
            
            dopbspToggleReservationsMessage('show', DOPBSP_SAVE);

            $jDOPBSP.post(ajaxurl, {action:'dopbsp_approve_reservation',
                                    calendar_id: $jDOPBSP('#calendar_id').val(), 
                                    reservation_id: id}, function(data){
                if (wasPending){
                    noReservations = $jDOPBSP('#DOPBSP-new-reservations span').html() == '' ? 0:parseInt($jDOPBSP('#DOPBSP-new-reservations span').html(), 10)-1;

                    if (noReservations == 0){                                            
                        $jDOPBSP('#DOPBSP-new-reservations').removeClass('new');
                        $jDOPBSP('#DOPBSP-new-reservations span').html('');
                    }
                    else{                                            
                        $jDOPBSP('#DOPBSP-new-reservations span').html(noReservations);
                    }
                }
                
                if ($jDOPBSP('#calendar_refresh').val() != undefined){
                    $jDOPBSP('#calendar_refresh').val('true');
                }
                dopbspToggleReservationsMessage('hide', DOPBSP_RESERVATIONS_APPROVE_SUCCESS);
            });   
        }
    });                             
}

function dopbspInitRejectReservation(){
    $jDOPBSP('.DOPBSP-reservations-reject-button').unbind('click');
    $jDOPBSP('.DOPBSP-reservations-reject-button').bind('click', function(){
        var id = $jDOPBSP(this).attr('id').split('DOPBSP-reservations-reject-button')[1],
        wasPending = $jDOPBSP('#DOPBSP_Reservation_ID'+id+' .flag').hasClass('pending') ? true:false,
        noReservations = 0;
                                    
        if (confirm(DOPBSP_RESERVATIONS_REJECT_CONFIRMATION)){
            $jDOPBSP('#DOPBSP_Reservation_ID'+id+' .flag').removeClass('pending').removeClass('rejected').removeClass('canceled').removeClass('expired').addClass('rejected');
            $jDOPBSP('#DOPBSP_Reservation_ID'+id+' .info-status').removeClass('pending').removeClass('rejected').removeClass('canceled').removeClass('expired').addClass('rejected').html(DOPBSP_RESERVATIONS_STATUS_REJECTED);
            $jDOPBSP('#DOPBSP-reservations-approve-button'+id).css('display', 'block');
            $jDOPBSP('#DOPBSP-reservations-reject-button'+id).css('display', 'none');
            $jDOPBSP('#DOPBSP-reservations-cancel-button'+id).css('display', 'none');
            $jDOPBSP('#DOPBSP-reservations-delete-button'+id).css('display', 'block');
            
            dopbspToggleReservationsMessage('show', DOPBSP_SAVE);

            $jDOPBSP.post(ajaxurl, {action:'dopbsp_reject_reservation',
                                    calendar_id: $jDOPBSP('#calendar_id').val(), 
                                    reservation_id: id}, function(data){
                if (wasPending){
                    noReservations = $jDOPBSP('#DOPBSP-new-reservations span').html() == '' ? 0:parseInt($jDOPBSP('#DOPBSP-new-reservations span').html(), 10)-1;

                    if (noReservations == 0){                                            
                        $jDOPBSP('#DOPBSP-new-reservations').removeClass('new');
                        $jDOPBSP('#DOPBSP-new-reservations span').html('');
                    }
                    else{                                            
                        $jDOPBSP('#DOPBSP-new-reservations span').html(noReservations);
                    }
                }
                dopbspToggleReservationsMessage('hide', DOPBSP_RESERVATIONS_REJECT_SUCCESS);
            });   
        }
    });
}

function dopbspInitCancelReservation(){
    $jDOPBSP('.DOPBSP-reservations-cancel-button').unbind('click');
    $jDOPBSP('.DOPBSP-reservations-cancel-button').bind('click', function(){
        var id = $jDOPBSP(this).attr('id').split('DOPBSP-reservations-cancel-button')[1];
        
        if (confirm(DOPBSP_RESERVATIONS_CANCEL_CONFIRMATION)){
            $jDOPBSP('#DOPBSP_Reservation_ID'+id+' .flag').removeClass('pending').removeClass('rejected').removeClass('canceled').removeClass('expired').addClass('canceled');
            $jDOPBSP('#DOPBSP_Reservation_ID'+id+' .info-status').removeClass('pending').removeClass('rejected').removeClass('canceled').removeClass('expired').addClass('canceled').html(DOPBSP_RESERVATIONS_STATUS_CANCELED);
            $jDOPBSP('#DOPBSP-reservations-approve-button'+id).css('display', 'block');
            $jDOPBSP('#DOPBSP-reservations-reject-button'+id).css('display', 'none');
            $jDOPBSP('#DOPBSP-reservations-cancel-button'+id).css('display', 'none');
            $jDOPBSP('#DOPBSP-reservations-delete-button'+id).css('display', 'block');
            
            dopbspToggleReservationsMessage('show', DOPBSP_SAVE);

            $jDOPBSP.post(ajaxurl, {action:'dopbsp_cancel_reservation',
                                    calendar_id: $jDOPBSP('#calendar_id').val(), 
                                    reservation_id: id}, function(data){
                if ($jDOPBSP('#calendar_refresh').val() != undefined){
                    $jDOPBSP('#calendar_refresh').val('true');
                }
                dopbspToggleReservationsMessage('hide', DOPBSP_RESERVATIONS_CANCEL_SUCCESS);
            });   
        }
    });
}

function dopbspInitDeleteReservation(){
    $jDOPBSP('.DOPBSP-reservations-delete-button').unbind('click');
    $jDOPBSP('.DOPBSP-reservations-delete-button').bind('click', function(){
        var id = $jDOPBSP(this).attr('id').split('DOPBSP-reservations-delete-button')[1];
        
        if (confirm(DOPBSP_RESERVATIONS_DELETE_CONFIRMATION)){
            dopbspToggleReservationsMessage('show', DOPBSP_SAVE);

            $jDOPBSP.post(ajaxurl, {action:'dopbsp_delete_reservation',
                                    reservation_id: id}, function(data){
                $jDOPBSP('#DOPBSP_Reservation_ID'+id).fadeOut(300, function(){
                    $jDOPBSP(this).remove();
                    dopbspToggleReservationsMessage('hide', DOPBSP_RESERVATIONS_DELETE_SUCCESS);
                });
            });   
        }
    });
}

function dopbspInitAddReservation(){ // Add Reservation
    if (clearReservationsClick){
        dopbspToggleReservationsMessage('show', DOPBSP_LOAD);
        $jDOPBSP('#DOPBookingSystemPROReservations_Info'+$jDOPBSP('#calendar_id').val()).remove();

        $jDOPBSP('.DOPBSP-admin .reservations-content').html('');
                        
        $jDOPBSP('#DOPBSP-reservations-view-filter').css('display', 'none');
        $jDOPBSP('#DOPBSP-reservations-period-filter').css('display', 'none');
        $jDOPBSP('#DOPBSP-reservations-status-filter').css('display', 'none');
        $jDOPBSP('#DOPBSP-reservations-payment-filter').css('display', 'none');
        $jDOPBSP('#DOPBSP-reservations-search-filter').css('display', 'none');
        $jDOPBSP('#DOPBSP-reservations-pagination-filter').css('display', 'none');
        $jDOPBSP('#DOPBSP-reservations-order-filter').css('display', 'none');


        $jDOPBSP.post(ajaxurl, {action: 'dopbsp_init_add_reservation',
                                calendar_id: $jDOPBSP('#calendar_id').val()}, function(data){
            data = $jDOPBSP.parseJSON($jDOPBSP.trim(data));
            
            $jDOPBSP('#DOPBSP-add-reservation').css('display', 'none');
            $jDOPBSP('#DOPBSP-reset-reservations-filter').css('display', 'none');
            $jDOPBSP('#DOPBSP-submit-reservation').removeAttr('style');
            $jDOPBSP('#DOPBSP-back-reservation').removeAttr('style');
        
            $jDOPBSP('.DOPBSP-admin .reservations-content').html('<div id="DOPBSP-add-reservation-form"></div>');
            $jDOPBSP('#DOPBSP-add-reservation-form').DOPBookingSystemPROAddReservation(data);
        });
    }
}

function dopbspToggleReservationsMessage(action, message){// Display Reservations Info Messages.
    if (action == 'show'){
        clearReservationsClick = false;
        clearTimeout(messageReservationsTimeout);
        $jDOPBSP('#DOPBSP-admin-reservations-message').addClass('loader');
        $jDOPBSP('#DOPBSP-admin-reservations-message').html(message);
        $jDOPBSP('#DOPBSP-admin-reservations-message').stop(true, true).animate({'opacity':1}, 600);
    }
    else{
        clearReservationsClick = true;
        $jDOPBSP('#DOPBSP-admin-reservations-message').removeClass('loader');
        $jDOPBSP('#DOPBSP-admin-reservations-message').html(message);
        
        messageReservationsTimeout = setTimeout(function(){
            $jDOPBSP('#DOPBSP-admin-reservations-message').stop(true, true).animate({'opacity':0}, 600, function(){
                $jDOPBSP('#DOPBSP-admin-reservations-message').html('');
            });
        }, 2000);
    }
}