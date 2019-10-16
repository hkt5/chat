<?php


namespace App\Http\Controllers;


use App\Factories\DatabaseCommandFactory;
use App\Factories\DatabaseOperationConstants;
use App\Strategies\CommandStrategies\CreateMessageStrategy;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CreateMessageController extends Controller
{

    /** @var CreateMessageStrategy $strategy */
    private $strategy;

    public function __construct(DatabaseCommandFactory $databaseCommandFactory)
    {
        $databaseCommandFactory->getInstance(DatabaseOperationConstants::CREATE_MESSAGE_STRATEGY);
        $this->strategy = $databaseCommandFactory->strategy;
    }

    /**
     * Create message.
     * [Create new message.]
     * @bodyParam user_id int required Id of user.
     * @bodyParam channel_id int required Id of channel.
     * @bodyPAram message string required Chat message.
     *
     * @response 200 {"content":{"message":{"message":"Hello world.","channel_id":1,"user_id":1,"id":1}},"error_messages":[]}
     * @response 400 {"content":[],"error_messages":{"user_id":["The user id field is required."]}}
     * @response 400 {"content":[],"error_messages":{"channel_id":["The channel id field is required."]}}
     * @response 400 {"content":[],"error_messages":{"message":["The message field is required."]}}
     * @response 400 {"content":[],"error_messages":{"channel_id":["The selected channel id is invalid."]}}
     * @response 400 {"content":[],"error_messages":{"user_id":["The user id must be an integer."]}}
     * @response 400 {"content":[],"error_messages":{"channel_id":["The channel id must be an integer."]}}
     * @response 400 {"content":[],"error_messages":{"message":["The message must be a string."]}}
     */
    public function create(Request $request) : JsonResponse
    {

        return $this->strategy->command($request);
    }
}
