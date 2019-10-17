<?php


namespace App\Strategies\QueryStrategies;


use App\Moderator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class FindAllModeratorsByChannelStrategy implements FindByIdQueryInterface
{

    public function findById(int $id): JsonResponse
    {
        try {

            return $this->findModerators($id);
        } catch (\Exception $e) {

            Log::debug($e->getMessage());
            return response()->json(
                ['content' => [], 'error_messages' => ['error' => $e->getMessage(),],], Response::HTTP_BAD_REQUEST
            );
        }
    }

    private function findModerators(int $id) : JsonResponse
    {
        $moderators = Moderator::where('channel_id', $id)->get(['*']);
        return response()->json(
            ['content' => ['moderators' => $moderators], 'error_messages' => [],], Response::HTTP_OK
        );
    }
}
