<?php


namespace App\Strategies\CommandStrategies;


use App\Moderator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class CreateModeratorStrategy implements CommandInterface
{

    private $rules = [
        'user_id' => 'required|int',
        'channel_id' => 'required|int|exists:channels,id',
    ];

    public function command(Request $request): JsonResponse
    {

        try {

            return $this->tryToCreate($request);
        } catch (\Exception $e) {

            Log::debug($e->getMessage());
            return response()->json(
                ['content' => [], 'error_messages' => ['error' => $e->getMessage()],], Response::HTTP_BAD_REQUEST
            );
        }
    }

    private function tryToCreate(Request $request) : JsonResponse
    {

        $validator = Validator::make($request->all(), $this->rules);
        if($validator->fails()){

            Log::debug($validator->errors()->toJson());
            return response()->json(
                ['content' => [], 'error_messages' => $validator->errors()], Response::HTTP_BAD_REQUEST
            );
        } else {

            $moderator = $this->create($request);
            return response()->json(
                ['content' => ['moderator' => $moderator], 'error_messages' => []], Response::HTTP_OK
            );
        }
    }

    private function create(Request $request) : Moderator
    {

        $moderator = new Moderator();
        $moderator->__set('channel_id', $request->get('channel_id'));
        $moderator->__set('user_id', $request->get('user_id'));
        $moderator->save();
        return $moderator;
    }
}
