<?php
use NielsBot\Plugins\MessageEvent;
use NielsBot\Plugins\Plugin;

$gitHub = new Plugin('GitHub', 'Posts info about GitHub repositories.');

$gitHub->on('message', function (MessageEvent $event) {
	// TODO store github token in some kind of database?
	if(!file_exists(__DIR__ . '/../GITHUB_TOKEN'))
		return;

	$message = $event->getMessage();

	if (!preg_match_all('/(?:.*)https?:\/\/github\.com\/([a-zA-Z0-9-_\.]+)\/?([a-zA-Z0-9-_\.]+)?\/?([a-zA-Z0-9-_\/\.]+)?(?:.*)/', $message, $matches))
		return;

	$user = $matches[1][0];
	$repo = $matches[2][0] ?? null;

	$ch = curl_init('https://api.github.com/repos/' . urlencode($user) . '/' . urlencode($repo));

	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_USERAGENT, 'NielsBot');
	curl_setopt($ch, CURLOPT_USERPWD, file_get_contents(__DIR__ . '/../GITHUB_TOKEN'));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

	$apiResult = curl_exec($ch);
	curl_close($ch);
	print_r($apiResult);

	if ($apiResult === false) {
		$event->getChat()->sendMessage('Could not read from GitHub repository.' . PHP_EOL . PHP_EOL . $apiResult);

		return;
	}

	$apiResult = json_decode($apiResult, true);

	$message = '*' . $apiResult['full_name'] . '*' . PHP_EOL;
	$message .= $apiResult['description'] . PHP_EOL;

	$message .= ' :eye: ' . $apiResult['watchers_count'] ?? '?';
	$message .= ' :star:' . $apiResult['stargazers_count'] ?? '?';
	$message .= ' :zap: ' . $apiResult['forks_count'] ?? '?';
	$message .= ' :nl: ' . $apiResult['language'] ?? '?';

	$event->getChat()->sendMessage($message);
});