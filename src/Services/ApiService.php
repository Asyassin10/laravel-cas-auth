<?php

namespace YassineAs\CasAuth\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ApiService
{
    /**
     * Check if a user is authorized.
     *
     * @param string $uniqueId
     * @return bool
     */
    public function isAuthorized(string $uniqueId): bool
    {
        try {
            $endpoint = config('cas.api_endpoint') . '/authorize';
            $apiKey = config('cas.api_key');

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Accept' => 'application/json',
            ])->post($endpoint, [
                'user_id' => $uniqueId,
            ]);

            if ($response->successful()) {
                $data = $response->json();
                return $data['authorized'] ?? false;
            }

            Log::error('API authorization failed', [
                'status' => $response->status(),
                'response' => $response->body(),
            ]);

            return false;
        } catch (\Exception $e) {
            Log::error('API authorization exception', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return false;
        }
    }

    /**
     * Get user details from the API.
     *
     * @param string $uniqueId
     * @return array
     */
    public function getUserDetails(string $uniqueId): array
    {
        try {
            $endpoint = config('cas.api_endpoint') . '/users/' . $uniqueId;
            $apiKey = config('cas.api_key');

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Accept' => 'application/json',
            ])->get($endpoint);

            if ($response->successful()) {
                return $response->json()['data'] ?? [];
            }

            Log::error('API get user details failed', [
                'status' => $response->status(),
                'response' => $response->body(),
            ]);

            return [];
        } catch (\Exception $e) {
            Log::error('API get user details exception', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return [];
        }
    }
}