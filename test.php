<?php
spl_autoload_register(function ($cls) {
	$path = __DIR__ . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $cls) . '.php';

	if (file_exists($path))
		require_once $path;
});

print_r((new \NielsBot\Util\EmojiMapper())->remap());