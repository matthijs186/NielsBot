<?php
use NielsBot\Core\NielsBot;
use NielsBot\Plugins\Plugin;
use NielsBot\Plugins\CommandEvent;

$commonPlugin = new Plugin('Common', 'Basic functions for bot');
$commonPlugin->on('command', ['plugins'], function(CommandEvent $event){
	$message = '*Plugin list*' . PHP_EOL . PHP_EOL;

	foreach(NielsBot::getInstance()->getPlugins() as $plugin){
		$message .= '*' . $plugin->getName() . '*' . PHP_EOL;
		$message .= $plugin->getDescription() . PHP_EOL;
		$message .= PHP_EOL;
	}

	$event->getChat()->sendMessage($message);
});

$commonPlugin->on('command', ['help', 'commands'], function(CommandEvent $event){
	$message = '*Command list*' . PHP_EOL . PHP_EOL;

	foreach(NielsBot::getInstance()->getPlugins() as $plugin){
		$message .= '*' . $plugin->getName() . '*' . PHP_EOL;

		$i = 0;
		foreach($plugin->getEvents() as $type => $commands){
			if($type === 'command'){
				foreach($commands as $command => $exec) {
					$i++;
					$message .= $command . PHP_EOL;
				}
			}
		}

		if($i == 0)
			$message .= '_No commands_' . PHP_EOL;

		$message .= PHP_EOL;
	}

	$event->getChat()->sendMessage($message);
});