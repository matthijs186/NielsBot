<?php
use NielsBot\Plugins\MessageEvent;
use NielsBot\Plugins\Plugin;

$repeatMe = new Plugin('RepeatMe', 'Annoying plugin repeating certain messages.');

$repeatMe->on('message', function(MessageEvent $event){
	$message = $event->getMessage();

	$emoticons = [':)', ':c', 'c:', ':(', ':\')', ':\'(', ':d', ':s'];
	if(in_array(strtolower($message), $emoticons))
		$event->getChat()->sendMessage($message);
});