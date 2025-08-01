<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;

class WhatsappHelper
{
    protected static function apiUrl()
    {
        return rtrim(env('WHATSAPP_API_URL'), '/');
    }

    protected static function client()
    {
        return Http::withHeaders([
            'Authorization' => 'Basic YWRtaW46ODE0NTA1NzRAaGtyV1A=',
            'Accept' => 'application/json',
        ]);
    }

    public static function startSession($apiKey)
    {
        return self::client()
            ->get(self::apiUrl() . "/start-session", [
                'instanceKey' => $apiKey
            ])
            ->json();
    }

    public static function getQr($apiKey)
    {
        return self::client()
            ->get(self::apiUrl() . "/qr", [
                'instanceKey' => $apiKey
            ])
            ->json();
    }

    public static function sendMessage($apiKey, $number, $message)
    {
        return self::client()
            ->post(self::apiUrl() . "/send-message?instanceKey={$apiKey}", [
                'number' => $number,
                'message' => $message,
            ])
            ->json();
    }

    public static function sendFileUrl($apiKey, $number, $fileUrl, $caption, $fileName = 'file.pdf')
    {
        return self::client()
            ->post(self::apiUrl() . "/send-file-url?instanceKey={$apiKey}", [
                'number' => $number,
                'fileUrl' => $fileUrl,
                'caption' => $caption,
                'fileName' => $fileName,
            ])
            ->json();
    }

    public static function logout($apiKey)
    {
        return self::client()
            ->get(self::apiUrl() . "/logout", [
                'instanceKey' => $apiKey
            ])
            ->json();
    }
}
