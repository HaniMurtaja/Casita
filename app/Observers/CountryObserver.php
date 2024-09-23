<?php

namespace App\Observers;

use App\Models\Country;
use GuzzleHttp\Client;

class CountryObserver
{
    public function created(Country $country)
    {
        $this->sendWebhook($country, 'create', []);
    }

    public function updated(Country $country)
    {
        $changes = $this->detectChanges($country);
        $this->sendWebhook($country, 'edit', $changes);
    }

    // Detect changed fields
    private function detectChanges(Country $country)
    {
        $changes = [];
        foreach ($country->getChanges() as $field => $newValue) {
            $original = $country->getOriginal($field);
            $changes[$field] = [
                'old' => $original,
                'new' => $newValue
            ];
        }
        return $changes;
    }

    // Send the WebHook 
    private function sendWebhook(Country $country, $updateType, $changes)
    {
        $callbackUrl = request()->header('Callback-Url');

        if ($callbackUrl) {
            $client = new Client();
            $data = [
                'update_type' => $updateType,
                'country_id' => $country->id,
                'changes' => $changes,
            ];

            try {
                $client->post($callbackUrl, [
                    'json' => $data,
                ]);
            } catch (\Exception $e) {
                \Log::error('Failed to send webhook: ' . $e->getMessage());
            }
        }
    }
}

