<?php

/**
 * Created by PhpStorm.
 * User: Sunny
 * Date: 2017-12-15
 * Time: 1:37 PM
 */
class UserSelector implements Component
{

	static function render($param = []): string
	{
		$name = Util::guardA($param, 'name');

		$selectedID = Util::guardA($param, 'value');
		if ($selectedID != null)
			$selectedID = $selectedID->getID();

		$filter = Util::guardA($param, 'filter');

		$mgr = new UserMgr();
		$userOptions = "";
		foreach ($mgr->listUsers() as $user/* @var $user User */) {
			if ($filter !== null)
				if ($filter !== $user->getType())
					continue;
			$selected = "";
			if ($selectedID === $user->getID())
				$selected = "selected='selected'";
			$userOptions .= <<<HTML
            <option value="{$user->getID()}" {$selected}>{$user->getUsername()} - {$user->getName()}</option>
HTML;
		}

		return <<<HTML
        <select name="{$name}">
			<option value="">unspecified</option>
			{$userOptions}
		</select>
HTML;
	}
}