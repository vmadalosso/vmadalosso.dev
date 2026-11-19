# vmadalosso.dev

Site pessoal e portfólio de Vitor Madalosso, em português e inglês.

PHP moderno, **sem framework** e **sem banco de dados**. O conteúdo fica em arquivos versionados no git, e o build gera HTML estático para publicar de graça.

## Stack

| Camada | Escolha |
| --- | --- |
| Linguagem | PHP 8.4 com `strict_types`, enums, classes `readonly`, `match` e argumentos nomeados |
| Estrutura | Composer só para o autoload (PSR-4). Nenhuma dependência em produção |
| Templates | PHP puro (`views/`), com `e()` escapando todo dado dinâmico |
| CSS | Tailwind CSS v4 pelo CLI standalone (`bin/tailwind`): um binário, sem Node |
| Conteúdo | `content/*.php`, que devolvem objetos prontos |
| JavaScript | Só o botão de tema claro/escuro (~15 linhas) |
| Deploy | `dist/` estático (Cloudflare Pages) |

## Rodando localmente

```bash
composer install   # gera o autoload
composer dev       # http://localhost:8000 (servidor do PHP + Tailwind em modo watch)
```

Com o Herd: `herd link vmadalosso` serve o site em `http://vmadalosso.test`. Nesse caso, deixe o CSS compilando com `bin/tailwind --watch=always`.

## Editando o conteúdo

| O quê | Onde |
| --- | --- |
| Bio, "Sobre", redes, currículo, e-mail | `content/profile.php` |
| Projetos (destaque, "construindo agora" e outros) | `content/projects.php` |
| Livros | `content/books.php` |
| Tecnologias | `content/stack.php` (ícone em `resources/icons/`, do [Simple Icons](https://simpleicons.org)) |
| Setup | `content/setup.php` |
| Textos da interface | `lang/pt.php` e `lang/en.php` |
| Currículo em PDF | `public/cv/vitor-madalosso.pdf` |

Os textos traduzidos usam `['pt' => '...', 'en' => '...']`.

## Como uma página é montada

1. `public/index.php` recebe a requisição (front controller).
2. `App::handle()` separa o idioma (`/en/...`) e escolhe a página com um `match` no caminho.
3. `View` renderiza `views/pages/<página>.php` e depois a envolve no `views/layout.php`.
4. Sai uma `Response` com status, cabeçalhos e HTML.

O build (`bin/build.php`) usa o mesmo `App::handle()` para cada URL de `App::staticPages()` e grava o resultado em `dist/`. Então o que você vê no `composer dev` é o que vai pro ar.

```
bin/          dev, tailwind, build.php
content/      o "banco": perfil, projetos, livros, stack, setup
lang/         textos da interface (pt, en)
public/       raiz web: index.php, fontes, imagens, favicon
resources/    CSS do Tailwind e ícones SVG
src/          App, Content/, I18n/, View/, Http/
views/        layout, páginas e partials
```

## Build e deploy

```bash
composer build     # CSS minificado + dist/
```

A pasta `dist/` é HTML estático e pode ir para qualquer host. Como o domínio está na Cloudflare, o caminho natural é o Cloudflare Pages.

## Decisões

- **Sem framework:** o site tem poucas páginas e nenhuma regra de negócio. Roteador, views e leitura do conteúdo cabem em poucas centenas de linhas legíveis.
- **Sem banco:** conteúdo muda pouco e quem edita é dev. Arquivo no git dá versionamento de graça, sem migration nem backup.
- **Cores medidas:** todo par de cor passa no WCAG AA nos dois temas. Texto fica acima de 15:1, texto secundário acima de 6,5:1 e bordas de controle acima de 3:1. Mexeu numa cor em `resources/css/app.css`? Meça de novo.
- **Fontes self-hosted:** Newsreader (títulos e livros) e Instrument Sans (texto), só com o subconjunto latino, somam ~77 KB. Nenhuma chamada ao Google a cada visita.
