<?php


namespace App\Http\Controllers;


use App\Factories\DatabaseCommandFactory;
use App\Factories\DatabaseOperationConstants;
use App\Strategies\CommandStrategies\UpdateChannelStrategy;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UpdateChannelController extends Controller
{

    /** @var UpdateChannelStrategy $strategy */
    private $strategy;

    public function __construct(DatabaseCommandFactory $databaseCommandFactory)
    {
        $databaseCommandFactory->getInstance(DatabaseOperationConstants::UPDATE_CHANNEL_STRATEGY);
        $this->strategy = $databaseCommandFactory->strategy;
    }

    /**
     * Update channel.
     * [Update current channel.]
     *
     * @bodyParam id integer required Id of channel.
     * @bodyParam name string required Name of channel.
     * @bodyParam creator_id integer required Id of creator.
     *
     * @response 200 {"content":{"channel":{"id":1,"creator_id":1,"name":"third_channel","users":null,"created_at":null,"updated_at":"2019-10-15 10:33:28"},"error_messages":null},"0":200}
     * @response 400 {"content":[],"error_messages":{"id":["The id field is required."]}}
     * @response 400 {"content":[],"error_messages":{"id":["The selected id is invalid."]}}
     * @response 400 {"content":[],"error_messages":{"name":["The name field is required."]}}
     * @response 400 {"content":[],"error_messages":{"creator_id":["The creator id field is required."]}}
     * @response 400 {"content":[],"error_messages":{"id":["The id must be an integer."]}}
     * @response 400 {"content":[],"error_message":{"name":["The name must be a string."]}}
     * @response 400 {"content":[],"error_messages":{"creator_id":["The creator id must be an integer."]}}
     */
    public function update(Request $request) : JsonResponse
    {

        return $this->strategy->command($request);
    }
}
