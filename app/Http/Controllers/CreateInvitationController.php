<?php


namespace App\Http\Controllers;


use App\Factories\DatabaseCommandFactory;
use App\Factories\DatabaseOperationConstants;
use App\Strategies\CommandStrategies\CreateInvitationStrategy;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CreateInvitationController extends Controller
{

    /** @var CreateInvitationStrategy $strategy */
    private $strategy;

    public function __construct(DatabaseCommandFactory $databaseCommandFactory)
    {

        $databaseCommandFactory->getInstance(DatabaseOperationConstants::CREATE_INVITATION_STRATEGY);
        $this->strategy = $databaseCommandFactory->strategy;
    }

    /**
     * Create invitation.
     * [Create new invitation to channel.]
     *
     * @bodyParam channel_id int required The id of channel.
     * @bodyParam user_id int required The id of user.
     *
     * @response {"content":{"invitation":{"channel_id":1,"user_id":1,"confirmed":false,"id":1}},"error_messages":[]}
     *
     * @response 400 {"content":[],"error_messages":{"user_id":["The user id field is required."]}}
     * @response 400 {"content":[],"error_messages":{"channel_id":["The channel id field is required."]}}
     * @response 400 {"content":[],"error_messages":{"channel_id":["The selected channel id is invalid."]}}
     */
    public function create(Request $request) : JsonResponse
    {

        return $this->strategy->command($request);
    }
}
