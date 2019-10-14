<?php


namespace App\Factories;


use App\Strategies\QueryStrategies\FindChannelsStrategy;
use App\Strategies\QueryStrategies\FindChannelsWhenIAmCreatorStrategy;
use App\Strategies\QueryStrategies\FindInvitationsStrategy;
use App\Strategies\QueryStrategies\FindMessagesStrategy;

class DatabaseQueryFactory implements ImplementsStrategyInterface
{

    public $strategy;

    public function getInstance(string $strategy)
    {
        switch ($strategy) {

            case DatabaseOperationConstants::FIND_CHANNELS_STRATEGY:
                $this->strategy = new FindChannelsStrategy();
                break;
            case DatabaseOperationConstants::FIND_CHANNELS_WHEN_I_AM_CREATOR_STRATEGY:
                $this->strategy = new FindChannelsWhenIAmCreatorStrategy();
                break;
            case DatabaseOperationConstants::FIND_INVITATIONS_STRATEGY:
                $this->strategy = new FindInvitationsStrategy();
                break;
            case DatabaseOperationConstants::FIND_MESSAGES_STRATEGY:
                $this->strategy = new FindMessagesStrategy();
                break;
        }
    }
}
