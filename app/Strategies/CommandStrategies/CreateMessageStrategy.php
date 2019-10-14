<?php


namespace App\Strategies\CommandStrategies;


use App\Message;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class CreateMessageStrategy implements CommandInterface
{

    private $rules = [
        'message' => 'required|string|max:255',
        'channel_id' => 'required|int|exists:channels,id',
        'user_id' => 'required|int',
    ];

    public function command(Request $request): JsonResponse
    {

        try {

            return $this->tryToCreateMessage($request);
        } catch (\Exception $e) {

            Log::debug($e->getMessage());
            return response()->json(
                ['content' => [], 'error_messages' => ['error' => $e->getMessage()]], Response::HTTP_BAD_REQUEST
            );
        }
    }

    private function tryToCreateMessage(Request $request) : JsonResponse
    {

        $validator = Validator::make($request->all(), $this->rules);
        if($validator->fails()){

            Log::debug($validator->errors()->toJson());
            return response()->json(
                ['content' => [], 'error_messages' => $validator->errors()], Response::HTTP_BAD_REQUEST
            );
        } else {

            $message = $this->createMessage($request);
            return response()->json(
                ['content' => ['message' => $message], 'error_messages' => []], Response::HTTP_OK
            );
        }
    }

    private function createMessage(Request $request): Message
    {
        $message = new Message();
        $message->__set('message', $request->get('message'));
        $message->__set('channel_id', $request->get('channel_id'));
        $message->__set('user_id', $request->get('user_id'));
        $message->save();
        return $message;
    }
}
