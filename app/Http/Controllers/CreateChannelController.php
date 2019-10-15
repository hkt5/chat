<?php


namespace App\Http\Controllers;


use App\Factories\DatabaseCommandFactory;
use App\Factories\DatabaseOperationConstants;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CreateChannelController extends Controller
{

    private $strategy;

    public function __construct(DatabaseCommandFactory $databaseCommandFactory)
    {

        $databaseCommandFactory->getInstance(DatabaseOperationConstants::CREATE_CHANNEL_STRATEGY);
        $this->strategy = $databaseCommandFactory->strategy;
    }

    /**
     * Create new channel.
     * [ Create new chat channel. ]
     *
     * @bodyParam name string required Name of new channel.
     * @bodyParam creator_id int required Creator id.
     *
     * @response 200 {"content":{"channel":{"name":"my-channel-2","creator_id":1,"id":2}},"error_messages":[]}
     * @response 400 {"content":[],"error_messages":{"name":["The name has already been taken."]}}
     * @response 400 {"content":[],"error_messages":{"name":["The name field is required."]}}
     * @response 400 {"content":[],"error_messages":{"creator_id":["The creator id field is required."]}}
     */
    public function create(Request $request) : JsonResponse
    {

        return $this->strategy->command($request);
    }
}
