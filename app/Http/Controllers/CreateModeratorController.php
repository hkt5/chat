<?php


namespace App\Http\Controllers;


use App\Factories\DatabaseCommandFactory;
use App\Factories\DatabaseOperationConstants;
use App\Strategies\CommandStrategies\CreateModeratorStrategy;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CreateModeratorController extends Controller
{

    /** @var CreateModeratorStrategy $strategy */
    private $strategy;

    public function __construct(DatabaseCommandFactory $databaseCommandFactory)
    {

        $databaseCommandFactory->getInstance(DatabaseOperationConstants::CREATE_MODERATOR_STRATEGY);
        $this->strategy = $databaseCommandFactory->strategy;
    }

    /**
     * Create moderator.
     * [Create moderator of channel.]
     *
     * @bodyParam channel_id integer required Id of channel.
     * @bodyParam user_id integer required Id of user.
     *
     * @response 200 {"content":{"moderator":{"channel_id":1,"user_id":1,"id":1}},"error_messages":[]}
     * @response 400 {"content":[],"error_messages":{"channel_id":["The channel id field is required."]}}
     * @response 400 {"content":[],"error_messages":{"user_id":["The user id field is required."]}}
     * @response 400 {"content":[],"error_messages":{"channel_id":["The selected channel id is invalid."]}}
     * @response 400 {"content":[],"error_messages":{"channel_id":["The channel id must be an integer."]}}
     * @response 400 {"content":[],"error_messages":{"user_id":["The user id must be an integer."]}}
     */
    public function create(Request $request) : JsonResponse
    {

        return $this->strategy->command($request);
    }
}
