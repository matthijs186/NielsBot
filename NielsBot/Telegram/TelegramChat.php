<?php
namespace NielsBot\Telegram;


use NielsBot\Core\Chat;
use NielsBot\Core\NielsBot;

class TelegramChat extends Chat
{
	private $id;

	public function __construct($chat)
	{
		$this->id = $chat['id'] ?? null;
	}

	public function sendMessage($string)
	{
		Telegram::api('sendMessage', [
			'chat_id' => $this->id,
			'text' => NielsBot::getInstance()->getEmojiParser()->parse($string),
			'parse_mode' => 'markdown'
		]);
	}
}