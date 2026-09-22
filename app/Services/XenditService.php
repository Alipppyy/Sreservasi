<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class XenditService
{
    protected $apiKey;
    protected $baseUrl = 'https://api.xendit.co';

    
    public function __construct()
    {
        $this->apiKey = env('XENDIT_API_KEY');
    }

    /**
     * Create an Invoice directly via Xendit REST API for QRIS.
     */
    public function createInvoice($externalId, $amount, $customerEmail, $description)
    {
        if (!$this->apiKey) {
            Log::info("Xendit Mocking: would have created invoice $externalId for Rp $amount.");
            // Mock response
            return [
                'id' => 'mock_inv_' . time(),
                'invoice_url' => 'http://localhost/mock-payment/' . $externalId,
            ];
        }

        try {
            $response = Http::withBasicAuth($this->apiKey, '')
                ->post($this->baseUrl . '/v2/invoices', [
                    'external_id' => $externalId,
                    'amount' => $amount,
                    'description' => $description,
                    'payer_email' => $customerEmail,
                    'invoice_duration' => 300, // 5 minutes (300 seconds) expiry for QRIS
                    'payment_methods' => ['QRIS']
                ]);

            if ($response->successful()) {
                return $response->json();
            } else {
                Log::error("Xendit Error: ", $response->json());
                return null;
            }
        } catch (\Exception $e) {
            Log::error("Xendit Exception: " . $e->getMessage());
            return null;
        }
    }
}
