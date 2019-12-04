<?php

namespace App\Helpers;

class StringHelper{

    public function stringToArrayConversion($string, $divider){

        return explode( $divider,$string);
    }

}