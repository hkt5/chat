<?php


use App\Channel;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\WithoutEvents;
use Laravel\Lumen\Testing\WithoutMiddleware;

class UpdateChannelControllerTest extends TestCase
{

    use WithoutEvents;
    use WithoutMiddleware;
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();

        $first_channel = new Channel();
        $first_channel->__set('id', 1);
        $first_channel->__set('name', 'first_channel');
        $first_channel->__set('creator_id', 1);
        $first_channel->save();

        $second_channel = new Channel();
        $second_channel->__set('id', 2);
        $second_channel->__set('name', 'second_channel');
        $second_channel->__set('creator_id', 1);
        $second_channel->save();
    }

    public function testUpdateChannel() : void
    {

        // given
        $data = [
            'id' => 1,
            'name' => 'third_channel',
            'creator_id' => 1,
        ];

        // when
        $result = $this->put('/channels', $data, []);

        // then
        $result->seeStatusCode(Response::HTTP_OK);
    }

    public function testUpdateChannelWhenIdFieldIsEmpty() : void
    {

        // given
        $data = [
            'name' => 'third_channel',
            'creator_id' => 1,
        ];
        $response = [
            'content' => [], 'error_messages' => [
                'id' => [
                    '0' => 'The id field is required.'
                ],
            ],
        ];

        // when
        $result = $this->put('/channels', $data);

        // then
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $result->seeJson($response);
    }

    public function testUpdateChannelWhenIdNotExisting() : void
    {

        // given
        $data = [
            'id' => 3,
            'name' => 'third_channel',
            'creator_id' => 1,
        ];
        $response = [
            'content' => [], 'error_messages' => [
                'id' => [
                    '0' => 'The selected id is invalid.'
                ],
            ],
        ];

        // when
        $result = $this->put('/channels', $data);

        // then
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $result->seeJson($response);
    }

    public function testUpdateChannelWhenNameFieldIsEmpty() : void
    {

        // given
        $data = [
            'id' => 1,
            'creator_id' => 1,
        ];
        $response = [
            'content' => [], 'error_messages' => [
                'name' => [
                    '0' => 'The name field is required.'
                ],
            ],
        ];

        // when
        $result = $this->put('/channels', $data);

        // then
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $result->seeJson($response);
    }

    public function testUpdateChannelWhenCreatorIdFieldIsEmpty() : void
    {

        // given
        $data = [
            'id' => 1,
            'name' => 'third_channel',

        ];
        $response = [
            'content' => [], 'error_messages' => [
                'creator_id' => [
                    '0' => 'The creator id field is required.'
                ],
            ],
        ];

        // when
        $result = $this->put('/channels', $data);

        // then
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $result->seeJson($response);
    }
}
