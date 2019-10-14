<?php


use App\Channel;
use App\Message;
use App\Helpers\MockingRequest;
use App\Strategies\CommandStrategies\UpdateMessageStrategy;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\WithoutEvents;
use Laravel\Lumen\Testing\WithoutMiddleware;

class UpdateMessageStrategyTest extends TestCase
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

        $this->strategy = new UpdateMessageStrategy();
    }

    public function testUpdateMessage() : void
    {

        // given
        $data = [
            'method' => 'post', 'uri' => '/login/email', 'parameters' => [
                'id' => 1,
                'user_id' => 1,
                'channel_id' => 1,
                'message' => 'Hello World',
            ], 'server' => [], 'cookies' => [], 'files' => [], 'content' => ''
        ];
        $request = MockingRequest::createRequest($data);

        // when
        $result = $this->strategy->command($request);
        $result_data = json_decode($result->content(), true);

        // then
        $this->assertEquals(Response::HTTP_OK, $result->status());
        $this->assertEquals(1, $result_data['content']['message']['id']);
        $this->assertEquals(1, $result_data['content']['message']['channel_id']);
        $this->assertEquals(1, $result_data['content']['message']['user_id']);
        $this->assertEquals('Hello World', $result_data['content']['message']['message']);
    }

    public function testUpdateMessageWhenIdFieldIsEmpty() : void
    {

        // given
        $data = [
            'method' => 'post', 'uri' => '/login/email', 'parameters' => [
                'user_id' => 1,
                'channel_id' => 1,
                'message' => 'Hello World',
            ], 'server' => [], 'cookies' => [], 'files' => [], 'content' => ''
        ];
        $request = MockingRequest::createRequest($data);

        // when
        $result = $this->strategy->command($request);
        $result_data = json_decode($result->content(), true);

        // then
        $this->assertEquals(Response::HTTP_BAD_REQUEST, $result->status());
        $this->assertEquals('The id field is required.', $result_data['error_messages']['id']['0']);
    }

    public function testUpdateMessageWhenUserIdFieldIsEmpty() : void
    {

        // given
        $data = [
            'method' => 'post', 'uri' => '/login/email', 'parameters' => [
                'id' => 1,
                'channel_id' => 1,
                'message' => 'Hello World',
            ], 'server' => [], 'cookies' => [], 'files' => [], 'content' => ''
        ];
        $request = MockingRequest::createRequest($data);

        // when
        $result = $this->strategy->command($request);
        $result_data = json_decode($result->content(), true);

        // then
        $this->assertEquals(Response::HTTP_BAD_REQUEST, $result->status());
        $this->assertEquals('The user id field is required.', $result_data['error_messages']['user_id']['0']);
    }

    public function testUpdateMessageWhenChannelIdFieldIsEmpty() : void
    {

        // given
        $data = [
            'method' => 'post', 'uri' => '/login/email', 'parameters' => [
                'id' => 1,
                'user_id' => 1,
                'message' => 'Hello World',
            ], 'server' => [], 'cookies' => [], 'files' => [], 'content' => ''
        ];
        $request = MockingRequest::createRequest($data);

        // when
        $result = $this->strategy->command($request);
        $result_data = json_decode($result->content(), true);

        // then
        $this->assertEquals(Response::HTTP_BAD_REQUEST, $result->status());
        $this->assertEquals('The channel id field is required.', $result_data['error_messages']['channel_id']['0']);
    }

    public function testUpdateMessageWhenMessageFieldIsEmpty() : void
    {

        // given
        $data = [
            'method' => 'post', 'uri' => '/login/email', 'parameters' => [
                'id' => 1,
                'user_id' => 1,
                'channel_id' => 1,
            ], 'server' => [], 'cookies' => [], 'files' => [], 'content' => ''
        ];
        $request = MockingRequest::createRequest($data);

        // when
        $result = $this->strategy->command($request);
        $result_data = json_decode($result->content(), true);

        // then
        $this->assertEquals(Response::HTTP_BAD_REQUEST, $result->status());
        $this->assertEquals('The message field is required.', $result_data['error_messages']['message']['0']);
    }

    public function testUpdateMessageWhenChannelIdNotExisting() : void
    {

        // given
        $data = [
            'method' => 'post', 'uri' => '/login/email', 'parameters' => [
                'id' => 1,
                'channel_id' => 2,
                'user_id' => 1,
                'message' => 'Hello World',
            ], 'server' => [], 'cookies' => [], 'files' => [], 'content' => ''
        ];
        $request = MockingRequest::createRequest($data);

        // when
        $result = $this->strategy->command($request);
        $result_data = json_decode($result->content(), true);

        // then
        $this->assertEquals(Response::HTTP_BAD_REQUEST, $result->status());
        $this->assertEquals('The selected channel id is invalid.', $result_data['error_messages']['channel_id']['0']);
    }

    public function testUpdateMessageWhenIdNotExisting() : void
    {

        // given
        $data = [
            'method' => 'post', 'uri' => '/login/email', 'parameters' => [
                'id' => 2,
                'channel_id' => 1,
                'user_id' => 1,
                'message' => 'Hello World',
            ], 'server' => [], 'cookies' => [], 'files' => [], 'content' => ''
        ];
        $request = MockingRequest::createRequest($data);

        // when
        $result = $this->strategy->command($request);
        $result_data = json_decode($result->content(), true);

        // then
        $this->assertEquals(Response::HTTP_BAD_REQUEST, $result->status());
        $this->assertEquals('The selected id is invalid.', $result_data['error_messages']['id']['0']);
    }
}
