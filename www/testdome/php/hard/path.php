<?php

/*

Write a function that provides change directory (cd) function for an abstract file system.

Notes:

Root path is '/'.
Path separator is '/'.
Parent directory is addressable as '..'.
Directory names consist only of English alphabet letters (A-Z and a-z).
The function should support both relative and absolute paths.
The function will not be passed any invalid paths.
Do not use built-in path-related functions.
For example:

$path = new Path('/a/b/c/d');
$path->cd('../x')
echo $path->currentPath;
should display '/a/b/c/x'.

*/

class Path
{
    const PATH_DELIMITER = '/';
    public $currentPath;

    public function __construct($path)
    {
        $this->currentPath = $path;
    }

    public function cd($newPath)
    {
        $currentPath = explode(self::PATH_DELIMITER, preg_replace('/(\\' . self::PATH_DELIMITER . '$|^\\' . self::PATH_DELIMITER . ')/', '', $this->currentPath));
        $commandList = explode(self::PATH_DELIMITER, str_replace('//', '/', $newPath));
        
        if (strpos($newPath, '/') === 0) {
            $currentPath = [];
        }
        
        $i = sizeOf($currentPath) - 1;

        foreach ($commandList as $k => $command) {
            if (preg_match('/[a-zA-Z\.]/', $command)) {
                switch ($command) {
                    case '..':
                        $i--;
                        $currentPath = array_slice($currentPath, 0, $i+1);
                    break;
                    default:
                        $i++;
                        $currentPath[$i] = $command;
                    break;
                }
            }
        }
        
        array_unshift($currentPath, "");
        
        $this->currentPath = implode(self::PATH_DELIMITER, $currentPath);
    }
}

$path = new Path('/a/b/c/d');
$path->cd('../x');
echo $path->currentPath, PHP_EOL;
$path->cd('/x/test');
echo $path->currentPath;
$path->cd('aaa/bbb/../C/ddss');
echo $path->currentPath;

$path->cd('aaa/../../yyyy/wwww');
echo $path->currentPath;
