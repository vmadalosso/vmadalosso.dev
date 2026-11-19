<?php

declare(strict_types=1);

namespace App\Content;

/**
 * Um projeto do portfólio. Textos traduzidos usam ['pt' => '...', 'en' => '...'].
 */
final readonly class Project
{
    /**
     * @param string|array<string, string> $name
     * @param array<string, string> $summary
     * @param list<string> $stack
     */
    public function __construct(
        public string $slug,
        public string|array $name,
        public ProjectKind $kind,
        public ProjectStatus $status,
        public Placement $placement,
        public int $year,
        public array $summary,
        public array $stack,
        /** Site no ar. */
        public ?string $url = null,
        /** Repositório público. */
        public ?string $repo = null,
    ) {}

    /** Link principal: o site no ar ou, se não houver, o código. */
    public function primaryUrl(): ?string
    {
        return $this->url ?? $this->repo;
    }

    /** Domínio do site para exibir no card, sem "https://" nem "www.". */
    public function displayUrl(): ?string
    {
        if ($this->url === null) {
            return null;
        }

        $host = parse_url($this->url, PHP_URL_HOST) ?: $this->url;

        return (string) preg_replace('/^www\./', '', $host);
    }
}
