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

        $box = Util::guardA($param, 'box');

        $rect=Util::guard($box, 'getRect', null, []);

        $page = <<<HTML
        <div class="input-row">
            Name: <input name="name" value="{$util::guard($box, 'getName')}">
        </div>
        <div class="input-row">
            Left: <input name="l" value="{$util::guardA($rect, 'l')}">
            Top: <input name="top" value="{$util::guardA($rect, 'top')}">
        </div>
        <div class="input-row">
            Height: <input name="r" value="{$util::guardA($rect, 'r')}">
            Width: <input name="bottom" value="{$util::guardA($rect, 'bottom')}">
        </div>
        <div class="input-row">
            Description: <textarea name="description">{$util::guard($box, 'getDescription')}</textarea>
        </div>
HTML;

        return $page;
    }
}