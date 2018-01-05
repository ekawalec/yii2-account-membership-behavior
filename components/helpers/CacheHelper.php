<?php
/**
 * Created by PhpStorm.
 * User: jaszczomp
 * Date: 2017.05.04
 * Time: 23:57
 */

namespace common\components\helpers;


use Yii;
use yii\caching\FileCache;

class CacheHelper
{

    public static function flushBackend() {
        $path = Yii::getAlias('@backend').DIRECTORY_SEPARATOR.'runtime'.DIRECTORY_SEPARATOR.'cache';
        if (file_exists($path)) {
            $cache = new FileCache();
            $cache->cachePath=$path;
            $cache->flush();
        }
    }

    public static function flushFrontend() {
        $path = Yii::getAlias('@frontend').DIRECTORY_SEPARATOR.'runtime'.DIRECTORY_SEPARATOR.'cache';
        if (file_exists($path)) {
            $cache = new FileCache();
            $cache->cachePath=$path;
            $cache->flush();
        }
    }
}
