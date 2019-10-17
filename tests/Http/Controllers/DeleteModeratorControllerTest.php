<?php


use App\Channel;
use App\Moderator;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\WithoutEvents;
use Laravel\Lumen\Testing\WithoutMiddleware;

class DeleteModeratorControllerTest extends TestCase
{

    use WithoutEvents;
    use WithoutMiddleware;
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();

        $channel = new Channel();
        $channel->__set('id', 1);
        $channel->__set('name', 'hello');
        $channel->__set('creator_id', 1);
        $channel->save();

        $moderator = new Moderator();
        $moderator->__set('id', 1);
        $moderator->__set('channel_id', 1);
        $moderator->__set('user_id', 1);
        $moderator->save();
    }

    public function testDeleteModerator() : void
    {

        // given
        $data = ['id' => 1];

        // when
        $result = $this->delete('/moderators', $data);

        // then
        $result->seeStatusCode(Response::HTTP_OK);
    }

    public function testDeleteModeratorWhenIdFieldIsEmpty() : void
    {

        // given
        $data = [];
        $response = [
            'content' => [], 'error_messages' => ['id' => ['0' => 'The id field is required.'],],
        ];

        // when
        $result = $this->delete('/moderators', $data);

        // then
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $result->seeJson($response);
    }

    public function testDeleteModeratorWhenIdIsNotInteger() : void
    {

        // given
        $data = ['id' => 'hello',];
        $response = [
            'content' => [], 'error_messages' => ['id' => ['0' => 'The id must be an integer.'],],
        ];

        // when
        $result = $this->delete('/moderators', $data);

        // then
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $result->seeJson($response);
    }

    public function testDeleteModeratorWhenIdIsNotExists() : void
    {

        // given
        $data = ['id' => 2,];
        $response = [
            'content' => [], 'error_messages' => ['id' => ['0' => 'The selected id is invalid.'],],
        ];

        // when
        $result = $this->delete('/moderators', $data);

        // then
        $result->seeStatusCode(Response::HTTP_BAD_REQUEST);
        $result->seeJson($response);
    }
}
