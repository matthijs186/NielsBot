<?php
function JUST_FOR_REFERENCE()
{
	// placed inside function so NielsBot does not detect these functions

	$devPlugin = new Plugin('development', 'Plugin intended for development purpose.');
	$devPlugin->on('command', ['emoji', 'emoticon', ':)'], function (Event $event) {
		/* Event is instanceof CommandEvent */
	});

	$devPlugin->on('user', ['join', 'leave'], function (Event $event) {
		/* Event is instanceof UserJoinEvent OR UserLeaveEvent is instanceof UserEvent */
	});

	$devPlugin->on('message', ['direct', 'reply', 'forward'], function (MessageEvent $event) {
		/* MessageReplyEvent etc. */
	});

	// Skipping the optional second parameter
	$devPlugin->on('message', function (MessageEvent $message) {

	});
}