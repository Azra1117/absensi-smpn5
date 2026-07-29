<?php

namespace App\Services;

use Google\Client;
use Google\Service\Sheets;
use Google\Service\Sheets\ValueRange;

class GoogleSheetService
{
    protected Sheets $service;
    protected string $spreadsheetId;

    public function __construct()
    {
        $client = new Client();

        $client->setApplicationName('Absensi SMPN 5');
        $client->setScopes([Sheets::SPREADSHEETS]);

        $client->setAuthConfig(
            config('services.google.credentials')
        );

        $this->service = new Sheets($client);

        $this->spreadsheetId = env('GOOGLE_SPREADSHEET_ID');
    }

    public function append(array $row)
    {
        $body = new ValueRange([
            'values' => [$row]
        ]);

        $this->service->spreadsheets_values->append(
            $this->spreadsheetId,
            'Absensi SMPN 5!A:G',
            $body,
            [
                'valueInputOption' => 'RAW'
            ]
        );
    }
}