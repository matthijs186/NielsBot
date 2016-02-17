<?php
use NielsBot\Core\NielsBot;
use NielsBot\Telegram\Telegram;
use NielsBot\Telegram\TelegramUpdate;

spl_autoload_register(function ($cls) {
	$path = __DIR__ . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $cls) . '.php';

	if (file_exists($path))
		require_once $path;
});

if(!isset($_GET['token']))
	die;

Telegram::setToken($_GET['token']);
$update = json_decode(file_get_contents('php://input'), true);

$bot = new NielsBot();
$bot->update(new TelegramUpdate($update['message'] ?? []));