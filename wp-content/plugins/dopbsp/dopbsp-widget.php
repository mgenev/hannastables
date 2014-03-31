<?php

/*
* Title                   : Booking System Pro (WordPress Plugin)
* Version                 : 1.2
* File                    : doptg-widget.php
* File Version            : 1.0
* Created / Last Modified : 05 September 2012
* Author                  : Marius-Cristian Donea
* Copyright               : © 2012 Marius-Cristian Donea
* Website                 : http://www.mariuscristiandonea.com
* Description             : Booking System Pro Widget Class.
*/
  
    class DOPBookingSystemPROWidget extends WP_Widget{
        function DOPBookingSystemPROWidget(){
            $widget_ops = array('classname' => 'DOPBookingSystemPROWidget', 'description' => DOPBSP_WIDGET_DESCRIPTION);
            $this->WP_Widget('DOPBookingSystemPROWidget', DOPBSP_WIDGET_TITLE, $widget_ops);
        }
 
        function form($instance){
            global $wpdb;
            
            $instance = wp_parse_args((array)$instance, array('title' => '', 'selection' => 'sidebar', 'id' => '0', 'ids' => '0'));
            $title = $instance['title'];
            $selection = $instance['selection'];
            $id = $instance['id'];
            $ids = $instance['ids'];
                            
            $bspHTML = array();
            
            array_push($bspHTML, '<p>');
            array_push($bspHTML, '    <label for="'.$this->get_field_id('title').'">'.DOPBSP_WIDGET_LABEL_TITLE.' </label>');
            array_push($bspHTML, '    <input class="widefat" id="'.$this->get_field_id('title').'" name="'.$this->get_field_name('title').'" type="text" value="'.esc_attr($title).'" />');
            
            array_push($bspHTML, '    <label for="'.$this->get_field_id('selection').'" style=" display: block; padding-top: 10px;">'.DOPBSP_WIDGET_LABEL_SELECTION.' </label>');
            array_push($bspHTML, '    <select class="widefat" id="'.$this->get_field_id('selection').'" name="'.$this->get_field_name('selection').'">');
            array_push($bspHTML, '        <option value="sidebar"'.(esc_attr($selection) == 'sidebar' ? ' selected="selected"':'').'>'.DOPBSP_WIDGET_SELECTION_SIDEBAR.'</option>');
//            array_push($bspHTML, '        <option value="search"'.(esc_attr($selection) == 'search' ? ' selected="selected"':'').'>'.DOPBSP_WIDGET_SELECTION_SEARCH.'</option>');
            array_push($bspHTML, '    </select>');
            
            array_push($bspHTML, '    <label for="'.$this->get_field_id('id').'" style=" display: block; padding-top: 10px;">'.DOPBSP_WIDGET_LABEL_ID.' </label>');
            array_push($bspHTML, '    <select class="widefat" id="'.$this->get_field_id('id').'" name="'.$this->get_field_name('id').'">');

            if (wp_get_current_user()->roles[0] == 'administrator' && $this->administratorHasPermissions(wp_get_current_user()->ID)){
                $calendars = $wpdb->get_results('SELECT * FROM '.DOPBSP_Calendars_table.' ORDER BY id DESC');
            }
            else{
                $calendars = $wpdb->get_results('SELECT * FROM '.DOPBSP_Calendars_table.' WHERE user_id="'.wp_get_current_user()->ID.'" ORDER BY id DESC');
            }

            if ($wpdb->num_rows != 0){
                foreach ($calendars as $calendar) {
                    if (esc_attr($id) == $calendar->id){
                        array_push($bspHTML, '<option value="'.$calendar->id.'" selected="selected">'.$calendar->id.' - '.$calendar->name.'</option>');
                        
                    }
                    else{
                        array_push($bspHTML, '<option value="'.$calendar->id.'">'.$calendar->id.' - '.$calendar->name.'</option>');
                    }
                }
            }
            else{
                array_push($bspHTML, '<option value="0">'.DOPBSP_WIDGET_NO_CALENDARS.'</option>');
            }
            
            array_push($bspHTML, '    </select>');
            array_push($bspHTML, '</p>');

            echo implode('', $bspHTML);
        }
 
        function update($new_instance, $old_instance){
            $instance = $old_instance;
            $instance['title'] = $new_instance['title'];
            $instance['id'] = $new_instance['id'];
            
            return $instance;
        }

        function widget($args, $instance){
            extract($args, EXTR_SKIP);

            echo $before_widget;
            $title = empty($instance['title']) ? ' ':apply_filters('widget_title', $instance['title']);
            $selection = empty($instance['selection']) ? 'sidebar':$instance['selection'];
            $id = empty($instance['id']) ? '0':$instance['id'];
            $ids = empty($instance['ids']) ? '0':$instance['ids'];
 
            if (!empty($title)){
                echo $before_title.$title.$after_title;        
            }

            //echo '<div class="DOPBookingSystemPROContainer" id="DOPBookingSystemPRO'.$id.'"><a href="'.DOPBSP_Plugin_URL.'frontend-ajax.php"></a></div>';
            
            switch ($selection){
                case 'sidebar':
                    echo '<div class="DOPBookingSystemPRO_SidebarWidget" id="DOPBookingSystemPRO_SidebarWidget'.$id.'"></div>';
                    break;
            }

            echo $after_widget;
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
    }

?>