<?php

declare(strict_types=1);

namespace App\Http;

/**
 * Resposta pronta: corpo, status HTTP e cabeçalhos.
 * O servidor chama send(); o build estático só lê o $body.
 */
final readonly class Response
{
    /** @param array<string, string> $headers */
    public function __construct(
        public string $body,
        public int $status = 200,
        public array $headers = ['Content-Type' => 'text/html; charset=UTF-8'],
    ) {}

    public function send(): void
    {
        http_response_code($this->status);

        foreach ($this->headers as $name => $value) {
            header("{$name}: {$value}");
        }

        echo $this->body;
    }
}
