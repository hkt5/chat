<?php


namespace App\Strategies\CommandStrategies;


use App\Channel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class CreateChannelStrategy implements CommandInterface
{

    private $rules = [
        'creator_id' => 'required|int',
        'name' => 'required|string|unique:channels,name',
    ];

    public function command(Request $request): JsonResponse
    {

        try {

            return $this->tryToCreateChannel($request);
        } catch (\Exception $e) {

            Log::debug($e->getMessage());
            return response()->json(
                ['content' => [], 'error_messages' => ['error' => $e->getMessage()]], Response::HTTP_BAD_REQUEST
            );
        }
    }

    private function tryToCreateChannel(Request $request) : JsonResponse
    {

        $validator = Validator::make($request->all(), $this->rules);
        if($validator->fails()){

            Log::debug($validator->errors()->toJson());
            return response()->json(
                ['content' => [], 'error_messages' => $validator->errors()], Response::HTTP_BAD_REQUEST
            );
        } else {

            $channel = $this->createChannel($request);
            return response()->json(
                ['content' => ['channel' => $channel], 'error_messages' => []], Response::HTTP_OK
            );
        }
    }

    /**
     * @param Request $request
     * @return Channel
     */
    private function createChannel(Request $request): Channel
    {
        $channel = new Channel();
        $channel->__set('name', $request->get('name'));
        $channel->__set('creator_id', $request->get('creator_id'));
        $channel->save();
        return $channel;
    }
}
