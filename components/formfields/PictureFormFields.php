<?php

/**
 * Created by PhpStorm.
 * User: Sunny
 * Date: 2017-12-04
 * Time: 3:40 PM
 */
class PictureFormFields implements Component
{

	static function render($param = []): string
	{
		$util = new Util();

		$picture = Util::guardA($param, 'picture');

		$pageSelector = '';
		if ($picture === null) {
			$pageSelector = PageSelector::render(['name' => 'page', 'filter'=>"'image/png', 'image/jpg', 'image/svg+xml'"]);
			$pageSelector = <<<HTML
			<div class="input-row">
        	File: {$pageSelector}
        	</div>
HTML;
		}

		$page = <<<HTML
		{$pageSelector}
		<div class="input-row">
            Description: 
            <textarea name="description">{$util::guard($picture, 'getDescription')}</textarea>
        </div>
HTML;

		return $page;
	}
}