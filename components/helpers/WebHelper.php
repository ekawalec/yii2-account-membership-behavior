<?php

namespace common\components\helpers;
/**
 * Created by PhpStorm.
 * User: jaszczomp
 * Date: 2017.04.10
 * Time: 11:59
 */
class WebHelper
{
    /**
     * Find real user IP
     *
     * @return string|null
     */
    public static function getRealIp() {
        $ip = null;
        if (php_sapi_name() == 'cli') {
            return $ip;
        }
        else {
            $client  = @$_SERVER['HTTP_CLIENT_IP'];
            $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
            $remote  = @$_SERVER['REMOTE_ADDR'];

            if(filter_var($client, FILTER_VALIDATE_IP)) {
                $ip = $client;
            }
            elseif(filter_var($forward, FILTER_VALIDATE_IP)) {
                $ip = $forward;
            }
            else {
                $ip = $remote;
            }
            return $ip;
        }
    }
}
