<?php

/**
 * Created by PhpStorm.
 * User: Sunny
 * Date: 2017-12-13
 * Time: 4:35 PM
 */
class Form implements Component
{
    static $getPrefix = "GET-PARAM-";

    static function render($param = []): string
    {
        $s = Form::$getPrefix;

        $getParams = "";
        foreach ($_GET as $key => $value)
            $getParams .= <<<HTML
            <input name="{$s}{$key}" value="{$value}" type="hidden">
HTML;

        $extend = '';
        if (array_key_exists('extendAttr', $param))
            $extend = $param['extendAttr'];

        $page = <<<HTML
        <form method="POST" action="{$param['action']}" {$extend}>
            {$getParams} 
            {$param['content']}
        </form>
HTML;

        return $page;
    }

    static function loadGetParams()
    {
        foreach ($_POST as $key => $value/* @var $key string */) {
            if (strpos($key, self::$getPrefix) === 0) {
                $_GET[substr($key, strlen(self::$getPrefix))] = $value;
                unset($_POST[$key]);
            }
        }
    }
}

//todo cust
Form::loadGetParams();