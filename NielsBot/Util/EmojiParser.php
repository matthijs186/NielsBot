<?php
namespace NielsBot\Util;

class EmojiParser
{
	private $mapping;

	/**
	 * @param string $text
	 *
	 * @return string
	 */
	public function parse($text){
		if($this->mapping == null)
			$this->mapping = json_decode(file_get_contents(__DIR__ . '/../Resources/EmojiMapping.json'), true);

		$text = preg_replace_callback('/:([_a-zA-Z]+):/', function($matches){
			return $this->mapping[$matches[1]] ?? $matches[0];
		}, $text);

		return $text;
	}
}