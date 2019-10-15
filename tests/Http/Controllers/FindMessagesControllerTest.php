<?php


use App\Message;
use App\Channel;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\WithoutEvents;
use Laravel\Lumen\Testing\WithoutMiddleware;

class FindMessagesControllerTest extends TestCase
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

        $message = new Message();
        $message->__set('id', 1);
        $message->__set('channel_id', 1);
        $message->__set('user_id', 1);
        $message->__set('message', 'Hello world');
        $message->save();
    }

    public function testFindMessagesWhenChannelExists() : void
    {

        // given
        $id = 1;
        $response = '["content":{"messages":[{"channel_id":1,"created_at":null,"id":1,"message":"Hello world","updated_at":null,"user_id":1}]}] within [{"content":{"messages":[]},"error_messages":{"error":[]}}]';

        // when
        $result = $this->get('/messages/'.$id);

        // then
        $result->seeStatusCode(Response::HTTP_OK);
        $result->seeJson(json_decode($response, true));
    }

    public function testFindMessagesWhenChannelNotExists() : void
    {

        // given
        $id = 2;
        $response = [
            'content' => ['messages' => [],], 'error_messages' => ['error' => [],],
        ];

        // when
        $result = $this->get('/messages/'.$id);

        // then
        $result->seeStatusCode(Response::HTTP_OK);
        $result->seeJson($response);
    }
}
