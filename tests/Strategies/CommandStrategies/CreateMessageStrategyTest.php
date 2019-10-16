<?php


use App\Channel;
use App\Helpers\MockingRequest;
use App\Strategies\CommandStrategies\CreateMessageStrategy;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\WithoutEvents;
use Laravel\Lumen\Testing\WithoutMiddleware;

class CreateMessageStrategyTest extends TestCase
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

        $this->strategy = new CreateMessageStrategy();
    }

    public function testCreateMessage() : void
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
        $this->assertEquals(Response::HTTP_OK, $result->status());
        $this->assertEquals(1, $result_data['content']['message']['channel_id']);
        $this->assertEquals(1, $result_data['content']['message']['user_id']);
        $this->assertEquals('Hello World', $result_data['content']['message']['message']);
    }

    public function testCreateMessageWhenUserIdFieldIsEmpty() : void
    {

        // given
        $data = [
            'method' => 'post', 'uri' => '/login/email', 'parameters' => [
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

    public function testCreateMessageWhenChannelIdFieldIsEmpty() : void
    {

        // given
        $data = [
            'method' => 'post', 'uri' => '/login/email', 'parameters' => [
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

    public function testCreateMessageWhenMessageFieldIsEmpty() : void
    {

        // given
        $data = [
            'method' => 'post', 'uri' => '/login/email', 'parameters' => [
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

    public function testCreateMessageWhenChannelIdNotExisting() : void
    {

        // given
        $data = [
            'method' => 'post', 'uri' => '/login/email', 'parameters' => [
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

    public function testCreateMessageWhenUserIdIsNotInteger() : void
    {

        // given
        $data = [
            'method' => 'post', 'uri' => '/login/email', 'parameters' => [
                'channel_id' => 2,
                'user_id' => 'hello',
                'message' => 'Hello World',
            ], 'server' => [], 'cookies' => [], 'files' => [], 'content' => ''
        ];
        $request = MockingRequest::createRequest($data);

        // when
        $result = $this->strategy->command($request);
        $result_data = json_decode($result->content(), true);

        // then
        $this->assertEquals(Response::HTTP_BAD_REQUEST, $result->status());
        $this->assertEquals('The user id must be an integer.', $result_data['error_messages']['user_id'][0]);
    }

    public function testCreateMessageWhenChannelIdIsNotInteger() : void
    {

        // given
        $data = [
            'method' => 'post', 'uri' => '/login/email', 'parameters' => [
                'channel_id' => 'hello',
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
        $this->assertEquals('The channel id must be an integer.', $result_data['error_messages']['channel_id'][0]);
    }

    public function testCreateMessageWhenMessageIsNotString() : void
    {

        // given
        $data = [
            'method' => 'post', 'uri' => '/login/email', 'parameters' => [
                'channel_id' => 2,
                'user_id' => 1,
                'message' => 1,
            ], 'server' => [], 'cookies' => [], 'files' => [], 'content' => ''
        ];
        $request = MockingRequest::createRequest($data);

        // when
        $result = $this->strategy->command($request);
        $result_data = json_decode($result->content(), true);

        // then
        $this->assertEquals(Response::HTTP_BAD_REQUEST, $result->status());
        $this->assertEquals('The message must be a string.', $result_data['error_messages']['message'][0]);

    }
}
