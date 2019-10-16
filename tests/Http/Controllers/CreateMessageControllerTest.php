<?php


use App\Channel;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\WithoutEvents;
use Laravel\Lumen\Testing\WithoutMiddleware;

class CreateMessageControllerTest extends TestCase
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
    }

    public function testCreateMessage() : void
    {

        // given
        $data = [
            'user_id' => 1,
            'channel_id' => 1,
            'message' => 'Hello world.'
        ];

        // when
        $result = $this->post('/messages', $data);

        // then
        $result->seeStatusCode(Response::HTTP_OK);
        $result->seeJsonContains(['user_id' => 1]);
        $result->seeJsonContains(['channel_id' => 1]);
        $result->seeJsonContains(['message' => 'Hello world.']);
    }

    public function testCreateMessageWhenUserIdFieldIsEmpty() : void
    {

        // given
        $data = [
            'channel_id' => 1,
            'message' => 'Hello world.'
        ];
        $response = [
            'content' => [], 'error_messages' => [
                'user_id' => [
                    '0' => 'The user id field is required.',
                ],
            ],
        ];

        // when
        $result = $this->post('/messages', $data);

        // then
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $result->seeJson($response);
    }

    public function testCreateMessageWhenChannelIdFieldIsEmpty() : void
    {

        // given
        $data = [
            'user_id' => 1,
            'message' => 'Hello world.'
        ];
        $response = [
            'content' => [], 'error_messages' => [
                'channel_id' => [
                    '0' => 'The channel id field is required.',
                ],
            ],
        ];

        // when
        $result = $this->post('/messages', $data);

        // then
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $result->seeJson($response);
    }

    public function testCreateMessageWhenMessageFieldIsEmpty() : void
    {

        // given
        $data = [
            'user_id' => 1,
            'channel_id' => 1,
        ];
        $response = [
            'content' => [], 'error_messages' => [
                'message' => [
                    '0' => 'The message field is required.',
                ],
            ],
        ];

        // when
        $result = $this->post('/messages', $data);

        // then
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $result->seeJson($response);
    }

    public function testCreateMessageWhenChannelIdNotExisting() : void
    {

        // given
        $data = [
            'user_id' => 1,
            'channel_id' => 2,
            'message' => 'Hello world.',
        ];
        $response = [
            'content' => [], 'error_messages' => [
                'channel_id' => [
                    '0' => 'The selected channel id is invalid.',
                ],
            ],
        ];

        // when
        $result = $this->post('/messages', $data);

        // then
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $result->seeJson($response);
    }

    public function testCreateMessageWhenUserIdIsNotInteger() : void
    {

        // given
        $data = [
            'user_id' => 'hello',
            'channel_id' => 1,
            'message' => 'hello',
        ];
        $response = [
            'content' => [], 'error_messages' => [
                'user_id' => [
                    '0' => 'The user id must be an integer.',
                ],
            ],
        ];

        // when
        $result = $this->post('/messages', $data);

        // then
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $result->seeJson($response);
    }

    public function testCreateMessageWhenChannelIdIsNotInteger() : void
    {

        // given
        $data = [
            'user_id' => 1,
            'channel_id' => 'hello',
            'message' => 'hello',
        ];
        $response = [
            'content' => [], 'error_messages' => [
                'channel_id' => [
                    '0' => 'The channel id must be an integer.',
                ],
            ],
        ];

        // when
        $result = $this->post('/messages', $data);

        // then
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $result->seeJson($response);
    }

    public function testCreateMessageWhenMessageIsNotString() : void
    {

        // given
        $data = [
            'user_id' => 1,
            'channel_id' => 1,
            'message' => 1,
        ];
        $response = [
            'content' => [], 'error_messages' => [
                'message' => [
                    '0' => 'The message must be a string.',
                ],
            ],
        ];

        // when
        $result = $this->post('/messages', $data);

        // then
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $result->seeJson($response);
    }
}
