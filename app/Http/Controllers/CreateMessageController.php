<?php


namespace App\Http\Controllers;


use App\Factories\DatabaseCommandFactory;
use App\Factories\DatabaseOperationConstants;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CreateMessageController extends Controller
{

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
     * @reponse 200 {"content":{"message":{"message":"Hello world.","channel_id":1,"user_id":1,"id":1}},"error_messages":[]}
     * @reponse 400 {"content":[],"error_messages":{"user_id":["The user id field is required."]}}
     * @response 400 {"content":[],"error_messages":{"channel_id":["The channel id field is required."]}}
     * @response 400 {"content":[],"error_messages":{"message":["The message field is required."]}}
     * @response 400 {"content":[],"error_messages":{"channel_id":["The selected channel id is invalid."]}}
     */
    public function create(Request $request) : JsonResponse
    {

        return $this->strategy->command($request);
    }
}
