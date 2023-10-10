<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use GuzzleHttp\Client;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void 
    {
		$this->app->singleton('GuzzleHttp\Client', function () {
			return new Client([
				'base_uri' => 'https://sanignaciouniversity.instructure.com',
				'connect_timeout' => 8.14,
				'timeout' => 34.0,
				'headers' => [
					'Authorization' => 'Bearer 14332~7J7l3QwFR1OC8BJ5gXxFdgBtBtw2PUXdpdPnIIQL8MH0K9tgCiPxZWzq2SFRJvz6',
				],

			]);
		});
	}

    public function boot(): void
    {
        //
    }
}
