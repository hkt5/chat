<?php


use App\Factories\DatabaseOperationConstants;
use App\Factories\DatabaseQueryFactory;
use App\Strategies\QueryStrategies\FindChannelsStrategy;
use App\Strategies\QueryStrategies\FindInvitationsStrategy;
use App\Strategies\QueryStrategies\FindMessagesStrategy;

class DatabaseQueryFactoryTest extends TestCase
{

    private $factory;

    public function setUp(): void
    {
        parent::setUp();
        $this->factory = new DatabaseQueryFactory();
    }

    public function testInstanceOfFindChannels() : void
    {

        // given
        $constant = DatabaseOperationConstants::FIND_CHANNELS_STRATEGY;

        // when
        $this->factory->getInstance($constant);
        $instance = $this->factory->strategy;

        // then
        $this->assertTrue($instance instanceof FindChannelsStrategy);
    }

    public function testInstanceOfFindChannelsWhenImCreator() : void
    {

        // given
        $constant = DatabaseOperationConstants::FIND_CHANNELS_WHEN_I_AM_CREATOR_STRATEGY;

        // when
        $this->factory->getInstance($constant);
        $instance = $this->factory->strategy;

        // then
        $this->assertTrue($instance instanceof \App\Strategies\QueryStrategies\FindChannelsWhenIAmCreatorStrategy);
    }

    public function testInstanceOfFindInvitations() : void
    {

        // given
        $constant = DatabaseOperationConstants::FIND_INVITATIONS_STRATEGY;

        // when
        $this->factory->getInstance($constant);
        $instance = $this->factory->strategy;

        // then
        $this->assertTrue($instance instanceof FindInvitationsStrategy);
    }

    public function testInstanceOfFindMessages() : void
    {

        // given
        $constant = DatabaseOperationConstants::FIND_MESSAGES_STRATEGY;

        // when
        $this->factory->getInstance($constant);
        $instance = $this->factory->strategy;

        // then
        $this->assertTrue($instance instanceof FindMessagesStrategy);
    }
}
