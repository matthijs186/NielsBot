<?php
use NielsBot\Plugins\CommandEvent;
use NielsBot\Plugins\MessageEvent;
use NielsBot\Plugins\Plugin;

$repeatMe = new Plugin('RepeatMe', 'Annoying plugin repeating certain messages.');

$repeatMe->on('message', function(MessageEvent $event){
	$message = $event->getMessage();

	$emoticons = [':)', ':c', 'c:', ':(', ':\')', ':\'(', ':d', ':s', '( ͡° ͜ʖ ͡°)'];
	if(in_array(strtolower($message), $emoticons))
		$event->getChat()->sendMessage($message);
});

$repeatMe->on('command', ['repeat', 'echo'], function(CommandEvent $event){
	$command = $event->getCommand();
	$message = $event->getMessage();

	$event->getChat()->sendMessage($message);
});