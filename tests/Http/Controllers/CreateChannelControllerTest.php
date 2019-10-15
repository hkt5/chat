<?php


use App\Channel;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\WithoutEvents;
use Laravel\Lumen\Testing\WithoutMiddleware;

class CreateChannelControllerTest extends TestCase
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

    public function testCreateChannelTest() : void
    {

        // given
        $data = [
            'name' => 'my-channel-2',
            'creator_id' => 1,
        ];

        // when
        $result = $this->post('/channels', $data);

        // then
        $result->seeStatusCode(Response::HTTP_OK);
        $result->seeJsonContains(['name' => 'my-channel-2']);
        $result->seeJsonContains(['creator_id' => 1]);
    }

    public function testCreateChannelWhenChannelExisting() : void
    {

        // given
        $data = [
            'name' => 'my-channel',
            'creator_id' => 1,
        ];
        $response = [
            'content' => [], 'error_messages' => [
                'name' => ['0' => 'The name has already been taken.']
            ],
        ];

        // when
        $result = $this->post('/channels', $data);

        // then
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $result->seeJson($response);
    }

    public function testCreateChannelWhenNameFieldIsEmpty() : void
    {

        // given
        $data = [
            'creator_id' => 1,
        ];
        $response = [
            'content' => [], 'error_messages' => [
                'name' => ['0' => 'The name field is required.']
            ],
        ];


        // when
        $result = $this->post('/channels', $data);

        // then
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $result->seeJson($response);
    }

    public function testCreateChannelWhenCreatorIdFieldIsEmpty() : void
    {

        // given
        $data = [
            'name' => 'my-channel-2',
        ];
        $response = [
            'content' => [], 'error_messages' => [
                'creator_id' => ['0' => 'The creator id field is required.']
            ],
        ];


        // when
        $result = $this->post('/channels', $data);

        // then
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $result->seeJson($response);
    }
}
