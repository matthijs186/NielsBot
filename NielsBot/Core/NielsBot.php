<?php
namespace NielsBot\Core;

use NielsBot\Util\EmojiParser;

class NielsBot
{
	private static $instance;
	private $hooks;
	private $triggers;
	private $emojiParser;

	public function __construct()
	{
		self::$instance = $this;

		new Functions(); // Create simple functions

		$this->triggers = [];

		$this->addHooks(__DIR__ . '/../Hooks/'); // todo: Move to config?
	}

	private function addHooks($folder)
	{
		if (!is_dir($folder))
			return;

		foreach (glob($folder . '*') as $file) {
			if (is_dir($file))
				$this->addHooks($file);
			else if (substr($file, -4) == '.php')
				require_once $file;
		}
	}

	/**
	 * @param string $trigger
	 * @param string $sub
	 * @param Hook $hook
	 */
	public function addTrigger($trigger, $sub, $hook)
	{
		if(!isset($this->triggers[$trigger]))
			$this->triggers[$trigger] = [];

		if(!isset($this->triggers[$trigger][$sub]))
			$this->triggers[$trigger][$sub] = [];

		$this->triggers[$trigger][$sub][] = $hook;
	}

	/**
	 * @param string $name
	 * @return Hook
	 */
	public function createHook($name)
	{
		$hook = new Hook($name);
		$this->hooks[] = $hook;

		return $hook;
	}

	/**
	 * @param Update $update
	 */
	public function update($update)
	{
		$trigger = $update->getTrigger();
		$triggerSub = $update->getTriggerSub();

		if(isset($this->triggers[$trigger])) {
			if (isset($this->triggers[$trigger][$triggerSub])) {
				/** @var Hook $hook */
				foreach ($this->triggers[$trigger][$triggerSub] as $hook) {
					$hook->exec($update);
				}
			}
		}
	}

	/**
	 * @return NielsBot
	 */
	public static function getInstance()
	{
		return self::$instance;
	}

	public function getEmojiParser()
	{
		if($this->emojiParser == null)
			$this->emojiParser = new EmojiParser();

		return $this->emojiParser;
	}
}