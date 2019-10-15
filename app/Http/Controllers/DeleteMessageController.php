<?php


namespace App\Http\Controllers;


use App\Factories\DatabaseCommandFactory;
use App\Factories\DatabaseOperationConstants;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DeleteMessageController extends Controller
{

    private $strategy;

    public function __construct(DatabaseCommandFactory $databaseCommandFactory)
    {
        $databaseCommandFactory->getInstance(DatabaseOperationConstants::DELETE_MESSAGE_STRATEGY);
        $this->strategy = $databaseCommandFactory->strategy;
    }

    /**
     * Delete message
     * [Delete current message.]
     *
     * @bodyParam id integer required Id of message.
     *
     * @response 200 {"content":{"message":{"id":1,"message":"Hello world","channel_id":1,"user_id":1,"created_at":null,"updated_at":null}},"error_messages":[]}
     * @response 400 {"content":[],"error_messages":{"id":["The id field is required."]}}
     * @response 400 {"content":[],"error_messages":{"id":["The selected id is invalid."]}}
     */
    public function delete(Request $request) : JsonResponse
    {

        return $this->strategy->command($request);
    }
}
