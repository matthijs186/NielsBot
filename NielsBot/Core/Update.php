<?php
namespace NielsBot\Core;

abstract class Update
{
	protected $chat;
	protected $user;
	protected $data = [];

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

	/**
	 * @param string $key
	 *
	 * @return mixed|null
	 */
	public function getData($key)
	{
		if(isset($this->data[$key]))
			return $this->data[$key];

		return null;
	}
}