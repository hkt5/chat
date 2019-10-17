<?php


use App\Channel;
use App\Helpers\MockingRequest;
use App\Moderator;
use App\Strategies\CommandStrategies\UpdateModeratorStrategy;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\WithoutEvents;
use Laravel\Lumen\Testing\WithoutMiddleware;

class UpdateModeratorStrategyTest extends TestCase
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
        $channel->__set('name', 'channel');
        $channel->__set('creator_id', 1);
        $channel->save();

        $moderator = new Moderator();
        $moderator->__set('id', 1);
        $moderator->__set('user_id', 1);
        $moderator->__set('channel_id', 1);
        $moderator->save();

        $this->strategy = new UpdateModeratorStrategy();
    }

    public function testUpdateStrategy() : void
    {

        // given
        $data = [
            'method' => 'post', 'uri' => '/login/email', 'parameters' => [
                'id' => 1,
                'channel_id' => 1,
                'user_id' => 1,
            ], 'server' => [], 'cookies' => [], 'files' => [], 'content' => ''
        ];
        $request = MockingRequest::createRequest($data);
        $response = [
            'content' => [
                'moderator' => [
                    'id' => 1, 'channel_id' => 1, 'user_id' => 1, 'created_at' => null, 'updated_at' => null,
                    ],
                ], 'error_messages' => [],
        ];

        // when
        $result = $this->strategy->command($request);

        // then
        $this->assertEquals(Response::HTTP_OK, $result->status());
        $this->assertEquals(json_encode($response), $result->content());
    }

    public function testUpdateStrategyWhenIdFieldIsEmpty() : void
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
            'content' => [], 'error_messages' => ['id' => ['The id field is required.']],
        ];

        // when
        $result = $this->strategy->command($request);

        // then
        $this->assertEquals(Response::HTTP_BAD_REQUEST, $result->status());
        $this->assertEquals(json_encode($response), $result->content());
    }

    public function testUpdateStrategyWhenIdNotExiting() : void
    {

        // given
        $data = [
            'method' => 'post', 'uri' => '/login/email', 'parameters' => [
                'id' => 2,
                'channel_id' => 1,
                'user_id' => 1,
            ], 'server' => [], 'cookies' => [], 'files' => [], 'content' => ''
        ];
        $request = MockingRequest::createRequest($data);
        $response = [
            'content' => [], 'error_messages' => ['id' => ['The selected id is invalid.']],
        ];

        // when
        $result = $this->strategy->command($request);

        // then
        $this->assertEquals(Response::HTTP_BAD_REQUEST, $result->status());
        $this->assertEquals(json_encode($response), $result->content());
    }

    public function testUpdateStrategyWhenChannelIdFieldIsEmpty() : void
    {

        // given
        $data = [
            'method' => 'post', 'uri' => '/login/email', 'parameters' => [
                'id' => 1,
                'user_id' => 1,
            ], 'server' => [], 'cookies' => [], 'files' => [], 'content' => ''
        ];
        $request = MockingRequest::createRequest($data);
        $response = [
            'content' => [], 'error_messages' => ['channel_id' => ['The channel id field is required.']],
        ];

        // when
        $result = $this->strategy->command($request);

        // then
        $this->assertEquals(Response::HTTP_BAD_REQUEST, $result->status());
        $this->assertEquals(json_encode($response), $result->content());
    }

    public function testUpdateStrategyWhenChannelIdNotExiting() : void
    {

        // given
        $data = [
            'method' => 'post', 'uri' => '/login/email', 'parameters' => [
                'id' => 1,
                'channel_id' => 2,
                'user_id' => 1,
            ], 'server' => [], 'cookies' => [], 'files' => [], 'content' => ''
        ];
        $request = MockingRequest::createRequest($data);
        $response = [
            'content' => [], 'error_messages' => ['channel_id' => ['The selected channel id is invalid.']],
        ];

        // when
        $result = $this->strategy->command($request);

        // then
        $this->assertEquals(Response::HTTP_BAD_REQUEST, $result->status());
        $this->assertEquals(json_encode($response), $result->content());
    }

    public function testUpdateStrategyWhenUserIdFieldIsEmpty() : void
    {

        // given
        $data = [
            'method' => 'post', 'uri' => '/login/email', 'parameters' => [
                'id' => 1,
                'channel_id' => 1,
            ], 'server' => [], 'cookies' => [], 'files' => [], 'content' => ''
        ];
        $request = MockingRequest::createRequest($data);
        $response = [
            'content' => [], 'error_messages' => ['user_id' => ['The user id field is required.']],
        ];

        // when
        $result = $this->strategy->command($request);

        // then
        $this->assertEquals(Response::HTTP_BAD_REQUEST, $result->status());
        $this->assertEquals(json_encode($response), $result->content());
    }
}
