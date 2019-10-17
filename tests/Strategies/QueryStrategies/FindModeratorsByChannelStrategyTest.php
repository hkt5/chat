<?php


use App\Channel;
use App\Moderator;
use App\Strategies\QueryStrategies\FindAllModeratorsByChannelStrategy;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\WithoutEvents;
use Laravel\Lumen\Testing\WithoutMiddleware;

class FindModeratorsByChannelStrategyTest extends TestCase
{

    private $strategy;

    use WithoutMiddleware;
    use WithoutEvents;
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();

        $channel = new Channel();
        $channel->__set('id', 1);
        $channel->__set('name', 'channel');
        $channel->__set('creator_id', 1);
        $channel->save();

        $moderator = new Moderator();
        $moderator->__set('id', 1);
        $moderator->__set('user_id', 1);
        $moderator->__set('channel_id', 1);
        $moderator->save();

        $this->strategy = new FindAllModeratorsByChannelStrategy();
    }

    public function testFindModeratorsByChannelWhenChannelExists() : void
    {

        // given
        $id = 1;
        $response = [
            'content' => [
                'moderators' => [
                    '0' => [
                        'id' => 1,
                        'channel_id' => 1,
                        'user_id' => 1,
                        'created_at' => null,
                        'updated_at' => null,
                    ],
                ],
            ], 'error_messages' => [],
        ];

        // when
        $result = $this->strategy->findById($id);

        // then
        $this->assertEquals(Response::HTTP_OK, $result->status());
        $this->assertEquals(json_encode($response), $result->content());
    }

    public function testFindModeratorsByChannelWhenChannelNotExists() : void
    {

        // given
        $id = 2;
        $response = [
            'content' => [
                'moderators' => [],
            ], 'error_messages' => [],
        ];

        // when
        $result = $this->strategy->findById($id);

        // then
        $this->assertEquals(Response::HTTP_OK, $result->status());
        $this->assertEquals(json_encode($response), $result->content());
    }
}
