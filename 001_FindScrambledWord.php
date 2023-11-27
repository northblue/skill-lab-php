
<?php
/*
The task is to write a function that, given a list of words and a note, finds and returns the word in the list that is
scrambled inside the note, if any exists. If none exist, it returns the result "-" as a string. There will be at most one
matching word. The letters don't need to be in order or next to each other. The letters cannot be reused.

Sample Test Cases:
words = ["baby", "referee", "cat", "dada", "dog", "bird", "ax", "baz"]
note1 = "ctay"
find(words, note1) => "cat"   (the letters do not have to be in order)

note2 = "bcanihjsrrrferet"
find(words, note2) => "cat"   (the letters do not have to be together)

note3 = "tbaykkjlga"
find(words, note3) => "-"     (the letters cannot be reused)

note4 = "bbbblkkjbaby"
find(words, note4) => "baby"

note5 = "dad"
find(words, note5) => "-"

note6 = "breadmaking"
find(words, note6) => "bird"

note7 = "dadaa"
find(words, note7) => "dada"

All Test Cases:
find(words, note1) //-> "cat"
find(words, note2) //-> "cat"
find(words, note3) //-> "-"
find(words, note4) //-> "baby"
find(words, note5) //-> "-"
find(words, note6) //-> "bird"
find(words, note7) //-> "dada"

*/

$words = ["baby", "referee", "cat", "dada", "dog", "bird", "ax", "baz"];
$note1 = "ctay";
$note2 = "bcanihjsrrrferet";
$note3 = "tbaykkjlga";
$note4 = "bbbblkkjbaby";
$note5 = "dad";
$note6 = "breadmaking";
$note7 = "dadaa";



function find($words, $note) {
    foreach ($words as $word) {
        if (isScrambled($word, $note)) {
            return $word;
        }
    }

    return "-";
}

function isScrambled($word, $note) : bool
{
    $wordLettersCount = array_count_values(str_split($word));
    $noteLettersCount = array_count_values(str_split($note));

    foreach ($wordLettersCount as $letter => $count) {
        if (!isset($noteLettersCount[$letter]) || $noteLettersCount[$letter] < $count) {
            return false;
        }
    }
    return true;
}

echo find($words, $note1).PHP_EOL;//"cat"
echo find($words, $note2).PHP_EOL;//"cat"
echo find($words, $note3).PHP_EOL;//"-"
echo find($words, $note4).PHP_EOL;//"baby"
echo find($words, $note5).PHP_EOL;//"-"
echo find($words, $note6).PHP_EOL;//"bird"
echo find($words, $note7).PHP_EOL;//"dada"
