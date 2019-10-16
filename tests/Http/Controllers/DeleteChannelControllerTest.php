<?php


use App\Channel;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\WithoutEvents;
use Laravel\Lumen\Testing\WithoutMiddleware;

class DeleteChannelControllerTest extends TestCase
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

    public function testDeleteChannel() : void
    {

        // given
        $data = [
            'id' => 1,
            'creator_id' => 1,
        ];

        // when
        $result = $this->delete('/channels', $data);

        // then
        $result->seeStatusCode(Response::HTTP_OK);
    }

    public function testDeleteChannelWhenIdFieldIsEmpty() : void
    {

        // given
        $data = [
            'creator_id' => 1,
        ];
        $response = [
            'content' => [], 'error_messages' => [
                'id' => [
                    '0' => 'The id field is required.',
                ],
            ],
        ];

        // when
        $result = $this->delete('/channels', $data);

        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $result->seeJson($response);
    }

    public function testDeleteChannelWhenIdNotExisting() : void
    {

        // given
        $data = [
            'id' => 2,
            'creator_id' => 1,
        ];
        $response = [
            'content' => [], 'error_messages' => [
                'id' => [
                    '0' => 'The selected id is invalid.',
                ],
            ],
        ];

        // when
        $result = $this->delete('/channels', $data);

        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $result->seeJson($response);
    }

    public function testDeleteChannelWhenCreatorIdFieldIsEmpty() : void
    {

        // given
        $data = [
            'id' => 1,
        ];
        $response = [
            'content' => [], 'error_messages' => [
                'creator_id' => [
                    '0' => 'The creator id field is required.',
                ],
            ],
        ];

        // when
        $result = $this->delete('/channels', $data);

        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $result->seeJson($response);
    }

    public function testDeleteChannelWhenCreatorIdNotExisting() : void
    {

        // given
        $data = [
            'id' => 1,
            'creator_id' => 2,
        ];
        $response = [
            'content' => [], 'error_messages' => [
                'creator_id' => [
                    '0' => 'The selected creator id is invalid.',
                ],
            ],
        ];

        // when
        $result = $this->delete('/channels', $data);

        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $result->seeJson($response);
    }

    public function testDeleteChannelWhenCreatorIdIsNotInteger() : void
    {

        // given
        $data = [
            'id' => 1,
            'creator_id' => 'hello',
        ];
        $response = [
            'content' => [], 'error_messages' => [
                'creator_id' => [
                    '0' => 'The creator id must be an integer.',
                ],
            ],
        ];

        // when
        $result = $this->delete('/channels', $data);

        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $result->seeJson($response);
    }

    public function testDeleteChannelWhenIdIsNotInteger() : void
    {

        // given
        $data = [
            'id' => 'hello',
            'creator_id' => 1,
        ];
        $response = [
            'content' => [], 'error_messages' => [
                'id' => [
                    '0' => 'The id must be an integer.',
                ],
            ],
        ];

        // when
        $result = $this->delete('/channels', $data);

        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $result->seeJson($response);
    }

}
