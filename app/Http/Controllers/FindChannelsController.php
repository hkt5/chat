<?php


namespace App\Http\Controllers;


use App\Factories\DatabaseOperationConstants;
use App\Factories\DatabaseQueryFactory;
use Illuminate\Http\JsonResponse;

class FindChannelsController extends Controller
{

    private $strategy;

    public function __construct(DatabaseQueryFactory $databaseQueryFactory) {
        $databaseQueryFactory->getInstance(DatabaseOperationConstants::FIND_CHANNELS_STRATEGY);
        $this->strategy = $databaseQueryFactory->strategy;
    }

    /**
     * Find channels.
     *[Find all channels of user.]
     *
     * @queryParam id intenger required Id of user.
     *
     * @response 200 {"content":{"channels":[{"id":1,"creator_id":1,"name":"my-channel","users":null,"created_at":null,"updated_at":null}]},"error_messages":{"error":[]}}
     * @response 200 {"content":{"channels":[]},"error_messages":{"error":[]}}
     */
    public function findById(int $id) : JsonResponse
    {

        return $this->strategy->findById($id);
    }
}
