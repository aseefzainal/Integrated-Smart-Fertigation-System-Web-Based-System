<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class SmsService {
    protected $apiUrl = 'https://terminal.adasms.com/api/v1/send';

    public function sendSms($phone, $message, $callbackUrl = null, $leadId = null, $preview = 1, $sendAt = null)
    {
        $response = Http::asMultipart()->post($this->apiUrl, [
            '_token' => env('SMS_API_TOKEN'),
            'phone' => $phone,
            'message' => $message,
            'callback_url' => $callbackUrl ?? 'https://myserver.com.my/callback_receive',
            'preview' => $preview,
            'lead_id' => $leadId ?? 'LEAD_ID',
            'send_at' => $sendAt
        ]);

        return $response->json(); // or handle the response as needed
    }
}