<?php

namespace App\Http\Helpers;

use App\Http\Controllers\Controller;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;


class MyHelper
{
    public static function time_past($time = null)
    {
        $datetime1 = date_create(date("Y-m-d H:i:s"));
        $datetime2 = date_create(date("Y-m-d H:i:s", strtotime('+7 hours', strtotime($time))));
        $interval = date_diff($datetime1, $datetime2);
        $times = array(
            'year' => $interval->y,
            'month' => $interval->m,
            'day' => $interval->d,
            'hour' => $interval->h,
            'minute' => $interval->i,
            'second' => $interval->s
        );
        $res = '';
        foreach ($times as $key => $val) {
            if ($key == 'year' && $val > 0) {
                $res = $val . ' thn lalu';
            }

            if ($key == 'month' && $val <= 12 && $val > 0) {
                $res = $val . ' bln lalu';
            }

            if ($key == 'day' && $val < 31 && $val > 0) {
                $res = $val . ' hari lalu';
            }

            if ($key == 'hour' && $val < 24 && $val > 0) {
                $res = $val . ' jam lalu';
            }
            if ($res == '') {

                if ($key == 'minute' && $val < 24 && $val > 0) {
                    $res = 'Eksklusif';
                }

                if ($key == 'second' && $val < 24 && $val > 0) {
                    $res = 'Eksklusif';
                }
            }
        }
        return $res;
    }

    public static function duration($seconds)
    {
        $hours = floor($seconds / 3600);
        $minutes = floor(($seconds / 60) % 60);
        $seconds = $seconds % 60;
        return $hours > 0 ? "$hours h $minutes m" : ($minutes > 0 ? "$minutes m $seconds s" : "$seconds s");
    }

    public static function getLength($x, $length)
    {
        if (strlen($x) <= $length) {
            echo $x;
        } else {
            $y = substr($x, 0, $length) . '...';
            echo $y;
        }
    }

    public static function getAsset($path)
    {
        $baseUrl = (config('api.assets_url') == '' ? url('') : config('api.assets_url'));
        return $baseUrl . '/' . $path;
    }

    public static function getImage($file)
    {
        $info = pathinfo($file);
        if (isset($info['extension'])) {
            $file_name =  basename($file, '.' . $info['extension']);
            return $file_name;
        } else {
            return null;
        }
    }

    public static function limitDesc($kata, $length)
    {
        if (strlen($kata) <= $length) {
            return $kata;
        } else {
            $y = substr($kata, 0, $length) . '...';
            return $y;
        }
    }
    public function getCookieAppier(){
        $value = Cookie::get('QGUserId');
        return $value;
    }
}
