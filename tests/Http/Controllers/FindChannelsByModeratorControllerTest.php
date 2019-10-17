<?php


use App\Channel;
use App\Moderator;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\WithoutEvents;
use Laravel\Lumen\Testing\WithoutMiddleware;

class FindChannelsByModeratorControllerTest extends TestCase
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

        // when
        $result = $this->get('/moderators/user/'.$id);

        // then
        $result->seeStatusCode(Response::HTTP_OK);
    }

    public function testFindModeratorsByChannelWhenChannelNotExists() : void
    {

        // given
        $id = 2;

        // when
        $result = $this->get('/moderators/user/'.$id);

        // then
        $result->seeStatusCode(Response::HTTP_OK);
    }
}
