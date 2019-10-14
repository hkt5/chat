<?php


namespace App\Http\Controllers;


use App\Factories\DatabaseOperationConstants;
use App\Factories\DatabaseQueryFactory;
use Illuminate\Http\JsonResponse;

class FindChannelsController extends Controller
{

    private $strategy;

    public function __construct(DatabaseQueryFactory $databaseQueryFactory) {
        $databaseQueryFactory->getInstance(DatabaseOperationConstants::FIND_CHANNELS_STRATEGY);
        $this->strategy = $databaseQueryFactory->strategy;
    }

    public function findChannels(int $id) : JsonResponse
    {

        return $this->strategy->findById($id);
    }
}
