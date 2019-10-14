<?php


namespace App\Strategies\QueryStrategies;

use App\Channel;
use App\Invitation;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class FindChannelsStrategy implements FindByIdQueryInterface
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

    private function tryToFindChannels(int $user_id) : array
    {

        $channels = [];
        $invitations = Invitation::where('user_id', $user_id)->where('confirmed', true)->get(['*']);
        foreach($invitations as $invitation) {

            $channels[] = Channel::find($invitation->__get('channel_id'));
        }

        return $channels;
    }
}
