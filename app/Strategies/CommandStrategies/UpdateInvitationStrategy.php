<?php


namespace App\Strategies\CommandStrategies;


use App\Invitation;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class UpdateInvitationStrategy implements CommandInterface
{

    private $rules = [
        'id' => 'required|int|exists:invitations,id',
        'channel_id' => 'required|int|exists:channels,id',
        'user_id' => 'required|int',
        'confirmed' => 'required|boolean',
    ];

    public function command(Request $request): JsonResponse
    {
        try {

            return $this->tryToUpdateInvitation($request);
        } catch (\Exception $e) {

            Log::debug($e->getMessage());
            return response()->json(['content' => [], 'error_messages' => ['error' => [$e->getMessage()]]]);
        }
    }

    private function tryToUpdateInvitation(Request $request) : JsonResponse
    {

        $validator = Validator::make($request->all(), $this->rules);
        if($validator->fails()){

            return response()->json(
                ['content' => [], 'error_messages' => $validator->errors()], Response::HTTP_BAD_REQUEST
            );
        } else {

            $invitation = $this->updateInvitation($request);
            return response()->json(
                ['content' => ['invitation' => $invitation], 'error_messages' => []], Response::HTTP_OK
            );
        }
    }

    private function updateInvitation(Request $request): Invitation
    {
        $invitation = Invitation::find($request->get('id'));
        $invitation->__set('channel_id', $request->get('channel_id'));
        $invitation->__set('user_id', $request->get('user_id'));
        $invitation->__set('confirmed', $request->get('confirmed'));
        $invitation->save();
        return $invitation;
    }
}
