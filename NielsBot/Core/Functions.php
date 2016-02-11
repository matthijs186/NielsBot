<?php
namespace NielsBot\Core;

class Functions {
	public function __construct()
	{
		// Do nothing, just a placeholder
	}
}

/**
 * @param string $name
 * @return Hook
 */
function hook($name = ''){
	return NielsBot::getInstance()->createHook($name);
}