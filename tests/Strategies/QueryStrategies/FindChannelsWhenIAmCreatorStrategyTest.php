<?php


use App\Channel;
use App\Strategies\QueryStrategies\FindChannelsWhenIAmCreatorStrategy;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\WithoutEvents;
use Laravel\Lumen\Testing\WithoutMiddleware;

class FindChannelsWhenIAmCreatorStrategyTest extends TestCase
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

        $this->strategy = new FindChannelsWhenIAmCreatorStrategy();
    }

    public function testFindChannelsStrategy() : void
    {

        // given
        $id = 1;

        // when
        $result = $this->strategy->findById($id);
        $result_data = json_decode($result->content(), true);

        // then
        $this->assertEquals(Response::HTTP_OK, $result->status());
        $this->assertTrue(!empty($result_data['content']['channels']));
    }

    public function testFindChannelsStrategyWhenUserNotExisting() : void
    {

        // given
        $id = 2;

        // when
        $result = $this->strategy->findById($id);
        $result_data = json_decode($result->content(), true);

        // then
        $this->assertEquals(Response::HTTP_OK, $result->status());
        $this->assertTrue(empty($result_data['content']['channels']));
    }
}
