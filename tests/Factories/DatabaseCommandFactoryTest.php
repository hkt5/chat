<?php


use App\Factories\DatabaseCommandFactory;
use App\Factories\DatabaseOperationConstants;
use App\Strategies\CommandStrategies\CreateChannelStrategy;
use App\Strategies\CommandStrategies\CreateInvitationStrategy;
use App\Strategies\CommandStrategies\CreateMessageStrategy;
use App\Strategies\CommandStrategies\CreateModeratorStrategy;
use App\Strategies\CommandStrategies\DeleteChannelStrategy;
use App\Strategies\CommandStrategies\DeleteInvitationStrategy;
use App\Strategies\CommandStrategies\DeleteMessageStrategy;
use App\Strategies\CommandStrategies\DeleteModeratorStrategy;
use App\Strategies\CommandStrategies\UpdateChannelStrategy;
use App\Strategies\CommandStrategies\UpdateInvitationStrategy;
use App\Strategies\CommandStrategies\UpdateMessageStrategy;
use App\Strategies\CommandStrategies\UpdateModeratorStrategy;

class DatabaseCommandFactoryTest extends TestCase
{

    private $factory;

    public function setUp(): void
    {
        parent::setUp();
        $this->factory = new DatabaseCommandFactory();
    }

    public function testInstanceOfCreateChannelStrategy() : void
    {

        // given
        $constant = DatabaseOperationConstants::CREATE_CHANNEL_STRATEGY;

        // when
        $this->factory->getInstance($constant);
        $instance = $this->factory->strategy;

        // then
        $this->assertTrue($instance instanceof CreateChannelStrategy);
    }

    public function testInstanceOfCreateInvitationStrategy() : void
    {

        // given
        $constant = DatabaseOperationConstants::CREATE_INVITATION_STRATEGY;

        // when
        $this->factory->getInstance($constant);
        $instance = $this->factory->strategy;

        // then
        $this->assertTrue($instance instanceof CreateInvitationStrategy);
    }

    public function testInstanceOfCreateMessageStrategy() : void
    {

        // given
        $constant = DatabaseOperationConstants::CREATE_MESSAGE_STRATEGY;

        // when
        $this->factory->getInstance($constant);
        $instance = $this->factory->strategy;

        // then
        $this->assertTrue($instance instanceof CreateMessageStrategy);
    }

    public function testInstanceOfCreateModeratorStrategy() : void
    {

        // given
        $constant = DatabaseOperationConstants::CREATE_MODERATOR_STRATEGY;

        // when
        $this->factory->getInstance($constant);
        $instance = $this->factory->strategy;

        // then
        $this->assertTrue($instance instanceof CreateModeratorStrategy);
    }

    public function testInstanceOfUpdateChannelStrategy() : void
    {

        // given
        $constant = DatabaseOperationConstants::UPDATE_CHANNEL_STRATEGY;

        // when
        $this->factory->getInstance($constant);
        $instance = $this->factory->strategy;

        // then
        $this->assertTrue($instance instanceof UpdateChannelStrategy);
    }

    public function testInstanceOfUpdateInvitationStrategy() : void
    {

        // given
        $constant = DatabaseOperationConstants::UPDATE_INVITATION_STRATEGY;

        // when
        $this->factory->getInstance($constant);
        $instance = $this->factory->strategy;

        // then
        $this->assertTrue($instance instanceof UpdateInvitationStrategy);
    }

    public function testInstanceOfUpdateMessageStrategy() : void
    {

        // given
        $constant = DatabaseOperationConstants::UPDATE_MESSAGE_STRATEGY;

        // when
        $this->factory->getInstance($constant);
        $instance = $this->factory->strategy;

        // then
        $this->assertTrue($instance instanceof UpdateMessageStrategy);
    }

    public function testInstanceOfUpdateModeratorStrategy() : void
    {

        // given
        $constant = DatabaseOperationConstants::UPDATE_MODERATOR_STRATEGY;

        // when
        $this->factory->getInstance($constant);
        $instance = $this->factory->strategy;

        // then
        $this->assertTrue($instance instanceof UpdateModeratorStrategy);
    }

    public function testInstanceOfDeleteChannelStrategy() : void
    {

        // given
        $constant = DatabaseOperationConstants::DELETE_CHANNEL_STRATEGY;

        // when
        $this->factory->getInstance($constant);
        $instance = $this->factory->strategy;

        // then
        $this->assertTrue($instance instanceof DeleteChannelStrategy);
    }

    public function testInstanceOfDeleteInvitationStrategy() : void
    {

        // given
        $constant = DatabaseOperationConstants::DELETE_INVITATION_STRATEGY;

        // when
        $this->factory->getInstance($constant);
        $instance = $this->factory->strategy;

        // then
        $this->assertTrue($instance instanceof DeleteInvitationStrategy);
    }

    public function testInstanceOfDeleteMessageStrategy() : void
    {

        // given
        $constant = DatabaseOperationConstants::DELETE_MESSAGE_STRATEGY;

        // when
        $this->factory->getInstance($constant);
        $instance = $this->factory->strategy;

        // then
        $this->assertTrue($instance instanceof DeleteMessageStrategy);
    }

    public function testInstanceOfDeleteModeratorStrategy() : void
    {

        // given
        $constant = DatabaseOperationConstants::DELETE_MODERATOR_STRATEGY;

        // when
        $this->factory->getInstance($constant);
        $instance = $this->factory->strategy;

        // then
        $this->assertTrue($instance instanceof DeleteModeratorStrategy);
    }
}
