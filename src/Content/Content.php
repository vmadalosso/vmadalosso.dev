<?php

declare(strict_types=1);

namespace App\Content;

/**
 * Todo o conteúdo do site, carregado dos arquivos em content/.
 * É o "banco de dados": arquivos PHP versionados no git, sem servidor nem migration.
 */
final readonly class Content
{
    /**
     * @param list<Project> $projects
     * @param list<Book> $books
     * @param list<Tech> $stack
     * @param list<SetupItem> $setup
     */
    public function __construct(
        public Profile $profile,
        public array $projects,
        public array $books,
        public array $stack,
        public array $setup,
    ) {}

    /** Cada arquivo de content/ devolve objetos prontos (veja content/projects.php). */
    public static function load(string $dir): self
    {
        return new self(
            profile: require "{$dir}/profile.php",
            projects: require "{$dir}/projects.php",
            books: require "{$dir}/books.php",
            stack: require "{$dir}/stack.php",
            setup: require "{$dir}/setup.php",
        );
    }

    /** @return list<Project> */
    public function projects(Placement $placement): array
    {
        return array_values(array_filter(
            $this->projects,
            fn (Project $project): bool => $project->placement === $placement,
        ));
    }

    /** @return list<Book> */
    public function books(Shelf $shelf): array
    {
        return array_values(array_filter(
            $this->books,
            fn (Book $book): bool => $book->shelf === $shelf,
        ));
    }

    /** @return list<SetupItem> */
    public function setup(SetupCategory $category): array
    {
        return array_values(array_filter(
            $this->setup,
            fn (SetupItem $item): bool => $item->category === $category,
        ));
    }
}
