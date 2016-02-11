<?php
namespace NielsBot\Telegram;


use NielsBot\Core\Chat;

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
			'text' => $string,
			'parse_mode' => 'markdown'
		]);
	}
}