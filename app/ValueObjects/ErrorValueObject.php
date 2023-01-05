<?php

namespace App\ValueObjects;

use App\Contracts\ValueObjectContract;

final class ErrorValueObject implements ValueObjectContract
{
    public function __construct(public mixed $messages)
    {
    }

    /**
     * @return array<mixed>
     */
    public function toArray(): array
    {
        return $this->mountErrors();
    }

    private function mountErrors(): array
    {
        if (is_array($this->messages)) {
            return $this->mountArray();
        }

        return $this->mountSimpleArray();
    }

    private function mountArray(): array
    {
        return [
            'errors' => $this->messages()
        ];
    }

    private function messages(): array
    {
        /** @var array */
        $arrayMessages = (array) $this->messages;

        if (array_is_list($arrayMessages)) {
            return array_map(fn($message) => ['message' => $message], $arrayMessages);
        }

        $messages = [];

        $keys = array_keys($arrayMessages);

        foreach ($keys as $key) {
            $messages = array_merge($messages, [ $key => [ 'message' => $arrayMessages[$key] ] ]);
        }

        return $messages;
    }

    private function mountSimpleArray(): array
    {
        return [
            'errors' => [
                'message' => $this->messages
            ]
        ];
    }
}