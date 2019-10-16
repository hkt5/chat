<?php


use App\Channel;
use App\Helpers\MockingRequest;
use App\Invitation;
use App\Strategies\CommandStrategies\UpdateInvitationStrategy;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\WithoutEvents;
use Laravel\Lumen\Testing\WithoutMiddleware;

class UpdateInvitationStrategyTest extends TestCase
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

        $this->strategy = new UpdateInvitationStrategy();
    }

    public function testUpdateInvitation() : void
    {

        // given
        $data = [
            'method' => 'post', 'uri' => '/login/email', 'parameters' => [
                'id' => 1,
                'channel_id' => 1,
                'user_id' => 2,
                'confirmed' => true,
            ], 'server' => [], 'cookies' => [], 'files' => [], 'content' => ''
        ];
        $request = MockingRequest::createRequest($data);

        // when
        $result = $this->strategy->command($request);
        $result_data = json_decode($result->content(), true);

        // then
        $this->assertEquals(Response::HTTP_OK, $result->status());
        $this->assertEquals(1, $result_data['content']['invitation']['id']);
        $this->assertEquals(1, $result_data['content']['invitation']['channel_id']);
        $this->assertEquals(2, $result_data['content']['invitation']['user_id']);
        $this->assertEquals(true, $result_data['content']['invitation']['confirmed']);
    }

    public function testUpdateInvitationWhenIdFieldIsEmpty() : void
    {

        // given
        $data = [
            'method' => 'post', 'uri' => '/login/email', 'parameters' => [
                'channel_id' => 1,
                'user_id' => 2,
                'confirmed' => true,
            ], 'server' => [], 'cookies' => [], 'files' => [], 'content' => ''
        ];
        $request = MockingRequest::createRequest($data);

        // when
        $result = $this->strategy->command($request);
        $result_data = json_decode($result->content(), true);

        // then
        $this->assertEquals(Response::HTTP_BAD_REQUEST, $result->status());
        $this->assertEquals('The id field is required.', $result_data['error_messages']['id']['0']);
    }

    public function testUpdateInvitationWhenChannelFieldIdIsEmpty() : void
    {

        // given
        $data = [
            'method' => 'post', 'uri' => '/login/email', 'parameters' => [
                'id' => 1,
                'user_id' => 2,
                'confirmed' => true,
            ], 'server' => [], 'cookies' => [], 'files' => [], 'content' => ''
        ];
        $request = MockingRequest::createRequest($data);

        // when
        $result = $this->strategy->command($request);
        $result_data = json_decode($result->content(), true);

        // then
        $this->assertEquals(Response::HTTP_BAD_REQUEST, $result->status());
        $this->assertEquals('The channel id field is required.', $result_data['error_messages']['channel_id']['0']);
    }

    public function testUpdateInvitationWhenUserIdFieldIsEmpty() : void
    {

        // given
        $data = [
            'method' => 'post', 'uri' => '/login/email', 'parameters' => [
                'id' => 1,
                'channel_id' => 1,
                'confirmed' => true,
            ], 'server' => [], 'cookies' => [], 'files' => [], 'content' => ''
        ];
        $request = MockingRequest::createRequest($data);

        // when
        $result = $this->strategy->command($request);
        $result_data = json_decode($result->content(), true);

        // then
        $this->assertEquals(Response::HTTP_BAD_REQUEST, $result->status());
        $this->assertEquals('The user id field is required.', $result_data['error_messages']['user_id']['0']);
    }

    public function testUpdateInvitationWhenConfirmedFieldIsEmpty() : void
    {

        // given
        $data = [
            'method' => 'post', 'uri' => '/login/email', 'parameters' => [
                'id' => 1,
                'channel_id' => 1,
                'user_id' => 2,
            ], 'server' => [], 'cookies' => [], 'files' => [], 'content' => ''
        ];
        $request = MockingRequest::createRequest($data);

        // when
        $result = $this->strategy->command($request);
        $result_data = json_decode($result->content(), true);

        // then
        $this->assertEquals(Response::HTTP_BAD_REQUEST, $result->status());
        $this->assertEquals('The confirmed field is required.', $result_data['error_messages']['confirmed']['0']);
    }

    public function testUpdateInvitationWhenInvitationNotExisting() : void
    {

        // given
        $data = [
            'method' => 'post', 'uri' => '/login/email', 'parameters' => [
                'id' => 2,
                'channel_id' => 1,
                'user_id' => 2,
                'confirmed' => true,
            ], 'server' => [], 'cookies' => [], 'files' => [], 'content' => ''
        ];
        $request = MockingRequest::createRequest($data);

        // when
        $result = $this->strategy->command($request);
        $result_data = json_decode($result->content(), true);

        // then
        $this->assertEquals(Response::HTTP_BAD_REQUEST, $result->status());
        $this->assertEquals('The selected id is invalid.', $result_data['error_messages']['id']['0']);
    }

    public function testUpdateInvitationWhenChannelIdNotExisting() : void
    {

        // given
        $data = [
            'method' => 'post', 'uri' => '/login/email', 'parameters' => [
                'id' => 1,
                'channel_id' => 2,
                'user_id' => 2,
                'confirmed' => true,
            ], 'server' => [], 'cookies' => [], 'files' => [], 'content' => ''
        ];
        $request = MockingRequest::createRequest($data);

        // when
        $result = $this->strategy->command($request);
        $result_data = json_decode($result->content(), true);

        // then
        $this->assertEquals(Response::HTTP_BAD_REQUEST, $result->status());
        $this->assertEquals('The selected channel id is invalid.', $result_data['error_messages']['channel_id']['0']);
    }

    public function testUpdateInvitationWhenIdIsNotInt() : void
    {

        // given
        $data = [
            'method' => 'post', 'uri' => '/login/email', 'parameters' => [
                'id' => 'hello',
                'channel_id' => 1,
                'user_id' => 2,
                'confirmed' => true,
            ], 'server' => [], 'cookies' => [], 'files' => [], 'content' => ''
        ];
        $request = MockingRequest::createRequest($data);

        // when
        $result = $this->strategy->command($request);
        $result_data = json_decode($result->content(), true);

        // then
        $this->assertEquals(Response::HTTP_BAD_REQUEST, $result->status());
        $this->assertEquals('The id must be an integer.', $result_data['error_messages']['id']['0']);
    }

    public function testUpdateInvitationWhenChannelIdIsNotInt() : void
    {

        // given
        $data = [
            'method' => 'post', 'uri' => '/login/email', 'parameters' => [
                'id' => 1,
                'channel_id' => 'hello',
                'user_id' => 2,
                'confirmed' => true,
            ], 'server' => [], 'cookies' => [], 'files' => [], 'content' => ''
        ];
        $request = MockingRequest::createRequest($data);

        // when
        $result = $this->strategy->command($request);
        $result_data = json_decode($result->content(), true);

        // then
        $this->assertEquals(Response::HTTP_BAD_REQUEST, $result->status());
        $this->assertEquals('The channel id must be an integer.', $result_data['error_messages']['channel_id']['0']);
    }

    public function testUpdateInvitationWhenUserIdIsNotInt() : void
    {

        // given
        $data = [
            'method' => 'post', 'uri' => '/login/email', 'parameters' => [
                'id' => 1,
                'channel_id' => 1,
                'user_id' => 'hello',
                'confirmed' => true,
            ], 'server' => [], 'cookies' => [], 'files' => [], 'content' => ''
        ];
        $request = MockingRequest::createRequest($data);

        // when
        $result = $this->strategy->command($request);
        $result_data = json_decode($result->content(), true);

        // then
        $this->assertEquals(Response::HTTP_BAD_REQUEST, $result->status());
        $this->assertEquals('The user id must be an integer.', $result_data['error_messages']['user_id']['0']);
    }

    public function testUpdateInvitationWhenConfirmedIsNotBoolean() : void
    {

        // given
        $data = [
            'method' => 'post', 'uri' => '/login/email', 'parameters' => [
                'id' => 1,
                'channel_id' => 1,
                'user_id' => 2,
                'confirmed' => 'hello',
            ], 'server' => [], 'cookies' => [], 'files' => [], 'content' => ''
        ];
        $request = MockingRequest::createRequest($data);

        // when
        $result = $this->strategy->command($request);
        $result_data = json_decode($result->content(), true);

        // then
        $this->assertEquals(Response::HTTP_BAD_REQUEST, $result->status());
        $this->assertEquals('The confirmed field must be true or false.', $result_data['error_messages']['confirmed']['0']);
    }
}
