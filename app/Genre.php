<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    public function books()
    {
        return $this->belongsToMany('App\Book');
    }
}

if (!function_exists('convertBulan')) {
    function convertBulan($bulan)
    {
        switch ($bulan) {
            case 1:
                $Nama_bulan = "Januari";
                break;
            case 2:
                $Nama_bulan = "Februari";
                break;
            case 3:
                $Nama_bulan = "Maret";
                break;
            case 4:
                $Nama_bulan = "April";
                break;
            case 5:
                $Nama_bulan = "Mei";
                break;
            case 6:
                $Nama_bulan = "Juni";
                break;
            case 7:
                $Nama_bulan = "Juli";
                break;
            case 8:
                $Nama_bulan = "Agustus";
                break;
            case 9:
                $Nama_bulan = "September";
                break;
            case 10:
                $Nama_bulan = "Oktober";
                break;
            case 11:
                $Nama_bulan = "November";
                break;
            default:
                $Nama_bulan = "Desember";
        }
        return $Nama_bulan;
    }
}
