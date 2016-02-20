<?php
use NielsBot\Plugins\CommandEvent;
use NielsBot\Plugins\Plugin;

$rtdPlugin = new Plugin('Roll the Dice', 'Roll the Dice plugin');
$rtdPlugin->on('command', ['rtd'], function(CommandEvent $event){
	$result = rand(1, 6);

	$event->getChat()->sendMessage('Rolled number ' . $result);
});