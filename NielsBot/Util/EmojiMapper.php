<?php
namespace NielsBot\Util;

class EmojiMapper
{
	private $source = 'https://raw.githubusercontent.com/iamcal/emoji-data/master/build/data_emoji_names_more.txt';

	public function remap(){
		mb_internal_encoding("UTF-8");
		$data = preg_split ('/$\R?^/m', file_get_contents($this->source));
		$mapping = [];

		foreach($data as $line){
			$line = explode(';', $line, 2);

			if(count($line) != 2)
				continue;

			$chars = (json_decode('"\u' . str_replace('-', '\u', $line[0]) . '"'));
			$name = $line[1];

			$mapping[$name] = $chars;
		}

		return $mapping;
	}
}