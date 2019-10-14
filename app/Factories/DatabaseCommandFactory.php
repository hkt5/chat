<?php


namespace App\Factories;


use App\Strategies\CommandStrategies\CreateChannelStrategy;
use App\Strategies\CommandStrategies\CreateInvitationStrategy;
use App\Strategies\CommandStrategies\CreateMessageStrategy;
use App\Strategies\CommandStrategies\DeleteChannelStrategy;
use App\Strategies\CommandStrategies\DeleteInvitationStrategy;
use App\Strategies\CommandStrategies\DeleteMessageStrategy;
use App\Strategies\CommandStrategies\UpdateChannelStrategy;
use App\Strategies\CommandStrategies\UpdateInvitationStrategy;
use App\Strategies\CommandStrategies\UpdateMessageStrategy;

class DatabaseCommandFactory implements ImplementsStrategyInterface
{

    public $strategy;

    public function getInstance(string $strategy) {

        switch ($strategy) {

            case DatabaseOperationConstants::CREATE_CHANNEL_STRATEGY:
                $this->strategy = new CreateChannelStrategy();
                break;
            case DatabaseOperationConstants::CREATE_INVITATION_STRATEGY:
                $this->strategy = new CreateInvitationStrategy();
                break;
            case DatabaseOperationConstants::CREATE_MESSAGE_STRATEGY:
                $this->strategy = new CreateMessageStrategy();
                break;
            case DatabaseOperationConstants::UPDATE_CHANNEL_STRATEGY:
                $this->strategy = new UpdateChannelStrategy();
                break;
            case DatabaseOperationConstants::UPDATE_INVITATION_STRATEGY:
                $this->strategy = new UpdateInvitationStrategy();
                break;
            case DatabaseOperationConstants::UPDATE_MESSAGE_STRATEGY:
                $this->strategy = new UpdateMessageStrategy();
                break;
            case DatabaseOperationConstants::DELETE_CHANNEL_STRATEGY:
                $this->strategy = new DeleteChannelStrategy();
                break;
            case DatabaseOperationConstants::DELETE_INVITATION_STRATEGY:
                $this->strategy = new DeleteInvitationStrategy();
                break;
            case DatabaseOperationConstants::DELETE_MESSAGE_STRATEGY:
                $this->strategy = new DeleteMessageStrategy();
                break;
        }
    }
}
