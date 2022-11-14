<?php

namespace Tests\Datasets;

use Tests\TestCase;

final class MockTypeStrings extends TestCase
{

    /**
     * @return array<int, array<int, string>>
     */
    public static function getRoutes(): array
    {
        return [
            ['api.types.index'],
            ['api.types.show', 'invalid-uuid']
        ];
    }

    /**
     * @return array<int, array<int, string>>
     */
    public static function postRoutes(): array
    {
        return [
            ['api.types.store']
        ];
    }

    /**
     * @return array<int, array<int, string>>
     */
    public static function putRoutes(): array
    {
        return [
            ['api.types.update', 'invalid-uuid']
        ];
    }

    /**
     * @return array<int, array<int, string>>
     */
    public static function nameOfTypes(): array
    {
        return [
            ['radio'],
            ['checkbox']
        ];
    }

}