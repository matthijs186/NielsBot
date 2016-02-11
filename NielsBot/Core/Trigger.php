<?php
/**
 * Created by IntelliJ IDEA.
 * User: nelis
 * Date: 2016-02-11
 * Time: 19:45
 */

namespace NielsBot\Core;


class Trigger
{
	const COMMAND = 0;

	const MESSAGE = 0;
	const AUDIO = 0;
	const DOCUMENT = 0;
	const PHOTO = 0;
	const STICKER = 0;
	const VIDEO = 0;
	const VOICE = 0;
	const CONTACT = 0;
	const LOCATION = 0;

	const new_chat_participant = 0;
	const left_chat_participant = 0;
	const new_chat_title = 0;
	const new_chat_photo = 0;
	const delete_chat_photo = 0;
	const group_chat_created = 0;
	const supergroup_chat_created = 0;
	const channel_chat_created = 0;
	const migrate_to_chat_id = 0;
	const migrate_from_chat_id = 0;
}