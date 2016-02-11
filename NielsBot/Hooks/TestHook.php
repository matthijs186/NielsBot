<?php
use function NielsBot\Core\hook;
use NielsBot\Core\Update;

hook('troll')
	->cmd(['troll', 'trollface', '9fag'])
	->func(function (Update $update) {
		$update->getChat()->sendMessage(':trollface: 😆');
	});