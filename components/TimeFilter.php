<?php

/**
 * Created by PhpStorm.
 * User: Sunny
 * Date: 2017-12-05
 * Time: 2:56 PM
 */
class TimeFilter implements Component
{

    static function render($param = []): string
    {
        $today = date('Y-m-d');
        $util = new Util();

        JSRequire::req('js/util.js');
        $setFilter = <<<JS
        function setFilter(startDate, endDate){
            if(startDate===undefined)startDate='';
            if(endDate===undefined)endDate='';
            setPage([['startDate', startDate], ['endDate', endDate]]);
        }
JS;
        JSRequire::script($setFilter);

        $earliestDate = $param['earliestDate'];
        $earliestDate->setDate($earliestDate->format('Y'), 1, 1);
        $latestDate = $param['latestDate'];

        $startDate = null;
        if (array_key_exists('startDate', $param) and $param['startDate'] !== '')
            $startDate = $param['startDate'];

        $endDate = null;
        if (array_key_exists('endDate', $param) and $param['endDate'] !== '')
            $endDate = $param['endDate'];

        $interval = DateInterval::createFromDateString('1 year');
        $period = new DatePeriod($earliestDate, $interval, $latestDate);
        $filterLinks = "";
        foreach ($period as $dt/* @var $dt DateTime */) {
            $year = $dt->format('Y');
            $filterLinks .= <<<HTML
            <a href="javascript: setFilter('$year-01-01','$year-12-31');">$year</a>
HTML;
        }

        return <<<HTML
        <div class="time-filter">
            Filter: <a href='javascript: setFilter();'>all</a>
            {$filterLinks}
            <a href="javascript: setFilter('{$today}', '{$today}');">Today</a>
            <form action="" method="get">
                <div class="input-row">
                    Start date: <input name="startDate" value="{$util::guard($startDate, 'format', 'Y-m-d')}">
                </div>
                <div class="input-row">
                    End date: <input name="endDate" value="{$util::guard($endDate, 'format', 'Y-m-d')}">
                </div>
                <input type="submit" value="Filter">
            </form>
        </div>
HTML;

    }
}