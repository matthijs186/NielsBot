<?php
namespace NielsBot\Plugins;

use NielsBot\Telegram\TelegramChat;

class MessageEvent extends ChatEvent
{
	/**
	 * @var string
	 */
	protected $message;

	/**
	 * MessageEvent constructor.
	 * @param TelegramChat $chat
	 * @param string $message
	 */
	public function __construct($chat, $message)
	{
		$this->chat = $chat;
		$this->message = $message;
	}

	/**
	 * @return string
	 */
	public function getMessage()
	{
		return $this->message;
	}
}