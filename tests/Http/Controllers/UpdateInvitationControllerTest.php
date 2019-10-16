<?php


use App\Channel;
use App\Invitation;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\WithoutEvents;
use Laravel\Lumen\Testing\WithoutMiddleware;

class UpdateInvitationControllerTest extends TestCase
{

    use WithoutEvents;
    use WithoutMiddleware;
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();

        $channel = new Channel();
        $channel->__set('id', 1);
        $channel->__set('name', 'my-channel');
        $channel->__set('creator_id', 1);
        $channel->save();

        $invitation = new Invitation();
        $invitation->__set('id', 1);
        $invitation->__set('channel_id', 1);
        $invitation->__set('user_id', 2);
        $invitation->__set('confirmed', false);
        $invitation->save();
    }

    public function testUpdateInvitation() : void
    {

        // given
        $data = [
            'id' => 1,
            'channel_id' => 1,
            'user_id' => 2,
            'confirmed' => true,
        ];

        // when
        $result = $this->put('/invitations', $data);

        // then
        $result->seeStatusCode(Response::HTTP_OK);
    }

    public function testUpdateInvitationWhenIdFieldIsEmpty() : void
    {

        // given
        $data = [
            'channel_id' => 1,
            'user_id' => 2,
            'confirmed' => true,
        ];
        $response = [
            'content' => [], 'error_messages' => [
                'id' => [
                    '0' => 'The id field is required.',
                ],
            ],
        ];

        // when
        $result = $this->put('/invitations', $data);

        // then
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $result->seeJson($response);
    }

    public function testUpdateInvitationWhenIdNotExists() : void
    {

        // given
        $data = [
            'id' => 2,
            'channel_id' => 1,
            'user_id' => 2,
            'confirmed' => true,
        ];
        $response = [
            'content' => [], 'error_messages' => [
                'id' => [
                    '0' => 'The selected id is invalid.'
                ],
            ],
        ];

        // when
        $result = $this->put('/invitations', $data);

        // then
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $result->seeJson($response);
    }

    public function testUpdateInvitationWhenChannelIdFieldIsEmpty() : void
    {

        // given
        $data = [
            'id' => 1,
            'user_id' => 2,
            'confirmed' => true,
        ];
        $response = [
            'content' => [], 'error_messages' => [
                'channel_id' => [
                    '0' => 'The channel id field is required.',
                ],
            ],
        ];

        // when
        $result = $this->put('/invitations', $data);

        // then
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $result->seeJson($response);
    }

    public function testUpdateInvitationWhenChannelIdNotExists() : void
    {

        // given
        $data = [
            'id' => 1,
            'channel_id' => 2,
            'user_id' => 2,
            'confirmed' => true,
        ];
        $response = [
            'content' => [], 'error_messages' => [
                'channel_id' => [
                    '0' => 'The selected channel id is invalid.',
                ],
            ],
        ];

        // when
        $result = $this->put('/invitations', $data);

        // then
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $result->seeJson($response);
    }

    public function testUpdateInvitationWhenUserIdFieldIsEmpty() : void
    {

        // given
        $data = [
            'id' => 1,
            'channel_id' => 1,
            'confirmed' => true,
        ];
        $response = [
            'content' => [], 'error_messages' => [
                'user_id' => [
                    '0' => 'The user id field is required.'
                ],
            ],
        ];

        // when
        $result = $this->put('/invitations', $data);

        // then
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $result->seeJson($response);
    }

    public function testUpdateInvitationWhenConfirmedFieldIsEmpty() : void
    {

        // given
        $data = [
            'id' => 1,
            'channel_id' => 1,
            'user_id' => 2,
        ];
        $response = [
            'content' => [], 'error_messages' => [
                'confirmed' => [
                    '0' => 'The confirmed field is required.'
                ],
            ],
        ];

        // when
        $result = $this->put('/invitations', $data);

        // then
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $result->seeJson($response);
    }

    public function testUpdateInvitationWhenIdIsNotInt() : void
    {

        // given
        $data = [
            'id' => 'hello',
            'channel_id' => 1,
            'user_id' => 2,
            'confirmed' => true,
        ];
        $response = [
            'content' => [], 'error_messages' => [
                'id' => [
                    '0' => 'The id must be an integer.'
                ],
            ],
        ];

        // when
        $result = $this->put('/invitations', $data);

        // then
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $result->seeJson($response);
    }

    public function testUpdateInvitationWhenChannelIdIsNotInt() : void
    {

        // given
        $data = [
            'id' => 1,
            'channel_id' => 'hello',
            'user_id' => 2,
            'confirmed' => true,
        ];
        $response = [
            'content' => [], 'error_messages' => [
                'channel_id' => [
                    '0' => 'The channel id must be an integer.'
                ],
            ],
        ];

        // when
        $result = $this->put('/invitations', $data);

        // then
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $result->seeJson($response);
    }

    public function testUpdateInvitationWhenUserIdIsNotInt() : void
    {

        // given
        $data = [
            'id' => 1,
            'channel_id' => 1,
            'user_id' => 'hello',
            'confirmed' => true,
        ];
        $response = [
            'content' => [], 'error_messages' => [
                'user_id' => [
                    '0' => 'The user id must be an integer.'
                ],
            ],
        ];

        // when
        $result = $this->put('/invitations', $data);

        // then
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $result->seeJson($response);
    }

    public function testUpdateInvitationWhenConfirmedIsNotBoolean() : void
    {

        // given
        $data = [
            'id' => 1,
            'channel_id' => 1,
            'user_id' => 2,
            'confirmed' => 'hello',
        ];
        $response = [
            'content' => [], 'error_messages' => [
                'confirmed' => [
                    '0' => 'The confirmed field must be true or false.'
                ],
            ],
        ];

        // when
        $result = $this->put('/invitations', $data);

        // then
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $result->seeJson($response);
    }
}
