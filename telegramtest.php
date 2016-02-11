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
//$updates = '{"ok":true,"result":[{"update_id":936795905, "message":{"message_id":486,"from":{"id":98193985,"first_name":"Niels","last_name":"van Velzen","username":"HetIsNiels"},"chat":{"id":-33562681,"title":"HD Chocolade Koelpasta","type":"group"},"date":1455218192,"text":"gr"}}]}';

if(!isset($updates['ok']) || !$updates['ok'])
	die('Something went wrong.');

$bot = new NielsBot();
foreach($updates['result'] as $update)
	$bot->update(new TelegramUpdate($update['message'] ?? []));