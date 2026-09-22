<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WhatsAppService
{
    protected $apiUrl;
    protected $apiToken;

    public function __construct()
    {
        $this->apiUrl = env('WA_API_URL');
        $this->apiToken = env('WA_API_TOKEN');
    }

    /**
     * Send a standard message via WhatsApp API Provider.
     */
    public function sendMessage($phone, $message)
    {
        // For testing/mocking when in disabled or incomplete config
        if (!$this->apiUrl || !$this->apiToken) {
            Log::info("WhatsApp Mocking: would have sent to $phone. Message: $message");
            return true;
        }

        try {
            // Adjust the payload based on the specific provider you end up using.
            // Example format using a generic wa provider format:
            $response = Http::withHeaders([
                'Authorization' => "Bearer {$this->apiToken}"
            ])->post($this->apiUrl . '/send', [
                'target' => $phone,
                'message' => $message,
            ]);

            return $response->successful();
        } catch (\Exception $e) {
            Log::error("WhatsApp Notification failed: " . $e->getMessage());
            return false;
        }
    }
}
