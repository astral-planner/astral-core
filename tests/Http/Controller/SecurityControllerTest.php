<?php

declare(strict_types=1);

namespace Astral\Tests\Http\Controller;

use Symfony\Component\BrowserKit\AbstractBrowser;

it('should be able to register a user', function () {
    /** @var AbstractBrowser $client */
    $client = static::createClient();

    $client->request('POST', '/api/register');

    expect($client->getResponse()->getStatusCode())->toBe(200);
    expect($client->getResponse()->getContent())->toBeJson();
    expect($client->getResponse()->getContent())->toHaveProperty('username');
});
