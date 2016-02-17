<?php
use function NielsBot\Core\hook;
use NielsBot\Core\Update;

hook('emoji')
	->cmd(['emoji', 'emoticon', ':)'])
	->func(function (Update $update) {
		$msg = $update->getData('message');

		//fixme: quick hack because there is not much functionality yet..
		$msg = explode(' ', $msg, 2);
		$msg = $msg[1] ?? $msg[0];

		$update->getChat()->sendMessage($msg);
	});