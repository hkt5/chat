<?php


use App\Channel;
use App\Helpers\MockingRequest;
use App\Invitation;
use App\Strategies\CommandStrategies\DeleteInvitationStrategy;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\WithoutEvents;
use Laravel\Lumen\Testing\WithoutMiddleware;

class DeleteInvitationTest extends TestCase
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

        $invitation = new Invitation();
        $invitation->__set('id', 1);
        $invitation->__set('channel_id', 1);
        $invitation->__set('user_id', 2);
        $invitation->__set('confirmed', false);
        $invitation->save();

        $this->strategy = new DeleteInvitationStrategy();
    }

    public function testDeleteInvitationStrategy() : void
    {

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

    public function testDeleteInvitationStrategyWhenIdFieldIsEmpty() : void
    {

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

    public function testDeleteInvitationStrategyWhenIdNotExisting() : void
    {

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
