<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;

class PayHeroService
{
    protected string $baseUrl;
    protected string $authToken;
    protected int $channelId;
    protected string $callbackUrl;

    public function __construct()
    {
        $this->baseUrl = Config::get('payhero.base_url');
        $this->authToken = Config::get('payhero.basic_auth_token');
        $this->channelId = Config::get('payhero.channel_id');
        $this->callbackUrl = Config::get('payhero.callback_url');
    }
    /**
     * Verifies an incoming callback request from PayHero.
     * The documentation specifies security via a Bearer token in the Authorization header.
     *
     * @param \Illuminate\Http\Request $request
     * @return bool
     */
    public function verifyCallbackToken(Request $request): bool
    {
        $bearerToken = $request->bearerToken();
        $expectedToken = $this->authToken;

        if (!$bearerToken || !$expectedToken) {
            return false;
        }

        return hash_equals($expectedToken, $bearerToken);
    }

    /**
     * Send MPESA STK Push via PayHero.
     */
    public function sendStkPush(int $amount, string $phone, string $externalReference, string $customerName): array
    {
        $phone = $this->formatPhoneNumber($phone);

        $payload = [
            "amount" => $amount,
            "phone_number" => $this->formatPhoneNumber($phone),
            "channel_id" => $this->channelId,
            "provider" => "m-pesa",
            "external_reference" => $externalReference,
            "customer_name" => $customerName,
            "callback_url" => route('payhero.callback')
        ];

        try {
            $response = Http::withHeaders([
                'Authorization' => $this->authToken,
                'Accept'        => 'application/json',
                'Content-Type'  => 'application/json'
            ])->post("{$this->baseUrl}/payments", $payload);
            $response->throw();
            return $response->json();
        } catch (\Throwable $e) {
            Log::error('PayHero STK Push Error', [
                'exception' => $e->getMessage(),
                'payload' => $payload,
            ]);
            return [
                'status' => 'error',
                'message' => 'STK Push request failed'
            ];
        }
    }

    public function sendWhatsappMessage(string $phone, string $message): array
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => $this->authToken,
                'Accept'        => 'application/json',
            ])->post("{$this->baseUrl}/whatsapp/sendText", [
                'phone_number'   => $phone,
                'message' => $message,
                'session' => "" // todo: Add Session name
            ]);

            $response->throw();
            return $response->json();
        } catch (\Throwable $e) {
            Log::error('PayHero WhatsApp send failed', ['error' => $e->getMessage()]);
            return ['status' => 'error', 'message' => 'WhatsApp send failed'];
        }
    }

    /**
     * Formats phone number to 254... format.
     *
     * @param string $phone
     * @return string
     */
    private function formatPhoneNumber(string $phone): string
    {
        $phone = preg_replace('/\s+/', '', $phone); // Remove whitespace
        if (Str::startsWith($phone, '07') || Str::startsWith($phone, '01')) {
            return '254' . substr($phone, 1);
        }
        if (Str::startsWith($phone, '+254')) {
            return substr($phone, 1);
        }
        return $phone; // Assume it's already in the correct format
    }

}
