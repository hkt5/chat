<?php


use App\Channel;
use App\Helpers\MockingRequest;
use App\Strategies\CommandStrategies\CreateModeratorStrategy;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\WithoutEvents;
use Laravel\Lumen\Testing\WithoutMiddleware;

class CreateModeratorStrategyTest extends TestCase
{

    use WithoutMiddleware;
    use WithoutEvents;
    use DatabaseMigrations;

    private $strategy;

    public function setUp(): void
    {
        parent::setUp();
        $channel = new Channel();
        $channel->__set('id', 1);
        $channel->__set('name', 'channel-name');
        $channel->__set('creator_id', 1);
        $channel->save();

        $this->strategy = new CreateModeratorStrategy();
    }

    public function testCreateModerator() : void
    {

        // given
        $data = [
            'method' => 'post', 'uri' => '/login/email', 'parameters' => [
                'channel_id' => 1,
                'user_id' => 1,
            ], 'server' => [], 'cookies' => [], 'files' => [], 'content' => ''
        ];
        $request = MockingRequest::createRequest($data);
        $response = [
            'content' => [
                'moderator' => [
                    'id' => 1, 'user_id' => 1, 'channel_id' => 1,
                ],
            ], 'error_messages' => [],
        ];

        // when
        $result = $this->strategy->command($request);
        $result_data = json_decode($result->content(), true);

        // then
        $this->assertEquals(Response::HTTP_OK, $result->status());
        $this->assertEquals($response, $result_data);
    }

    public function testCreateModeratorWhenChannelIdFieldIsEmpty() : void
    {

        // given
        $data = [
            'method' => 'post', 'uri' => '/login/email', 'parameters' => [
                'user_id' => 1,
            ], 'server' => [], 'cookies' => [], 'files' => [], 'content' => ''
        ];
        $request = MockingRequest::createRequest($data);
        $response = [
            'content' => [], 'error_messages' => ['channel_id' => ['0' => 'The channel id field is required.'],],
        ];

        // when
        $result = $this->strategy->command($request);
        $result_data = json_decode($result->content(), true);

        // then
        $this->assertEquals(Response::HTTP_BAD_REQUEST, $result->status());
        $this->assertEquals($response, $result_data);
    }

    public function testCreateModeratorWhenUserIdFieldIsEmpty() : void
    {

        // given
        $data = [
            'method' => 'post', 'uri' => '/login/email', 'parameters' => [
                'channel_id' => 1,
            ], 'server' => [], 'cookies' => [], 'files' => [], 'content' => ''
        ];
        $request = MockingRequest::createRequest($data);
        $response = [
            'content' => [], 'error_messages' => ['user_id' => ['0' => 'The user id field is required.'],],
        ];

        // when
        $result = $this->strategy->command($request);
        $result_data = json_decode($result->content(), true);

        // then
        $this->assertEquals(Response::HTTP_BAD_REQUEST, $result->status());
        $this->assertEquals($response, $result_data);
    }

    public function testCreateModeratorWhenChannelNotExisting() : void
    {

        // given
        $data = [
            'method' => 'post', 'uri' => '/login/email', 'parameters' => [
                'channel_id' => 2,
                'user_id' => 1,
            ], 'server' => [], 'cookies' => [], 'files' => [], 'content' => ''
        ];
        $request = MockingRequest::createRequest($data);
        $response = [
            'content' => [], 'error_messages' => ['channel_id' => ['0' => 'The selected channel id is invalid.'],],
        ];

        // when
        $result = $this->strategy->command($request);
        $result_data = json_decode($result->content(), true);

        // then
        $this->assertEquals(Response::HTTP_BAD_REQUEST, $result->status());
        $this->assertEquals($response, $result_data);
    }

    public function testCreateModeratorWhenChannelIdIsNotInt() : void
    {

        // given
        $data = [
            'method' => 'post', 'uri' => '/login/email', 'parameters' => [
                'channel_id' => 'hello',
                'user_id' => 1,
            ], 'server' => [], 'cookies' => [], 'files' => [], 'content' => ''
        ];
        $request = MockingRequest::createRequest($data);
        $response = [
            'content' => [], 'error_messages' => ['channel_id' => ['0' => 'The channel id must be an integer.'],],
        ];

        // when
        $result = $this->strategy->command($request);
        $result_data = json_decode($result->content(), true);

        // then
        $this->assertEquals(Response::HTTP_BAD_REQUEST, $result->status());
        $this->assertEquals($response, $result_data);
    }

    public function testCreateModeratorWhenUserIdIsNotInt() : void
    {

        // given
        $data = [
            'method' => 'post', 'uri' => '/login/email', 'parameters' => [
                'channel_id' => 1,
                'user_id' => 'hello',
            ], 'server' => [], 'cookies' => [], 'files' => [], 'content' => ''
        ];
        $request = MockingRequest::createRequest($data);
        $response = [
            'content' => [], 'error_messages' => ['user_id' => ['0' => 'The user id must be an integer.'],],
        ];

        // when
        $result = $this->strategy->command($request);
        $result_data = json_decode($result->content(), true);

        // then
        $this->assertEquals(Response::HTTP_BAD_REQUEST, $result->status());
        $this->assertEquals($response, $result_data);
    }
}
