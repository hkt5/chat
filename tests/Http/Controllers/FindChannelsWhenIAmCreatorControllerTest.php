<?php


use App\Channel;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\WithoutEvents;
use Laravel\Lumen\Testing\WithoutMiddleware;

class FindChannelsWhenIAmCreatorControllerTest extends TestCase
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
    }

    public function testFindChannelsWhenCreatorExisting() : void
    {

        // given
        $id = 1;

        // when
        $result = $this->get('/channels/creator/'.$id);

        // then
        $result->seeStatusCode(Response::HTTP_OK);
    }

    public function testFindChannelsStrategyWhenCreatorNotExisting() : void
    {

        // given
        $id = 2;
        $response = ['content' => ['channels' => [],], 'error_messages' => ['error' => [],],];

        // when
        $result = $this->get('/channels/creator/'.$id);

        // then
        $result->seeStatusCode(Response::HTTP_OK);
        $result->seeJson($response);
    }
}
