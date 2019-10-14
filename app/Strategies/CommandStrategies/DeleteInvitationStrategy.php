<?php


namespace App\Strategies\CommandStrategies;


use App\Invitation;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class DeleteInvitationStrategy implements CommandInterface
{

    private $rules = [
        'id' => 'required|int|exists:invitations,id',
    ];

    public function command(Request $request): JsonResponse
    {
        try {

            return $this->tryToDeleteInvitation($request);
        } catch (\Exception $e) {

            Log::debug($e->getMessage());
            return response()->json(['content' => [], 'error_messages' => ['error' => [$e->getMessage()]]]);
        }
    }

    private function tryToDeleteInvitation(Request $request) : JsonResponse
    {

        $validator = Validator::make($request->all(), $this->rules);
        if($validator->fails()){

            return response()->json(
                ['content' => [], 'error_messages' => $validator->errors()], Response::HTTP_BAD_REQUEST
            );
        } else {

            $invitation = $this->deleteInvitation($request);
            return response()->json(
                ['content' => ['invitation' => $invitation], 'error_messages' => []], Response::HTTP_OK
            );
        }
    }

    private function deleteInvitation(Request $request): Invitation
    {
        $invitation = Invitation::find($request->get('id'));
        $invitation->delete();
        return $invitation;
    }
}
