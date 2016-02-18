<?php
namespace NielsBot\Telegram;

use NielsBot\Core\NielsBot;
use NielsBot\Plugins\Event;
use NielsBot\Plugins\MessageEvent;

class TelegramUpdate
{
	public function __construct($update)
	{
		$chat = new TelegramChat($update['chat'] ?? null);
		//$user = new TelegramUser($update['from'] ?? null);

		print_r($update);

		if(isset($update['text']))
			$this->trigger('message', new MessageEvent($chat, $update['text']));

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