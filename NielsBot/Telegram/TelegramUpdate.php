<?php
namespace NielsBot\Telegram;

use NielsBot\Core\NielsBot;
use NielsBot\Plugins\CommandEvent;
use NielsBot\Plugins\Event;
use NielsBot\Plugins\MessageEvent;

class TelegramUpdate
{
	public function __construct($update)
	{
		$chat = new TelegramChat($update['chat'] ?? null);
		//$user = new TelegramUser($update['from'] ?? null);

		//print_r($update);

		if(isset($update['text'])) {
			if(substr(trim($update['text']), 0, 1) == '/'){
				preg_match('/\/([A-Za-z0-9]+)(?:[\@\w]+|)[ ]{0,1}(.+|)/', $update['text'], $matches);

				$this->trigger('command', $matches[1], new CommandEvent($chat, $matches[1], $matches[2] ?? ''));
			}else {
				$this->trigger('message', new MessageEvent($chat, $update['text']));
			}
		}

		//todo add more triggers
	}

	/**
	 * @param string $event
	 * @param string|string[] $type
	 * @param Event $payload
	 */
	private function trigger($event, $type = null, $payload = null){
		NielsBot::getInstance()->triggerEvent($event, $type, $payload);
	}
}