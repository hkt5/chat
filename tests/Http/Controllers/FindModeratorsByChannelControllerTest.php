<?php


use App\Channel;
use App\Moderator;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\WithoutEvents;
use Laravel\Lumen\Testing\WithoutMiddleware;

class FindModeratorsByChannelControllerTest extends TestCase
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

        $moderator = new Moderator();
        $moderator->__set('id', 1);
        $moderator->__set('user_id', 1);
        $moderator->__set('channel_id', 1);
        $moderator->save();
    }

    public function testFindModeratorsByChannelWhenChannelExists() : void
    {

        // given
        $id = 1;
        $response = [
            'content' => [
                'moderators' => [
                    '0' => [
                        'id' => 1,
                        'channel_id' => 1,
                        'user_id' => 1,
                        'created_at' => null,
                        'updated_at' => null,
                    ],
                ],
            ], 'error_messages' => [],
        ];

        // when
        $result = $this->get('/moderators/'.$id);

        // then
        $result->seeStatusCode(Response::HTTP_OK);
        $result->seeJson($response);
    }

    public function testFindModeratorsByChannelWhenChannelNotExists() : void
    {

        // given
        $id = 2;
        $response = [
            'content' => [
                'moderators' => [],
            ], 'error_messages' => [],
        ];

        // when
        $result = $this->get('/moderators/'.$id);

        // then
        $result->seeStatusCode(Response::HTTP_OK);
        $this->seeJson($response);
    }
}
