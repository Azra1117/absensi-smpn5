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

    if (app()->environment('production')) {

        $path = storage_path('app/google/credentials.json');

        if (!file_exists($path)) {

            if (!is_dir(dirname($path))) {
                mkdir(dirname($path), 0777, true);
            }

            file_put_contents(
                $path,
                env('GOOGLE_CREDENTIALS_JSON')
            );
        }

        $client->setAuthConfig($path);

    } else {

        $client->setAuthConfig(
            storage_path('app/google/credentials.json')
        );

    }

    $this->service = new Sheets($client);

    $this->spreadsheetId = env('GOOGLE_SPREADSHEET_ID');
}
}