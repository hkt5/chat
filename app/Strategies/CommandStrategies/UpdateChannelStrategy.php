<?php


namespace App\Strategies\CommandStrategies;


use App\Channel;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class UpdateChannelStrategy implements CommandInterface
{
    private $rules = [
        'id' => 'required|int|exists:channels,id',
        'creator_id' => 'required|int',
        'name' => 'required|string|unique:channels,name',
    ];

    public function command(Request $request): JsonResponse
    {
        try {

            return $this->tryToUpdateChannel($request);
        } catch (\Exception $e) {

            Log::debug($e->getMessage());
            return response()->json(
                ['content' => [], 'error_messages' => ['error' => $e->getMessage()]], Response::HTTP_BAD_REQUEST
            );
        }
    }

    private function tryToUpdateChannel(Request $request) : JsonResponse
    {

        $validator = Validator::make($request->all(), $this->rules);
        if($validator->fails()){

            return response()->json(
                ['content' => [], 'error_messages' => $validator->errors()], Response::HTTP_BAD_REQUEST
            );
        } else {

            $channel = $this->updateChannel($request);
            return response()->json(
                ['content' => ['channel' => $channel, 'error_messages' => null], Response::HTTP_OK]
            );
        }
    }

    /**
     * @param Request $request
     * @return mixed
     */
    private function updateChannel(Request $request)
    {
        $channel = Channel::find($request->get('id'));
        $channel->__set('name', $request->get('name'));
        $channel->__set('creator_id', $request->get('creator_id'));
        $channel->__set('updated_at', Carbon::now());
        $channel->update();
        return $channel;
    }
}
