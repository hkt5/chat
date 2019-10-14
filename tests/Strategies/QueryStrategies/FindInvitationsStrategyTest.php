<?php


use App\Channel;
use App\Invitation;
use App\Strategies\QueryStrategies\FindChannelsStrategy;
use App\Strategies\QueryStrategies\FindInvitationsStrategy;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\WithoutEvents;
use Laravel\Lumen\Testing\WithoutMiddleware;

class FindInvitationsStrategyTest extends TestCase
{

    use WithoutEvents;
    use WithoutMiddleware;
    use DatabaseMigrations;

    private $strategy;

    public function setUp(): void
    {
        parent::setUp();

        $channel = new Channel();
        $channel->__set('id', 1);
        $channel->__set('name', 'my-channel');
        $channel->__set('creator_id', 1);
        $channel->save();

        $invitation = new Invitation();
        $invitation->__set('id', 1);
        $invitation->__set('channel_id', 1);
        $invitation->__set('user_id', 2);
        $invitation->__set('confirmed', false);
        $invitation->save();

        $this->strategy = new FindInvitationsStrategy();
    }

    public function testFindInvitationsStrategy() : void
    {

        // given
        $id = 2;

        // when
        $result = $this->strategy->findById($id);
        $result_data = json_decode($result->content(), true);

        // then
        $this->assertEquals(Response::HTTP_OK, $result->status());
        $this->assertTrue(!empty($result_data['content']['invitations']));
    }

    public function testFindInvitationsStrategyWhenUserNotExisting() : void
    {

        // given
        $id = 1;

        // when
        $result = $this->strategy->findById($id);
        $result_data = json_decode($result->content(), true);

        // then
        $this->assertEquals(Response::HTTP_OK, $result->status());
        $this->assertTrue(empty($result_data['content']['channels']));
    }

    public function testFindInvitationsStrategyWhenOnlyConfirmedInvitationsExisting() : void
    {

        // given
        $id = 1;
        $invitation = Invitation::find(1);
        $invitation->__set('confirmed', true);
        $invitation->update();

        // when
        $result = $this->strategy->findById($id);
        $result_data = json_decode($result->content(), true);

        // then
        $this->assertEquals(Response::HTTP_OK, $result->status());
        $this->assertTrue(empty($result_data['content']['channels']));
    }
}
