<?php


namespace App\Strategies\QueryStrategies;

use App\Invitation;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class FindInvitationsStrategy implements FindByIdQueryInterface
{

    public function findById(int $id) : JsonResponse {

        try {

            return response()->json(
                [
                    'content' => ['invitations' => $this->tryToFindInvitations($id)], 'error_messages' => ['error' => []]]
                , Response::HTTP_OK
            );
        } catch (\Exception $e) {

            Log::debug($e->getMessage());
            return response()->json(
                ['content' => [], 'error_messages' => ['error' => $e->getMessage()]], Response::HTTP_BAD_REQUEST
            );
        }
    }

    private function tryToFindInvitations(int $user_id) : array
    {

        $invitations = Invitation::where('user_id', $user_id)->where('confirmed', false)->get(['*']);
        return $invitations->toArray();
    }
}
