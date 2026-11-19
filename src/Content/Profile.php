<?php

declare(strict_types=1);

namespace App\Content;

/**
 * Quem você é: nome, bio, texto do "Sobre", currículo e redes.
 * Textos traduzidos usam ['pt' => '...', 'en' => '...'].
 */
final readonly class Profile
{
    /**
     * @param array<string, string> $role
     * @param array<string, string> $bio
     * @param list<array<string, string>> $about parágrafos do "Sobre"
     * @param list<SocialLink> $links
     */
    public function __construct(
        public string $name,
        public string $handle,
        public array $role,
        public array $bio,
        public array $about,
        public string $avatar,
        public array $links,
        public ?string $cv = null,
        public ?string $email = null,
    ) {}

    /** @return list<SocialLink> */
    public function visibleLinks(): array
    {
        return array_values(array_filter(
            $this->links,
            fn (SocialLink $link): bool => $link->visible,
        ));
    }
}
