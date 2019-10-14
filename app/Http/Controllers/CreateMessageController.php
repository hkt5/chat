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

    public function create(Request $request) : JsonResponse
    {

        return $this->strategy->create($request);
    }
}
