<?php


function cek($value, $format = null) {
    // Check for NULL or empty value
    if (empty($value)) {
        return NULL;
    }

    // Handle DateTime object
    if ($value instanceof DateTime) {
        if (is_null($format)) {
            // Return 'Y-m-d' format if no specific format is provided and not equal to '1900-01-01'
            return $value->format('Y-m-d') !== '1900-01-01' ? $value->format('Y-m-d') : NULL;
        }
        return $value->format($format);
    }

    // Handle specific string values
    if ($value === '1900-01-01' || $value === '.00') {
        return NULL;
    }

    return $value;
}

function convertDateTime($value){
    if ($value instanceof DateTime) {
        if ($value->format('H:i:s') === '00:00:00') {
            $value = $value->format('Y-m-d');
        } else {
            $value = $value->format('Y-m-d H:i:s');
        }
    }else{
        $value=NULL;
    }

    return $value;
}