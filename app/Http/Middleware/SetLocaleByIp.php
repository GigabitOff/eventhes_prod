<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SetLocaleByIp
{
    public function handle(Request $request, Closure $next)
    {
        $ip = $request->ip();

        // Retrieve geolocation data from IP address
        $response = Http::get("https://ipwho.is/{$ip}");

        if ($response->successful()) {
            $data = $response->json();

            // Ensure country code is in uppercase
            $countryCode = strtoupper($data['country_code']);

            // Example: determine locale based on country code
            $locale = $this->getLocaleByCountryCode($countryCode);

            // Set locale for the request
            app()->setLocale($locale);
        }

        return $next($request);
    }

    private function getLocaleByCountryCode($countryCode)
    {
        // Define mapping of country codes to locales
        $locales = [
            'UA' => 'ua',
            'EN' => 'en',
            'RU' => 'ru',
            'PL' => 'pl',
            // Add more mappings as needed
        ];

        // Default to English if country code not found
        return $locales[$countryCode] ?? 'en';
    }
}
