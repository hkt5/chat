<?php


namespace App\Http\Controllers;


use App\Factories\DatabaseOperationConstants;
use App\Factories\DatabaseQueryFactory;
use Illuminate\Http\JsonResponse;

class FindInvitationsController extends Controller
{

    private $strategy;

    public function __construct(DatabaseQueryFactory $databaseQueryFactory)
    {

        $databaseQueryFactory->getInstance(DatabaseOperationConstants::FIND_INVITATIONS_STRATEGY);
        $this->strategy = $databaseQueryFactory->strategy;
    }

    /**
     * Find invitations.
     * [Find invitations for user.]
     *
     * @queryParam id integer required Id of user.
     *
     * @response 200 {"content":{"invitations":[{"id":1,"channel_id":1,"user_id":2,"confirmed":0,"created_at":null,"updated_at":null}]},"error_messages":{"error":[]}}
     * @response 200 {"content":{"invitations":[]},"error_messages":{"error":[]}}
     */
    public function findById(int $id) : JsonResponse
    {

        return $this->strategy->findById($id);
    }
}
