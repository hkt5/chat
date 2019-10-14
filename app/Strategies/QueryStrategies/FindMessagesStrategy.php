<?php


namespace App\Strategies\QueryStrategies;

use App\Message;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class FindMessagesStrategy implements FindByIdQueryInterface
{

    public function findById(int $id) : JsonResponse {

        try {

            return response()->json(
                [
                    'content' => ['messages' => $this->tryToFindMessages($id)], 'error_messages' => ['error' => []]]
                , Response::HTTP_OK
            );
        } catch (\Exception $e) {

            Log::debug($e->getMessage());
            return response()->json(
                ['content' => [], 'error_messages' => ['error' => $e->getMessage()]], Response::HTTP_BAD_REQUEST
            );
        }
    }

    private function tryToFindMessages(int $channel_id) : array
    {

        $invitations = Message::where('channel_id', $channel_id)->get(['*']);
        return $invitations->toArray();
    }
}
