<?php
namespace NielsBot\Core;

abstract class Update
{
	protected $chat;
	protected $user;

	/**
	 * @return Chat
	 */
	public function getChat()
	{
		return $this->chat;
	}

	/**
	 * @return User
	 */
	public function getUser()
	{
		return $this->user;
	}

	/**
	 * @return int
	 */
	public abstract function getTrigger();

	/**
	 * @return string
	 */
	public abstract function getTriggerSub();
}