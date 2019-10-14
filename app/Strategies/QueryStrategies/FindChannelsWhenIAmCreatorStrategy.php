<?php


namespace App\Strategies\QueryStrategies;


use App\Channel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class FindChannelsWhenIAmCreatorStrategy
{

    public function findById(int $id) : JsonResponse {

        try {

            return response()->json(
                [
                    'content' => ['channels' => $this->tryToFindChannels($id)], 'error_messages' => ['error' => []]]
                , Response::HTTP_OK
            );
        } catch (\Exception $e) {

            Log::debug($e->getMessage());
            return response()->json(
                ['content' => [], 'error_messages' => ['error' => $e->getMessage()]], Response::HTTP_BAD_REQUEST
            );
        }
    }

    public function tryToFindChannels(int $creator_id) : array
    {

        $channels = Channel::where('creator_id', $creator_id)->get(['*']);
        return $channels->toArray();
    }
}
