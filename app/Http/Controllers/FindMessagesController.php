<?php


namespace App\Http\Controllers;


use App\Factories\DatabaseOperationConstants;
use App\Factories\DatabaseQueryFactory;
use Illuminate\Http\JsonResponse;

class FindMessagesController extends Controller
{

    private $strategy;

    public function __construct(DatabaseQueryFactory $databaseQueryFactory)
    {

        $databaseQueryFactory->getInstance(DatabaseOperationConstants::FIND_MESSAGES_STRATEGY);
        $this->strategy = $databaseQueryFactory->strategy;
    }

    /**
     * Find messages.
     * [Find messages for channel.]
     *
     * @queryParam id integer required Id of channel.
     *
     * @response 200 ["content":{"messages":[{"channel_id":1,"created_at":null,"id":1,"message":"Hello world","updated_at":null,"user_id":1}]}] within [{"content":{"messages":[]},"error_messages":{"error":[]}}]
     * @response 200 [{"content":{"messages":[]},"error_messages":{"error":[]}}]
     */
    public function findById(int $id) : JsonResponse
    {

        return $this->strategy->findById($id);
    }
}
