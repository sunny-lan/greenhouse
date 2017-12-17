<?php

/**
 * Created by PhpStorm.
 * User: Sunny
 * Date: 2017-12-04
 * Time: 3:40 PM
 */
class BoxFormFields implements Component
{

    static function render($param = []): string
    {
        $util = new Util();

        $box = null;
        if (array_key_exists('box', $param))
            $box = $param['box'];

        $page = <<<HTML
        Description: <input name="description" value="{$util::guard($box, 'getDescription')}">
HTML;

        return $page;
    }
}