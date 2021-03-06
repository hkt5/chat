<?php


namespace App\Http\Controllers;


use App\Factories\DatabaseCommandFactory;
use App\Factories\DatabaseOperationConstants;
use App\Strategies\CommandStrategies\DeleteChannelStrategy;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DeleteChannelController extends Controller
{

    /** @var DeleteChannelStrategy $strategy */
    private $strategy;

    public function __construct(DatabaseCommandFactory $databaseCommandFactory)
    {
        $databaseCommandFactory->getInstance(DatabaseOperationConstants::DELETE_CHANNEL_STRATEGY);
        $this->strategy = $databaseCommandFactory->strategy;
    }

    /**
     * Delete channel.
     * [Delete channel when I am creator.]
     *
     * @bodyParam id integer required Id of channel.
     * @bodyParam creator_id integer required Id of creator.
     *
     * @response 200 {"content":{"channel":{"id":1,"creator_id":1,"name":"my-channel","users":null,"created_at":null,"updated_at":null}},"error_messages":[]}
     * @response 400 {"content":[],"error_messages":{"id":["The id field is required."]}}
     * @response 400 {"content":[],"error_messages":{"id":["The selected id is invalid."]}}
     * @response 400 {"content":[],"error_messages":{"creator_id":["The creator id field is required."]}}
     * @response 400 {"content":[],"error_messages":{"creator_id":["The selected creator id is invalid."]}}
     * @response 400 {"content":[],"error_messages":{"creator_id":["The creator id must be an integer."]}}
     * @response 400 {"content":[],"error_messages":{"id":["The id must be an integer."]}}
     */
    public function delete(Request $request) : JsonResponse
    {

        return $this->strategy->command($request);
    }
}
