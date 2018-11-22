<?php

// Complete the checkMagazine function below.
function checkMagazine($magazine, $note) {

    $magazineDictonary   = array_count_values(explode(' ', $magazine));
    $noteDictonary       = array_count_values(explode(' ', $note));
    
    $result = 'YES';
    reset($noteDictonary);
    for ($noteCount = current($noteDictonary), $noteWord = key($noteDictonary) ;$noteWord !== null; next($noteDictonary), $noteCount = current($noteDictonary), $noteWord = key($noteDictonary)) {
        if (!isset($magazineDictonary[ $noteWord ]) || ($magazineDictonary[ $noteWord ] < $noteCount)) {
            $result = 'NO';
            break;
        }
    }

    return $result;
}

echo '<pre>';
print_r([
    'give me one grand today night
     give one grand today' => checkMagazine('give me one grand today night', 'give one grand today'), // Expected YES
    'apgo clm w lxkvg mwz elo bg elo lxkvg elo apgo apgo w elo bg
    elo lxkvg bg mwz clm w' => checkMagazine('apgo clm w lxkvg mwz elo bg elo lxkvg elo apgo apgo w elo bg', 'elo lxkvg bg mwz clm w'), // Expected YES
    'two times three is not four
     two times two is four' => checkMagazine('two times three is not four', 'two times two is four'), // Expected NO
    'ive got a lovely bunch of coconuts
     ive got some coconuts' => checkMagazine('ive got a lovely bunch of coconuts', 'ive got some coconuts'), // Expected NO
]);
echo '</pre>';

