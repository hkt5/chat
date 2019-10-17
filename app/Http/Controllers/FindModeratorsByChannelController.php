<?php


namespace App\Http\Controllers;


use App\Factories\DatabaseOperationConstants;
use App\Factories\DatabaseQueryFactory;
use App\Strategies\QueryStrategies\FindAllModeratorsByChannelStrategy;
use Illuminate\Http\JsonResponse;

class FindModeratorsByChannelController extends Controller
{

    /** @var FindAllModeratorsByChannelStrategy $strategy */
    private $strategy;

    public function __construct(DatabaseQueryFactory $databaseQueryFactory)
    {

        $databaseQueryFactory->getInstance(DatabaseOperationConstants::FIND_MODERATORS_BY_CHANNEL_STRATEGY);
        $this->strategy = $databaseQueryFactory->strategy;
    }

    /**
     * Find moderators.
     * [Find moderators by channel.]
     *
     * @queryParam id integer required Id of channel.
     *
     * @response 200 {"content":{"moderators":[{"id":1,"channel_id":1,"user_id":1,"created_at":null,"updated_at":null}]},"error_messages":[]}
     * @response 200 {"content":{"moderators":[]},"error_messages":[]}
     */
    public function findById($id) : JsonResponse
    {

        return $this->strategy->findById($id);
    }
}
