<?php


use App\Message;
use App\Channel;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\WithoutEvents;
use Laravel\Lumen\Testing\WithoutMiddleware;

class UpdateMessageControllerTest extends TestCase
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
    }

    public function testUpdateMessage() : void
    {

        // given
        $data = [
            'id' => 1,
            'user_id' => 1,
            'channel_id' => 1,
            'message' => 'Hello World',
        ];

        // when
        $result = $this->put('/messages', $data);

        //then
        $result->seeStatusCode(Response::HTTP_OK);
    }

    public function testUpdateMessageWhenIdFieldIsEmpty() : void
    {

        // given
        $data = [
            'user_id' => 1,
            'channel_id' => 1,
            'message' => 'Hello World',
        ];
        $response = [
            'content' => [], 'error_messages' => [
                'id' => [
                    '0' => 'The id field is required.',
                ],
            ],
        ];

        // when
        $result = $this->put('/messages', $data);

        //then
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $result->seeJson($response);
    }

    public function testUpdateMessageWhenIdNotExisting() : void
    {

        // given
        $data = [
            'id' => 2,
            'user_id' => 1,
            'channel_id' => 1,
            'message' => 'Hello World',
        ];
        $response = [
            'content' => [], 'error_messages' => [
                'id' => [
                    '0' => 'The selected id is invalid.',
                ],
            ],
        ];

        // when
        $result = $this->put('/messages', $data);

        //then
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $result->seeJson($response);
    }

    public function testUpdateMessageWhenUserIdFieldIsEmpty() : void
    {

        // given
        $data = [
            'id' => 1,
            'channel_id' => 1,
            'message' => 'Hello World',
        ];
        $response = [
            'content' => [], 'error_messages' => [
                'user_id' => [
                    '0' => 'The user id field is required.',
                ],
            ],
        ];

        // when
        $result = $this->put('/messages', $data);

        //then
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $result->seeJson($response);
    }

    public function testUpdateMessageWhenChannelIdFieldIsEmpty() : void
    {

        // given
        $data = [
            'id' => 1,
            'user_id' => 1,
            'message' => 'Hello World',
        ];
        $response = [
            'content' => [], 'error_messages' => [
                'channel_id' => [
                    '0' => 'The channel id field is required.'
                ],
            ],
        ];

        // when
        $result = $this->put('/messages', $data);

        //then
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $result->seeJson($response);
    }

    public function testUpdateMessageWhenChannelIdNotExisting() : void
    {

        // given
        $data = [
            'id' => 1,
            'user_id' => 1,
            'channel_id' => 2,
            'message' => 'Hello World',
        ];
        $response = [
            'content' => [], 'error_messages' => [
                'channel_id' => [
                    '0' => 'The selected channel id is invalid.',
                ],
            ],
        ];

        // when
        $result = $this->put('/messages', $data);

        //then
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $result->seeJson($response);
    }

    public function testUpdateMessageWhenMessageFieldIsEmpty() : void
    {

        // given
        $data = [
            'id' => 1,
            'user_id' => 1,
            'channel_id' => 1,
        ];
        $response = [
            'content' => [], 'error_messages' => [
                'message' => [
                    '0' => 'The message field is required.'
                ],
            ],
        ];
        // when
        $result = $this->put('/messages', $data);

        //then
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $result->seeJson($response);
    }
}
