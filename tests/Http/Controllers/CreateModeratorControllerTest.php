<?php


use App\Channel;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\WithoutEvents;
use Laravel\Lumen\Testing\WithoutMiddleware;

class CreateModeratorControllerTest extends TestCase
{

    use WithoutEvents;
    use WithoutMiddleware;
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();

        $channel = new Channel();
        $channel->__set('id', 1);
        $channel->__set('name', 'channel');
        $channel->__set('creator_id', 1);
        $channel->save();
    }

    public function testCreateModerator() : void
    {

        // given
        $data = [
            'channel_id' => 1,
            'user_id' => 1,
        ];
        $response = [
            'content' => [
                'moderator' => [
                    'id' => 1, 'channel_id' => 1, 'user_id' => 1,
                ],
            ], 'error_messages' => [],
        ];

        // when
        $result = $this->post('/moderators', $data);

        // then
        $result->seeStatusCode(Response::HTTP_OK);
        $result->seeJson($response);
    }

    public function testCreateModeratorWhenChannelIdNotExists() : void
    {

        // given
        $data = [
            'channel_id' => 2,
            'user_id' => 1,
        ];
        $response = [
            'content' => [], 'error_messages' => ['channel_id' => ['0' => 'The selected channel id is invalid.']],
        ];

        // when
        $result = $this->post('/moderators', $data);

        // then
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $result->seeJson($response);
    }

    public function testCreateModeratorWhenChannelIdFieldIsEmpty() : void
    {

        // given
        $data = [
            'user_id' => 1,
        ];
        $response = [
            'content' => [], 'error_messages' => ['channel_id' => ['0' => 'The channel id field is required.'],],
        ];

        // when
        $result = $this->post('/moderators', $data);

        // then
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $result->seeJson($response);
    }

    public function testCreateModeratorWhenUserIdFieldIsEmpty() : void
    {

        // given
        $data = [
            'channel_id' => 1,
        ];
        $response = [
            'content' => [], 'error_messages' => ['user_id' => ['0' => 'The user id field is required.'],],
        ];

        // when
        $result = $this->post('/moderators', $data);

        // then
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $result->seeJson($response);
    }

    public function testCreateModeratorWhenChannelIdIsNotInt() : void
    {

        // given
        $data = [
            'channel_id' => 'hello',
            'user_id' => 1,
        ];
        $response = [
            'content' => [], 'error_messages' => ['channel_id' => ['0' => 'The channel id must be an integer.'],],
        ];

        // when
        $result = $this->post('/moderators', $data);

        // then
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $result->seeJson($response);
    }

    public function testCreateModeratorWhenUserIdIsNotInt() : void
    {

        // given
        $data = [
            'channel_id' => 1,
            'user_id' => 'hello',
        ];
        $response = [
            'content' => [], 'error_messages' => ['user_id' => ['0' => 'The user id must be an integer.'],],
        ];

        // when
        $result = $this->post('/moderators', $data);

        // then
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $result->seeJson($response);
    }
}
