<?php


namespace App\Http\Controllers;


use App\Factories\DatabaseCommandFactory;
use App\Factories\DatabaseOperationConstants;
use App\Strategies\CommandStrategies\DeleteModeratorStrategy;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DeleteModeratorController extends Controller
{

    /** @var DeleteModeratorStrategy $strategy */
    private $strategy;

    public function __construct(DatabaseCommandFactory $databaseCommandFactory)
    {

        $databaseCommandFactory->getInstance(DatabaseOperationConstants::DELETE_MODERATOR_STRATEGY);
        $this->strategy = $databaseCommandFactory->strategy;
    }

    /**
     * Delete moderator.
     * [Delete current moderator.]
     *
     * @bodyParam id integer required Id of moderator.
     *
     * @response 200 {"content":{"moderator":{"id":1,"channel_id":1,"user_id":1,"created_at":null,"updated_at":null}},"error_messages":[]}
     * @response 400 {"content":[],"error_messages":{"id":["The id field is required."]}}
     * @response 400 {"content":[],"error_messages":{"id":["The id must be an integer."]}}
     * @response 400 {"content":[],"error_messages":{"id":["The selected id is invalid."]}}
     */
    public function delete(Request $request) : JsonResponse
    {

        return $this->strategy->command($request);
    }
}
