<?php


namespace App\Factories;


class DatabaseOperationConstants
{

    public const CREATE_CHANNEL_STRATEGY = 'create channel strategy';
    public const CREATE_INVITATION_STRATEGY = 'create invitation strategy';
    public const CREATE_MESSAGE_STRATEGY = 'create message strategy';
    public const CREATE_MODERATOR_STRATEGY = 'create moderator strategy';

    public const UPDATE_CHANNEL_STRATEGY = 'update channel strategy';
    public const UPDATE_INVITATION_STRATEGY = 'update invitation strategy';
    public const UPDATE_MESSAGE_STRATEGY = 'update message strategy';
    public const UPDATE_MODERATOR_STRATEGY = 'update moderator strategy';

    public const DELETE_CHANNEL_STRATEGY = 'delete channel strategy';
    public const DELETE_INVITATION_STRATEGY = 'delete invitation strategy';
    public const DELETE_MESSAGE_STRATEGY = 'delete message strategy';
    public const DELETE_MODERATOR_STRATEGY = 'delete moderator strategy';

    public const FIND_MESSAGES_STRATEGY = 'find messages strategy';
    public const FIND_INVITATIONS_STRATEGY = 'find invitations strategy';
    public const FIND_CHANNELS_STRATEGY = 'find channels strategy';

    public const FIND_MODERATORS_BY_CHANNEL_STRATEGY = 'find moderators by channel strategy';
    public const FIND_CHANNELS_BY_MODERATOR_STRATEGY = 'find channels by moderator strategy';

    public const FIND_CHANNELS_WHEN_I_AM_CREATOR_STRATEGY = 'find channels when i am creator strategy';
}
