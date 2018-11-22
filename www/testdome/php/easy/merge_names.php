<?php

/*

Implement the unique_names function. When passed two arrays of names, 
it will return an array containing the names that appear in either or both arrays. 
The returned array should have no duplicates.

For example, calling MergeNames::unique_names(['Ava', 'Emma', 'Olivia'], ['Olivia', 'Sophia', 'Emma']) 
should return ['Emma', 'Olivia', 'Ava', 'Sophia'] in any order.

*/

class MergeNames
{
    public static function unique_names($array1, $array2)
    {
        return array_unique(array_merge($array1, $array2));
    }
}

$names = MergeNames::unique_names(['Ava', 'Emma', 'Olivia'], ['Olivia', 'Sophia', 'Emma']);
echo join(', ', $names); // should print Emma, Olivia, Ava, Sophia