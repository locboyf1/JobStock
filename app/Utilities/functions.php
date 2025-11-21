<?php

namespace App\Utilities;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class functions
{

    public static function getListProvince()
    {
        $provinces = Storage::disk('public')->get('provinces.json');
        return json_decode($provinces, true);
    }

    public static function getProvinceName($id)
    {
         $data = self::getListProvince();

        return collect($data)->where('code', '=', $id)->first()['name'];
    }
}
