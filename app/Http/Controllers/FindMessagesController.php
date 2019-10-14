<?php


namespace App\Http\Controllers;


use App\Factories\DatabaseOperationConstants;
use App\Factories\DatabaseQueryFactory;
use Illuminate\Http\JsonResponse;

class FindMessagesController extends Controller
{

    private $strategy;

    public function __construct(DatabaseQueryFactory $databaseQueryFactory)
    {

        $databaseQueryFactory->getInstance(DatabaseOperationConstants::FIND_MESSAGES_STRATEGY);
        $this->strategy = $databaseQueryFactory->strategy;
    }

    public function findById(int $id) : JsonResponse
    {

        return $this->strategy->findById($id);
    }
}
