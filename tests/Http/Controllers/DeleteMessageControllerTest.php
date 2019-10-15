<?php


use App\Channel;
use App\Message;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\WithoutEvents;
use Laravel\Lumen\Testing\WithoutMiddleware;

class DeleteMessageControllerTest extends TestCase
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

    public function testDeleteMessage() : void
    {

        // given
        $data = [
            'id' => 1,
        ];

        // when
        $result = $this->delete('/channels', $data);

        // then
        $result->seeStatusCode(Response::HTTP_OK);
    }

    public function testDeleteMessageWhenIdFieldIsEmpty() : void
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
        $result = $this->delete('/messages', $data);

        // then
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $result->seeJson($response);
    }

    public function testDeleteMessageWhenIdNotExisting() : void
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
        $result = $this->delete('/messages', $data);

        // then
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $result->seeJson($response);
    }
}
