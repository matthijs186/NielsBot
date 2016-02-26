<?php
use NielsBot\Plugins\CommandEvent;
use NielsBot\Plugins\MessageEvent;
use NielsBot\Plugins\Plugin;

$lenny = new Plugin('Lenny', 'Can u handle the dank me-mays m8?');

$lenny->on('command', ['lenny'], function(CommandEvent $event){
	$data = $event->getMessage();

	switch ($data) {
		case 'hugs':
			$lennyData = '(つ ͡° ͜ʖ ͡°)つ';
			break;

		case 'no':
			$lennyData = '( ͡°_ʖ ͡°)';
			break;

		case 'lenninati':
			$lennyData = '( ͡∆ ͜ʖ ͡∆)';
			break;

		case 'backward':
		case 'backwards':
			$lennyData = '( °͡ ʖ͜ °͡  )';
			break;

		case 'pumped':
			$lennyData = '(ง ͠° ͟ل͜ ͡°)ง';
			break;

		default:
			$lennyData = '( ͡° ͜ʖ ͡°)';
			break;
	}

	$event->getChat()->sendMessage($lennyData);
});
