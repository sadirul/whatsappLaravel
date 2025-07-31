<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Helpers\WhatsappHelper;

class WhatsappApiController extends Controller
{
    public function startSession(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'instanceKey' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first(),
                'data' => null,
            ], 422);
        }

        $response = WhatsappHelper::startSession($request->instanceKey);

        return $response;
    }

    public function getQr(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'instanceKey' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first(),
                'data' => null,
            ], 422);
        }

        $response = WhatsappHelper::getQr($request->instanceKey);

        return $response;
    }

    public function sendMessage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'instanceKey' => 'required|string',
            'number' => 'required|string',
            'message' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first(),
                'data' => null,
            ], 422);
        }

        $response = WhatsappHelper::sendMessage(
            $request->instanceKey,
            $request->number,
            $request->message
        );

        return $response;
    }

    public function sendFile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'instanceKey' => 'required|string',
            'number' => 'required|string',
            'fileUrl' => 'required|url',
            'caption' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first(),
                'data' => null,
            ], 422);
        }

        $response = WhatsappHelper::sendFileUrl(
            $request->instanceKey,
            $request->number,
            $request->fileUrl,
            $request->caption
        );

        return $response;
    }

    public function logout(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'instanceKey' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first(),
                'data' => null,
            ], 422);
        }

        $response = WhatsappHelper::logout($request->instanceKey);

        return $response;
    }

}
