<?php
namespace NielsBot\Plugins;


use NielsBot\Core\NielsBot;

class Plugin
{
	/**
	 * @var string
	 */
	private $name;

	/**
	 * @var string
	 */
	private $description;

	/**
	 * @var callable[][][]
	 */
	private $events;

	public function __construct($name, $description)
	{
		$this->name = $name;
		$this->description = $description;

		NielsBot::getInstance()->registerPlugin($this);
	}

	/**
	 * @param string $event
	 * @param string[] $matches
	 * @param callable $callback
	 */
	public function on($event, $matches = null, $callback = null)
	{
		if($callback == null && $matches != null) {
			$callback = $matches;
			$matches = null;
		}

		if($matches == null || count($matches) == 0)
			$matches = ['*'];
		else if(is_string($matches))
			$matches = [$matches];

		if(!isset($this->events[$event]))
			$this->events[$event] = [];

		foreach($matches as $match) {
			if(!isset($this->events[$event][$match]))
				$this->events[$event][$match] = [];

			$this->events[$event][$match][] = $callback;
		}
	}

	/**
	 * @return \callable[][][]
	 */
	public function getEvents()
	{
		return $this->events;
	}

	/**
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * @return string
	 */
	public function getDescription()
	{
		return $this->description;
	}
}