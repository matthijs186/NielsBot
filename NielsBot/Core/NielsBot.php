<?php
namespace NielsBot\Core;

use NielsBot\Plugins\Event;
use NielsBot\Plugins\Plugin;
use NielsBot\Util\EmojiParser;

class NielsBot
{
	/**
	 * @var NielsBot
	 */
	private static $instance;

	/**
	 * @var Plugin[]
	 */
	private $plugins;

	/**
	 * @var EmojiParser
	 */
	private $emojiParser;

	public function __construct()
	{
		self::$instance = $this;

		$this->plugins = [];
		$this->findPlugins(__DIR__ . '/../../Plugins/');
	}

	/**
	 * @param string $folder
	 */
	private function findPlugins($folder)
	{
		if (!is_dir($folder))
			return;

		foreach (glob($folder . '*') as $file) {
			if (is_dir($file))
				$this->findPlugins($file);
			else if (substr($file, -4) == '.php')
				require_once $file;
		}
	}

	/**
	 * @param Plugin $plugin
	 */
	public function registerPlugin($plugin)
	{
		$this->plugins[] = $plugin;
	}

	/**
	 * @return EmojiParser
	 */
	public function getEmojiParser()
	{
		if($this->emojiParser == null)
			$this->emojiParser = new EmojiParser();

		return $this->emojiParser;
	}

	/**
	 * @param string $event
	 * @param string|string[] $type
	 * @param Event $payload
	 */
	public function triggerEvent($event, $type, $payload)
	{
		if($payload == null && $type != null) {
			$payload = $type;
			$type = null;
		}

		foreach ($this->plugins as $plugin) {
			$events = $plugin->getEvents();

			if (isset($events[$event])) {
				if (isset($events[$event][$type])) {
					foreach($events[$event][$type] as $callable) {
						$callable($payload);
					}
				}

				if (isset($events[$event]['*'])) {
					foreach($events[$event]['*'] as $callable) {
						$callable($payload);
					}
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
}