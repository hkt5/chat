<?php


use App\Message;
use App\Channel;
use App\Helpers\MockingRequest;
use App\Strategies\CommandStrategies\DeleteMessageStrategy;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\WithoutEvents;
use Laravel\Lumen\Testing\WithoutMiddleware;

class DeleteMessageTest extends TestCase
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

        $this->strategy = new DeleteMessageStrategy();
    }

    public function testDeleteMessage() : void {

        // given
        $data = [
            'method' => 'post', 'uri' => '/login/email', 'parameters' => [
                'id' => 1,
            ], 'server' => [], 'cookies' => [], 'files' => [], 'content' => ''
        ];
        $request = MockingRequest::createRequest($data);

        // when
        $result = $this->strategy->command($request);

        // then
        $this->assertEquals(Response::HTTP_OK, $result->status());
    }

    public function testDeleteMessageWhenIdIsEmpty() : void {

        // given
        $data = [
            'method' => 'post', 'uri' => '/login/email', 'parameters' => [], 'server' => [], 'cookies' => [],
            'files' => [], 'content' => ''
        ];
        $request = MockingRequest::createRequest($data);

        // when
        $result = $this->strategy->command($request);
        $result_data = json_decode($result->content(), true);

        // then
        $this->assertEquals(Response::HTTP_BAD_REQUEST, $result->status());
        $this->assertEquals('The id field is required.', $result_data['error_messages']['id']['0']);
    }

    public function testDeleteMessageWhenIdNotExisting() : void {

        // given
        $data = [
            'method' => 'post', 'uri' => '/login/email', 'parameters' => [
                'id' => 2,
            ], 'server' => [], 'cookies' => [],
            'files' => [], 'content' => ''
        ];
        $request = MockingRequest::createRequest($data);

        // when
        $result = $this->strategy->command($request);
        $result_data = json_decode($result->content(), true);

        // then
        $this->assertEquals(Response::HTTP_BAD_REQUEST, $result->status());
        $this->assertEquals('The selected id is invalid.', $result_data['error_messages']['id']['0']);
    }
}
