<?php

namespace Tests\Datasets;

use Tests\TestCase;

final class MockTypeStrings extends TestCase
{

    public static function routes(): array
    {
        return [
            [
                'method' => 'GET',
                'uri' => 'api.types.index'
            ],
            [
                'method' => 'GET',
                'uri' => 'api.types.show',
                'parameters' => ['invalid-uuid']
            ],
            [
                'method' => 'POST',
                'uri' => 'api.types.store',
            ],
            [
                'method' => 'PUT',
                'uri' => 'api.types.update',
                'parameters' => ['invalid-uuid']
            ],
            [
                'method' => 'DELETE',
                'uri' => 'api.types.destroy',
                'parameters' => ['invalid-uuid']
            ],
        ];
    }

    public static function nameOfTypes(): array
    {
        return [
            ['radio'],
            ['checkbox']
        ];
    }

}