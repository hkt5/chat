<?php


use App\Channel;
use App\Moderator;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\WithoutEvents;
use Laravel\Lumen\Testing\WithoutMiddleware;

class UpdateModeratorControllerTest extends TestCase
{

    use WithoutEvents;
    use WithoutMiddleware;
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();

        $channel = new Channel();
        $channel->__set('id', 1);
        $channel->__set('name', 'hello');
        $channel->__set('creator_id', 1);
        $channel->save();

        $moderator = new Moderator();
        $moderator->__set('id', 1);
        $moderator->__set('user_id', 1);
        $moderator->__set('channel_id', 1);
        $moderator->save();
    }

    public function testUpdateModerator() : void
    {

        // given
        $data = [
            'id' => 1,
            'user_id' => 1,
            'channel_id' => 1,
        ];

        $response = [
            'content' => [
                'moderator' => [
                    'id' => 1, 'channel_id' => 1, 'user_id' => 1, 'created_at' => null, 'updated_at' => null
                ]
            ], 'error_messages' => [],
        ];

        // when
        $result = $this->put('/moderators', $data);

        //then
        $result->seeStatusCode(Response::HTTP_OK);
        $this->seeJson($response);
    }

    public function testUpdateModeratorWhenIdFieldIsEmpty() : void
    {

        // given
        $data = [
            'user_id' => 1,
            'channel_id' => 1,
        ];

        $response = [
            'content' => [], 'error_messages' => [
                'id' => ['0' => 'The id field is required.'],
                ],
        ];

        // when
        $result = $this->put('/moderators', $data);

        //then
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $this->seeJson($response);
    }

    public function testUpdateModeratorWhenIdIsNotInteger() : void
    {

        // given
        $data = [
            'id' => 'hello',
            'user_id' => 1,
            'channel_id' => 1,
        ];

        $response = [
            'content' => [], 'error_messages' => [
                'id' => ['0' => 'The id must be an integer.'],
            ],
        ];

        // when
        $result = $this->put('/moderators', $data);

        //then
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $this->seeJson($response);
    }

    public function testUpdateModeratorWhenIdIsNotExisting() : void
    {

        // given
        $data = [
            'id' => 2,
            'user_id' => 1,
            'channel_id' => 1,
        ];

        $response = [
            'content' => [], 'error_messages' => [
                'id' => ['0' => 'The selected id is invalid.'],
            ],
        ];

        // when
        $result = $this->put('/moderators', $data);

        //then
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $this->seeJson($response);
    }

    public function testUpdateModeratorWhenUserIdFieldIsEmpty() : void
    {

        // given
        $data = [
            'id' => 1,
            'channel_id' => 1,
        ];

        $response = [
            'content' => [], 'error_messages' => [
                'user_id' => ['0' => 'The user id field is required.'],
            ],
        ];

        // when
        $result = $this->put('/moderators', $data);

        //then
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $this->seeJson($response);
    }

    public function testUpdateModeratorWhenUserIdIsNotInteger() : void
    {

        // given
        $data = [
            'id' => 1,
            'user_id' => 'hello',
            'channel_id' => 1,
        ];

        $response = [
            'content' => [], 'error_messages' => [
                'user_id' => ['0' => 'The user id must be an integer.'],
            ],
        ];

        // when
        $result = $this->put('/moderators', $data);

        //then
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $this->seeJson($response);
    }

    public function testUpdateModeratorWhenChannelIdIsEmpty() : void
    {

        // given
        $data = [
            'id' => 1,
            'user_id' => 1,
        ];

        $response = [
            'content' => [], 'error_messages' => [
                'channel_id' => ['0' => 'The channel id field is required.'],
            ],
        ];

        // when
        $result = $this->put('/moderators', $data);

        //then
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $this->seeJson($response);
    }

    public function testUpdateModeratorWhenChannelIdIsNotInteger() : void
    {

        // given
        $data = [
            'id' => 1,
            'user_id' => 1,
            'channel_id' => 'hello',
        ];

        $response = [
            'content' => [], 'error_messages' => [
                'channel_id' => ['0' => 'The channel id must be an integer.'],
            ],
        ];

        // when
        $result = $this->put('/moderators', $data);

        //then
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $this->seeJson($response);
    }

    public function testUpdateModeratorWhenChannelIdNotExisits() : void
    {

        // given
        $data = [
            'id' => 1,
            'user_id' => 1,
            'channel_id' => 2,
        ];

        $response = [
            'content' => [], 'error_messages' => [
                'channel_id' => ['0' => 'The selected channel id is invalid.'],
            ],
        ];

        // when
        $result = $this->put('/moderators', $data);

        //then
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $this->seeJson($response);
    }
}
