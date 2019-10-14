<?php


namespace App\Strategies\CommandStrategies;


use App\Channel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class DeleteChannelStrategy implements CommandInterface
{

    private $rules = [
        'id' => 'required|int|exists:channels,id',
        'creator_id' => 'required|int|exists:channels,creator_id',
    ];

    public function command(Request $request): JsonResponse
    {

        try {

            return $this->tryToDelete($request);
        } catch (\Exception $e) {

            Log::debug($e->getMessage());
            return response()->json(
                ['content' => [], 'error_messages' => ['error' => $e->getMessage()]], Response::HTTP_BAD_REQUEST
            );
        }
    }

    private function tryToDelete(Request $request) : JsonResponse
    {

        $validator = Validator::make($request->all(), $this->rules);
        if($validator->fails()){

            Log::debug($validator->errors()->toJson());
            return response()->json(
                ['content' => [], 'error_messages' => $validator->errors()], Response::HTTP_BAD_REQUEST
            );
        } else {

            $channel = $this->deleteChannel($request);
            return response()->json(
                ['content' => ['channel' => $channel], 'error_messages' => []], Response::HTTP_OK
            );
        }
    }

    /**
     * @param Request $request
     * @return mixed
     */
    private function deleteChannel(Request $request)
    {
        $channel = Channel::find($request->get('id'));
        $channel->delete();
        return $channel;
    }
}
