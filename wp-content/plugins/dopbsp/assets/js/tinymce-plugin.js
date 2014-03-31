/*
* Title                   : Booking System PRO (WordPress Plugin)
* Version                 : 1.2
* File                    : tinymce-plugin.php
* File Version            : 1.0
* Created / Last Modified : 15 July 2012
* Author                  : Marius-Cristian Donea
* Copyright               : © 2012 Marius-Cristian Donea
* Website                 : http://www.mariuscristiandonea.com
* Description             : TinyMCE Editor Plugin.
*/

(function(){
    var title, i,
    calendarsData,
    calendars = new Array();

    tinymce.create('tinymce.plugins.DOPBSP', {
        init:function(ed, url){
            title = DOPBSP_tinyMCE_data.split(';;;;;')[0];
            calendarsData = DOPBSP_tinyMCE_data.split(';;;;;')[1];
            calendars = calendarsData.split(';;;');
        },

        createControl:function(n, cm){// Init Combo Box.
            switch (n){
                case 'DOPBSP':
                    if (calendarsData != ''){
                        var mlb = cm.createListBox('DOPBSP', {
                             title: title,
                             onselect: function(value){
                                 tinyMCE.activeEditor.selection.setContent(value);
                             }
                        });

                        for (i=0; i<calendars.length; i++){
                            if (calendars[i] != ''){
                                mlb.add('ID '+calendars[i].split(';;')[0]+': '+calendars[i].split(';;')[1], '[dopbsp id="'+calendars[i].split(';;')[0]+'"]');
                            }
                        }

                        return mlb;
                    }
            }

            return null;
        },

        getInfo:function(){
            return {longname  : 'Booking System PRO',
                    author    : 'Marius-Cristian Donea',
                    authorurl : 'http://www.mariuscristiandonea.com',
                    infourl   : 'http://www.mariuscristiandonea.com',
                    version   : '1.0'};
        }
    });

    tinymce.PluginManager.add('DOPBSP', tinymce.plugins.DOPBSP);
})();