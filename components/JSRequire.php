<?php

/**
 * Created by PhpStorm.
 * User: Sunny
 * Date: 2017-11-27
 * Time: 1:48 PM
 */
class JSRequire
{
    static function script(string $script)
    {
        if (!array_key_exists('JSRequire_script', $GLOBALS))
            $GLOBALS['JSRequire_script'] = [];
        $GLOBALS['JSRequire_script'][] = $script;
    }

    static function req(string $loc)
    {
        if (!array_key_exists('JSRequire', $GLOBALS))
            $GLOBALS['JSRequire'] = [];
        $GLOBALS['JSRequire'][$loc] = true;
    }

    static function html(): string
    {
        if (!array_key_exists('JSRequire', $GLOBALS))
            $requires = [];
        else
            $requires = $GLOBALS['JSRequire'];

        $requireHTML = "";
        $SUB_DIR = SUB_DIR;
        foreach ($requires as $require => $enabled) {
            if (substr($require, 0, 4) !== "http")
                $require = "$SUB_DIR/$require";
            $requireHTML .= "<script src='$require'></script>";
        }


        if (!array_key_exists('JSRequire_script', $GLOBALS))
            $scripts = [];
        else
            $scripts = $GLOBALS['JSRequire_script'];

        foreach ($scripts as $script)
            $requireHTML .= "<script>$script</script>";

        return $requireHTML;
    }
}