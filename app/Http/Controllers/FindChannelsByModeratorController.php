<?php


namespace App\Http\Controllers;


use App\Factories\DatabaseOperationConstants;
use App\Factories\DatabaseQueryFactory;
use App\Strategies\QueryStrategies\FindChannelsByModeratorStrategy;
use Illuminate\Http\JsonResponse;

class FindChannelsByModeratorController extends Controller
{

    /** @var FindChannelsByModeratorStrategy $strategy */
    private $strategy;

    public function __construct(DatabaseQueryFactory $databaseQueryFactory)
    {

        $databaseQueryFactory->getInstance(DatabaseOperationConstants::FIND_CHANNELS_BY_MODERATOR_STRATEGY);
        $this->strategy = $databaseQueryFactory->strategy;
    }

    /**
     * Find channels.
     * [Find channels by moderator.]
     *
     * @queryParam id integer required Id of moderator.
     *
     * @response 200 {"content":{"channels":[{"id":1,"creator_id":1,"name":"channel","created_at":null,"updated_at":null}]},"error_messages":[]}
     * @response 200 {"content":{"channels":[]},"error_messages":[]}
     */
    public function findById(int $id) : JsonResponse
    {

        return $this->strategy->findById($id);
    }
}
