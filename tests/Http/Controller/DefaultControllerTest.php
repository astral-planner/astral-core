<?php

declare(strict_types=1);

namespace App\Tests\Http\Controller;

it('should return a successful response', function () {
    $client = static::createClient();
    $client->request('GET', '/api/ping');

    expect($client->getResponse()->getStatusCode())->toBe(200);
});
