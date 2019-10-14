<?php


use App\Message;
use App\Channel;
use App\Strategies\QueryStrategies\FindMessagesStrategy;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\WithoutEvents;
use Laravel\Lumen\Testing\WithoutMiddleware;

class FindMessagesStrategyTest extends TestCase
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

        $message = new Message();
        $message->__set('id', 1);
        $message->__set('channel_id', 1);
        $message->__set('user_id', 1);
        $message->__set('message', 'Hello world');
        $message->save();

        $this->strategy = new FindMessagesStrategy();
    }

    public function testFindMessages() : void
    {

        // given
        $id = 1;

        // when
        $result = $this->strategy->findById($id);
        $result_data = json_decode($result->content(), true);

        // then
        $this->assertEquals(Response::HTTP_OK, $result->status());
        $this->assertTrue(!empty($result_data['content']['messages']));
    }

    public function testFindMessagesWhenChannelNotExists() : void
    {

        // given
        $id = 2;

        // when
        $result = $this->strategy->findById($id);
        $result_data = json_decode($result, true);

        // then
        $this->assertEquals(Response::HTTP_OK, $result->status());
        $this->assertTrue(empty($result_data['content']['messages']));
    }
}
