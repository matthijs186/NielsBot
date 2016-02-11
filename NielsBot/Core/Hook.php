<?php
namespace NielsBot\Core;

class Hook
{
	private $name;
	private $handlers;

	/**
	 * Hook constructor.
	 * @param string $name
	 */
	public function __construct($name)
	{
		$this->name = $name;
	}

	/**
	 * @param string|string[] $names
	 *
	 * @return $this
	 */
	public function cmd($names)
	{
		if (!is_array($names))
			$names = [$names];

		foreach ($names as $name)
			NielsBot::getInstance()->addTrigger(Trigger::COMMAND, $name, $this);

		return $this;
	}

	public function func($handler)
	{
		$this->handlers[] = $handler;

		return $this;
	}

	public function exec(Update $update)
	{
		foreach ($this->handlers as $handler) {
			try {
				$handler($update);
			} catch (\Exception $e) {
				// No error handler yet
				$update->getChat()->sendMessage('Something went wrong while executing hook ' . $this->name);
			}
		}
	}
}