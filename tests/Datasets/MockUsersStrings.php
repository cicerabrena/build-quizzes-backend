<?php

namespace Tests\Datasets;

use Tests\TestCase;

final class MockUsersStrings extends TestCase
{

    public static function routes(): array
    {
        return [
            [
                'method' => 'PUT',
                'uri' => 'api.users.update',
            ],
            [
                'method' => 'DELETE',
                'uri' => 'api.users.destroy',
            ],
        ];
    }

    public static function routesWithParameters(): array
    {
        return [
            [
                'method' => 'GET',
                'uri' => 'api.users.show',
                'parameters' => ['invalid-uuid']
            ],
            [
                'method' => 'PUT',
                'uri' => 'api.users.update',
                'parameters' => ['invalid-uuid']
            ],
            [
                'method' => 'DELETE',
                'uri' => 'api.users.destroy',
                'parameters' => ['invalid-uuid']
            ],
        ];
    }
}