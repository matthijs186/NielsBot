<?php
namespace NielsBot\Telegram;

use NielsBot\Core\Trigger;
use NielsBot\Core\Update;

class TelegramUpdate extends Update
{
	private $trigger;
	private $triggerSub;

	public function __construct($update)
	{
		$this->chat = new TelegramChat($update['chat'] ?? null);
		$this->user = new TelegramUser($update['from'] ?? null);

		if($update['text'] ?? false) {
			if (substr($update['text'], 0, 1) == '/') {
				$this->trigger = Trigger::COMMAND;
				$this->triggerSub = explode(' ', substr($update['text'], 1))[0];
			} else {
				$this->trigger = Trigger::MESSAGE;
				$this->triggerSub = $update['text'];
			}
		}

		//todo multiple triggers!?
		// Send triggers as argument in constructor?
	}

	/**
	 * @return int
	 */
	public function getTrigger()
	{
		return $this->trigger;
	}

	/**
	 * @return string
	 */
	public function getTriggerSub()
	{
		return $this->triggerSub;
	}
}