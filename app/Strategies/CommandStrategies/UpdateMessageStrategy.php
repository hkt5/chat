<?php


namespace App\Strategies\CommandStrategies;


use App\Message;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class UpdateMessageStrategy implements CommandInterface
{

    private $rules = [
        'id' => 'required|int|exists:messages,id',
        'message' => 'required|string|max:255',
        'channel_id' => 'required|int|exists:channels,id',
        'user_id' => 'required|int',
    ];

    public function command(Request $request): JsonResponse
    {

        try {

            return $this->tryToUpdateMessage($request);
        } catch (\Exception $e) {

            Log::debug($e->getMessage());
            return response()->json(
                ['content' => [], 'error_messages' => ['error' => $e->getMessage()]], Response::HTTP_BAD_REQUEST
            );
        }
    }

    private function tryToUpdateMessage(Request $request) : JsonResponse
    {

        $validator = Validator::make($request->all(), $this->rules);
        if($validator->fails()){

            Log::debug($validator->errors()->toJson());
            return response()->json(
                ['content' => [], 'error_messages' => $validator->errors()], Response::HTTP_BAD_REQUEST
            );
        } else {

            $message = $this->updateMessage($request);
            return response()->json(
                ['content' => ['message' => $message], 'error_messages' => []], Response::HTTP_OK
            );
        }
    }

    private function updateMessage(Request $request): Message
    {
        $message = Message::find($request->get('id'));
        $message->__set('message', $request->get('message'));
        $message->__set('channel_id', $request->get('channel_id'));
        $message->__set('user_id', $request->get('user_id'));
        $message->update();
        return $message;
    }
}
