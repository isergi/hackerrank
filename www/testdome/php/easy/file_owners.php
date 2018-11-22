<?php

/*

Implement a groupByOwners function that:

Accepts an associative array containing the file owner name for each file name.
Returns an associative array containing an array of file names for each owner name, in any order.
For example, for associative array ["Input.txt" => "Randy", "Code.py" => "Stan", "Output.txt" => "Randy"] 
the groupByOwners function should return ["Randy" => ["Input.txt", "Output.txt"], "Stan" => ["Code.py"]].

*/

class FileOwners
{
    public static function groupByOwners($files)
    {
        $result = [];
        foreach ($files as $file => $person) {
            if (!isset($result[ $person ])) {
                $result[ $person ] = [];
            }
            $result[ $person ][] = $file;
        }
        return $result;
    }
}

$files = array
(
    "Input.txt" => "Randy",
    "Code.py" => "Stan",
    "Output.txt" => "Randy"
);
var_dump(FileOwners::groupByOwners($files));