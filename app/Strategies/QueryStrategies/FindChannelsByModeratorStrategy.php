<?php

namespace App\Strategies\QueryStrategies;

use App\Channel;
use App\Moderator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class FindChannelsByModeratorStrategy implements FindByIdQueryInterface
{

    public function findById(int $id): JsonResponse
    {
        try {

            return $this->findChannels($id);
        } catch (\Exception $e) {

            Log::debug($e->getMessage());
            return response()->json(
                ['content' => [], 'error_messages' => ['error' => $e->getMessage(),],], Response::HTTP_BAD_REQUEST
            );
        }
    }

    private function findChannels(int $id) : JsonResponse
    {

        $channels = [];
        $moderators = Moderator::where('user_id', $id)->get(['*']);
        foreach ($moderators as $moderator) {

            $channels[] = Channel::find($moderator->channel_id);
        }
        return response()->json(
            [
                'content' => [
                    'channels' => $channels,
                ], 'error_messages' =>[],
            ], Response::HTTP_OK
        );
    }

}
