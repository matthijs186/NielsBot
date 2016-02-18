<?php
/**
 * Created by IntelliJ IDEA.
 * User: nelis
 * Date: 2016-02-18
 * Time: 21:18
 */

namespace NielsBot\Plugins;


use NielsBot\Telegram\TelegramChat;

class CommandEvent extends MessageEvent
{
	/**
	 * @var string
	 */
	protected $command;

	/**
	 * CommandEvent constructor.
	 * @param TelegramChat $chat
	 * @param string $command
	 * @param $message
	 */
	public function __construct(TelegramChat $chat, $command, $message)
	{
		parent::__construct($chat, $message);

		$this->command = $command;
	}

	/**
	 * @return string
	 */
	public function getCommand()
	{
		return $this->command;
	}
}