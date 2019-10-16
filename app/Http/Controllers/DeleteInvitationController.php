<?php


namespace App\Http\Controllers;


use App\Factories\DatabaseCommandFactory;
use App\Factories\DatabaseOperationConstants;
use App\Strategies\CommandStrategies\DeleteInvitationStrategy;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DeleteInvitationController extends Controller
{

    /** @var DeleteInvitationStrategy $strategy */
    private $strategy;

    public function __construct(DatabaseCommandFactory $databaseCommandFactory)
    {
        $databaseCommandFactory->getInstance(DatabaseOperationConstants::DELETE_INVITATION_STRATEGY);
        $this->strategy = $databaseCommandFactory->strategy;
    }

    /**
     * Delete invitation.
     * [Delete current invitation.]
     *
     * @bodyParam id integer required Id of invitation.
     *
     * @response 200 {"content":{"invitation":{"id":1,"channel_id":1,"user_id":2,"confirmed":0,"created_at":null,"updated_at":null}},"error_messages":[]}
     * @response 400 {"content":[],"error_messages":{"id":["The id field is required."]}}
     * @response 400 {"content":[],"error_messages":{"id":["The selected id is invalid."]}}
     * @response 400 {"content":[],"error_messages":{"id":["The id must be an integer."]}}
     */
    public function delete(Request $request) : JsonResponse
    {

        return $this->strategy->command($request);
    }
}
