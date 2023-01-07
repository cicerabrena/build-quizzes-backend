<?php

namespace App\ValueObjects;

use App\Contracts\ValueObjectContract;

final class ErrorValueObject implements ValueObjectContract
{
    private bool $hasKeys = true;

    public function __construct(public mixed $messages)
    {
    }

    public function setHasKeys(bool $value): void
    {
        $this->hasKeys = $value;
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

        if ($this->hasKeys) {
            return $this->mountArrayWithKeys($arrayMessages);
        }

        return array_map(fn($message) => ['message' => $message], $arrayMessages);
    }

    private function mountArrayWithKeys(array $arrayMessages): array
    {
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