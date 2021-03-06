<?php


use App\Channel;
use App\Invitation;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\WithoutEvents;
use Laravel\Lumen\Testing\WithoutMiddleware;

class DeleteInvitationControllerTest extends TestCase
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

    public function testDeleteInvitation() : void
    {

        // given
        $data = [
            'id' => 1,
        ];

        // when
        $result = $this->delete('/invitations', $data);

        // then
        $result->seeStatusCode(Response::HTTP_OK);
    }

    public function testDeleteInvitationWhenIdFieldIsEmpty() : void
    {

        // given
        $data = [];
        $response = [
            'content' => [], 'error_messages' => [
                'id' => [
                    '0' => 'The id field is required.',
                ],
            ],
        ];

        // when
        $result = $this->delete('/invitations', $data);

        // then
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $result->seeJson($response);
    }

    public function testDeleteInvitationWhenIdNotExisting() : void
    {

        // given
        $data = [
            'id' => 2,
        ];
        $response = [
            'content' => [], 'error_messages' => [
                'id' => [
                    '0' => 'The selected id is invalid.',
                ],
            ],
        ];

        // when
        $result = $this->delete('/invitations', $data);

        // then
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $result->seeJson($response);
    }

    public function testDeleteInvitationWhenIdIsNotInt() : void
    {

        // given
        $data = [
            'id' => 'hello',
        ];
        $response = [
            'content' => [], 'error_messages' => [
                'id' => [
                    '0' => 'The id must be an integer.',
                ],
            ],
        ];

        // when
        $result = $this->delete('/invitations', $data);

        // then
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $result->seeJson($response);
    }
}
