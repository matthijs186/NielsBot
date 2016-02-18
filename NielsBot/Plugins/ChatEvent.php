<?php
namespace NielsBot\Plugins;

use NielsBot\Telegram\TelegramChat;

abstract class ChatEvent extends Event
{
	/**
	 * @var TelegramChat
	 */
	protected $chat;

	/**
	 * @return TelegramChat
	 */
	public function getChat(){
		return $this->chat;
	}
}