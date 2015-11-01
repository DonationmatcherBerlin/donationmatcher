<?php

if(! function_exists('opening_hours')){

    function opening_hours($json){

        $hours = json_decode($json);
        if (!$hours) return '';

        $string = '';
        $days = ['Mo','Di','Mi','Do','Fr','Sa','So'];
        foreach ($hours as $day => $officeHours) {
            if ($officeHours->isActive) {
                $string .= $days[$day] . ' ' . $officeHours->timeFrom . ' - ' . $officeHours->timeTill . ' Uhr, ';
            }
        }

        return trim($string, ', ');
    }

}