<?php

/**
 * Created by PhpStorm.
 * User: Sunny
 * Date: 2017-11-22
 * Time: 4:33 PM
 */
interface Component
{
    static function render($param = []): string;
}