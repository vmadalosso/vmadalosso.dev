<?php

declare(strict_types=1);

use App\Content\Book;
use App\Content\Shelf;

/*
 * Leituras. Título traduzido usa ['pt' => ..., 'en' => ...].
 * Dá para acrescentar uma frase de "por que recomendo" com note: ['pt' => ..., 'en' => ...].
 *
 * Ordem dos técnicos: o C abre a lista (a nota dele pede isso), depois as linguagens
 * da web e, por último, Close to the Machine, que é memória, não manual.
 */

return [
    new Book(['pt' => 'C Completo e Total', 'en' => 'C: The Complete Reference'], 'Herbert Schildt', Shelf::Tech, note: [
        'pt' => 'Como entender o alfabeto inteiro sem antes passar pelo C? ;)',
        'en' => 'How can you understand the whole alphabet without going through C first? ;)',
    ]),
    new Book('Eloquent JavaScript', 'Marijn Haverbeke', Shelf::Tech),
    new Book('Programming PHP', 'Kevin Tatroe & Peter MacIntyre', Shelf::Tech),
    new Book('Close to the Machine', 'Ellen Ullman', Shelf::Tech, note: [
        'pt' => 'Não é um livro técnico, mas é uma ótima leitura sobre a vida de quem programa.',
        'en' => 'Not a technical book, but a great read about life as a programmer.',
    ]),

    new Book(['pt' => 'O Fim da Eternidade', 'en' => 'The End of Eternity'], 'Isaac Asimov', Shelf::Literature),
    new Book(['pt' => 'A Brincadeira', 'en' => 'The Joke'], 'Milan Kundera', Shelf::Literature),
    new Book(['pt' => 'O Guia do Mochileiro das Galáxias', 'en' => "The Hitchhiker's Guide to the Galaxy"], 'Douglas Adams', Shelf::Literature),
    new Book(['pt' => 'O Senhor dos Anéis', 'en' => 'The Lord of the Rings'], 'J.R.R. Tolkien', Shelf::Literature),
];
