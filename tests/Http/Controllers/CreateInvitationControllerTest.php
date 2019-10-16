<?php


use App\Channel;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\WithoutEvents;
use Laravel\Lumen\Testing\WithoutMiddleware;

class CreateInvitationControllerTest extends TestCase
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

    public function testCreateInvitation() : void
    {

        // given
        $data = [
            'user_id' => 1,
            'channel_id' => 1,
        ];

        // when
        $result = $this->post('/invitations', $data);

        // then
        $result->seeStatusCode(Response::HTTP_OK);
        $result->seeJson(['user_id' => 1]);
        $result->seeJson(['channel_id' => 1]);
    }

    public function testCreateInvitationWhenUserIdFieldIsEmpty() : void
    {

        // given
        $data = ['channel_id' => 1,];
        $response = [
            'content' => [], 'error_messages' => [
                'user_id' => [
                    '0' => 'The user id field is required.'
                ],
            ],
        ];

        // when
        $result = $this->post('/invitations', $data);

        // then
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $result->seeJson($response);
    }

    public function testCreateInvitationWhenChannelIdFieldIsEmpty() : void
    {

        // given
        $data = ['user_id' => 1,];
        $response = [
            'content' => [], 'error_messages' => [
                'channel_id' => [
                    '0' => 'The channel id field is required.',
                ],
            ],
        ];

        // when
        $result = $this->post('/invitations', $data);

        // then
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $result->seeJson($response);
    }

    public function testCreateInvitationWhenChannelIdNotExisting() : void
    {

        // given
        $data = [
            'user_id' => 1, 'channel_id' => 2,
        ];
        $response = [
            'content' => [], 'error_messages' => [
                'channel_id' => [
                    '0' => 'The selected channel id is invalid.',
                ],
            ],
        ];

        // when
        $result = $this->post('/invitations', $data);

        // then
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $result->seeJson($response);
    }

    public function testCreateInvitationWhenChannelIdIsNotInt() : void
    {

        // given
        $data = [
            'channel_id' => 'hello',
            'user_id' => 1,
        ];
        $response = [
            'content' => [], 'error_messages' => [
                'channel_id' => [
                    '0' => 'The channel id must be an integer.',
                ],
            ],
        ];

        // when
        $result = $this->post('/invitations', $data);

        // then
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $result->seeJson($response);
    }

    public function testCreateInvitationWhenUserIdIsNotInteger() : void
    {

        // given
        $data = [
            'channel_id' => 1,
            'user_id' => 'hello',
        ];
        $response = [
            'content' => [], 'error_messages' => [
                'user_id' => [
                    '0' => 'The user id must be an integer.',
                ],
            ],
        ];

        // when
        $result = $this->post('/invitations', $data);

        // then
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $result->seeJson($response);
    }
}
