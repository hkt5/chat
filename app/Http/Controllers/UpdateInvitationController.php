<?php


namespace App\Http\Controllers;


use App\Factories\DatabaseCommandFactory;
use App\Factories\DatabaseOperationConstants;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UpdateInvitationController extends Controller
{

    private $strategy;

    public function __construct(DatabaseCommandFactory $databaseCommandFactory)
    {

        $databaseCommandFactory->getInstance(DatabaseOperationConstants::UPDATE_INVITATION_STRATEGY);
        $this->strategy = $databaseCommandFactory->strategy;
    }

    public function update(Request $request) : JsonResponse
    {

        return $this->strategy->command($request);
    }
}
