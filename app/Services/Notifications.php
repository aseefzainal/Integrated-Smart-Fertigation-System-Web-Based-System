<?php

namespace App\Services;

use App\Models\Setting;
use App\Models\SensorNotification;
use Illuminate\Support\Facades\Http;

// class SmsService {
class Notifications
{
    protected $smsApiUrl = 'https://terminal.adasms.com/api/v1/send';
    protected $whatsappApiUrl = 'https://onsend.io/api/v1/send';
    protected $smsApiToken;
    protected $whatsappApiToken;

    public function __construct()
    {
        $this->smsApiToken = env('SMS_API_TOKEN');
        $this->whatsappApiToken = env('WHATSAPP_API_TOKEN');

        dump('WhatsApp API Token: ' . $this->smsApiToken);
    }

    public function sendSms($phone, $message, $callbackUrl = null, $leadId = null, $preview = 1, $sendAt = null)
    {
        $response = Http::asMultipart()->post($this->smsApiUrl, [
            // '_token' => $this->smsApiToken,
            '_token' => 'jJuIg1mrMDUpmYpTAycbiKSZJxK3cD6q',
            'phone' => $phone,
            'message' => $message,
            'callback_url' => $callbackUrl ?? 'https://myserver.com.my/callback_receive',
            'preview' => $preview,
            'lead_id' => $leadId ?? 'LEAD_ID',
            'send_at' => $sendAt
        ]);

        // Log the full response
        if ($response->successful()) {
            dump('SMS sent successfully: ' . $response->body());
        } else {
            dump('Error sending SMS: ' . $response->status() . ' - ' . $response->body());
        }

        return $response; // Consider returning the response for further handling
        // return $response->json();
    }

    public function sendWhatsApp($phone, $message)
    {
        $data = [
            'phone_number' => $phone,
            'message' => $message,
        ];

        $response = Http::accept('application/json')
            // ->withToken($this->whatsappApiToken)
            ->withToken("cad8ac2b3ed98c14b7f90f3fed8b7aa1808eb8d68db8a0281314651b75b37287")
            ->post($this->whatsappApiUrl, $data);

        // Log the full response
        if ($response->successful()) {
            dump('WhatsApp sent successfully: ' . $response->body());
        } else {
            dump('Error sending WhatsApp: ' . $response->status() . ' - ' . $response->body());
        }

        return $response; // Consider returning the response for further handling
    }

    public function ResetNotification()
    {
        $notifications = SensorNotification::where('is_sent', 1)->get();

        if ($notifications->isNotEmpty()) {
            $countdownSetting = Setting::where('name', 'countdown')->first();

            foreach ($notifications as $notification) {
                $countdown = $notification->user->settings()->where('setting_id', $countdownSetting->id)->first();
                // $countdown = UserSetting::where('setting_id', $countdownSetting->id)->first();
                $durationInMinutes = $countdown->pivot->value;

                $timeElapsed = now()->diffInMinutes($notification->updated_at) * -1; // or updated_at, based on your logic

                // Check if the elapsed time is greater than or equal to the duration
                if ($timeElapsed >= $durationInMinutes) {
                    // Update is_sent to true, since the countdown has completed
                    $notification->is_sent = false;
                    $notification->save();
                }
            }
        }
    }
}
