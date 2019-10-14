<?php


namespace App\Strategies\CommandStrategies;


use App\Message;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class DeleteMessageStrategy implements CommandInterface
{

    private $rules = [
        'id' => 'required|int|exists:messages,id'
    ];

    public function command(Request $request): JsonResponse
    {
        try {

            return $this->tryToDeleteMessage($request);
        } catch (\Exception $e) {

            Log::debug($e->getMessage());
            return response()->json(['content' => [], 'error_messages' => ['error' => [$e->getMessage()]]]);
        }
    }

    private function tryToDeleteMessage(Request $request) : JsonResponse
    {

        $validator = Validator::make($request->all(), $this->rules);
        if($validator->fails()){

            return response()->json(
                ['content' => [], 'error_messages' => $validator->errors()], Response::HTTP_BAD_REQUEST
            );
        } else {

            $message = $this->deleteMessage($request);
            return response()->json(
                ['content' => ['message' => $message], 'error_messages' => []], Response::HTTP_OK
            );
        }
    }

    private function deleteMessage(Request $request): Message
    {
        $message = Message::find($request->get('id'));
        $message->delete();
        return $message;
    }
}
