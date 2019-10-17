<?php


use App\Channel;
use App\Helpers\MockingRequest;
use App\Moderator;
use App\Strategies\CommandStrategies\DeleteModeratorStrategy;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\WithoutEvents;
use Laravel\Lumen\Testing\WithoutMiddleware;

class DeleteModeratorStrategyTest extends TestCase
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

        $this->strategy = new DeleteModeratorStrategy();
    }

    public function testDeleteModerator() : void
    {

        // given
        $data = [
            'method' => 'post', 'uri' => '/login/email', 'parameters' => [
                'id' => 1,
            ], 'server' => [], 'cookies' => [], 'files' => [], 'content' => ''
        ];
        $request = MockingRequest::createRequest($data);
        $response = [
            'content' => [
                'moderator' => [
                    'id' => 1, 'channel_id' => 1, 'user_id' => 1, 'created_at' => null, 'updated_at' => null
                ],
            ], 'error_messages' => [],
        ];

        // when
        $result = $this->strategy->command($request);

        // then
        $this->assertEquals(Response::HTTP_OK, $result->status());
        $this->assertEquals(json_encode($response), $result->content());
    }

    public function testDeleteModeratorWhenIdFieldIsEmpty() : void
    {

        // given
        $data = [
            'method' => 'post', 'uri' => '/login/email', 'parameters' => [], 'server' => [], 'cookies' => [],
            'files' => [], 'content' => ''
        ];
        $request = MockingRequest::createRequest($data);
        $response = [
            'content' => [], 'error_messages' => ['id' => ['0' => 'The id field is required.']],
        ];

        // when
        $result = $this->strategy->command($request);

        // then
        $this->assertEquals(Response::HTTP_BAD_REQUEST, $result->status());
        $this->assertEquals(json_encode($response), $result->content());
    }

    public function testDeleteModeratorWhenIdIsNotInteger() : void
    {

        // given
        $data = [
            'method' => 'post', 'uri' => '/login/email', 'parameters' => ['id' => 'hello',], 'server' => [],
            'cookies' => [], 'files' => [], 'content' => ''
        ];
        $request = MockingRequest::createRequest($data);
        $response = [
            'content' => [], 'error_messages' => ['id' => ['0' => 'The id must be an integer.']],
        ];

        // when
        $result = $this->strategy->command($request);

        // then
        $this->assertEquals(Response::HTTP_BAD_REQUEST, $result->status());
        $this->assertEquals(json_encode($response), $result->content());
    }

    public function testDeleteModeratorWhenIdNotExisting() : void
    {

        // given
        $data = [
            'method' => 'post', 'uri' => '/login/email', 'parameters' => ['id' => 2,], 'server' => [],
            'cookies' => [], 'files' => [], 'content' => ''
        ];
        $request = MockingRequest::createRequest($data);
        $response = [
            'content' => [], 'error_messages' => ['id' => ['0' => 'The selected id is invalid.']],
        ];

        // when
        $result = $this->strategy->command($request);

        // then
        $this->assertEquals(Response::HTTP_BAD_REQUEST, $result->status());
        $this->assertEquals(json_encode($response), $result->content());
    }
}
