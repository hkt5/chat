<?php


use App\Channel;
use App\Invitation;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\WithoutEvents;
use Laravel\Lumen\Testing\WithoutMiddleware;

class FindInvitationsControllerTest extends TestCase
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

    public function testFindInvitations() : void
    {

        // given
        $id = 2;
        $response = [
            'content' => [
                'invitations' => [
                    '0' => [
                        "id" => 1,"channel_id" => 1,"user_id" => 2,"confirmed" => 0,
                    "created_at" => null,"updated_at" =>null
                    ],
                ],
            ], 'error_messages' => ['error' => [],],
        ];

        // when
        $result = $this->get('/invitations/'.$id);

        // then
        $result->seeStatusCode(Response::HTTP_OK);
        $result->seeJson($response);
    }

    public function testFindInvitationsWhenUserNotExisting() : void
    {

        // given
        $id = 1;
        $response = ['content' => ['invitations' => [],], 'error_messages' => ['error' => [],],];

        // when
        $result = $this->get('/invitations/'.$id);

        // then
        $result->seeStatusCode(Response::HTTP_OK);
        $result->seeJson($response);
    }
}
