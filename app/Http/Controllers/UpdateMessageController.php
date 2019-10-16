<?php


namespace App\Http\Controllers;


use App\Factories\DatabaseCommandFactory;
use App\Factories\DatabaseOperationConstants;
use App\Strategies\CommandStrategies\UpdateMessageStrategy;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UpdateMessageController extends Controller
{

    /** @var UpdateMessageStrategy $strategy */
    private $strategy;

    public function __construct(DatabaseCommandFactory $databaseCommandFactory)
    {

        $databaseCommandFactory->getInstance(DatabaseOperationConstants::UPDATE_MESSAGE_STRATEGY);
        $this->strategy = $databaseCommandFactory->strategy;
    }

    /**
     * Update message
     * [Update current message]
     *
     * @bodyParam id integer required Id of message.
     * @bodyParam user_id integer required Id of user.
     * @bodyParam channel_id integer required Id of channel.
     * @bodyParam message string required Message.
     *
     * @response 200 {"content":{"message":{"id":1,"message":"Hello World","channel_id":1,"user_id":1,"created_at":null,"updated_at":null}},"error_messages":[]}
     * @response 400 {"content":[],"error_messages":{"id":["The id field is required."]}}
     * @response 400 {"content":[],"error_messages":{"id":["The selected id is invalid."]}}
     * @response 400 {"content":[],"error_messages":{"user_id":["The user id field is required."]}}
     * @response 400 {"content":[],"error_messages":{"channel_id":["The channel id field is required."]}}
     * @response 400 {"content":[],"error_messages":{"channel_id":["The selected channel id is invalid."]}}
     * @response 400 {"content":[],"error_messages":{"message":["The message field is required."]}}
     * @response 400 {"content":[],"error_messages":{"id":["The id must be an integer."]}}
     * @response 400 {"content":[],"error_messages":{"user_id":["The user id must be an integer."]}}
     * @response 400 {"content":[],"error_messages":{"channel_id":["The channel id must be an integer."]}}
     * @response 400 {"content":[],"error_messages":{"message":["The message must be a string."]}}
     */
    public function update(Request $request) : JsonResponse
    {

        return $this->strategy->command($request);
    }
}
