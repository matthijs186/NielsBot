<?php
use NielsBot\Core\NielsBot;
use NielsBot\Telegram\Telegram;
use NielsBot\Telegram\TelegramUpdate;

spl_autoload_register(function ($cls) {
	$path = __DIR__ . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $cls) . '.php';

	if (file_exists($path))
		require_once $path;
});

Telegram::setToken(file_get_contents(__DIR__ . '/BOT_TOKEN'));
$updates = Telegram::api('getUpdates');
print_r($updates);

if(!isset($updates['ok']) || !$updates['ok'])
	die('Something went wrong.');

$bot = new NielsBot();
foreach($updates['result'] as $update)
	$bot->update(new TelegramUpdate($update['message'] ?? []));

$updates = Telegram::api('getUpdates');