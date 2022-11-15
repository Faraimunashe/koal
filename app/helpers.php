<?php

use App\Models\Abattoir;
use App\Models\Cattle;
use App\Models\User;

function get_booking_status($num){
    $status = new stdClass();
    if($num === 2){
        $status->label = "pending";
        $status->badge = "warning";
    }elseif($num === 1){
        $status->label = "approved";
        $status->badge = "success";
    }else{
        $status->label = "rejected";
        $status->badge = "danger";
    }

    return $status;
}

function get_user($user_id){
    return User::find($user_id);
}

function get_abattoir($abattoir_id){
    return Abattoir::find($abattoir_id);
}

function count_cattle($booking_id){
    return Cattle::where('booking_id', $booking_id)->count();
}
