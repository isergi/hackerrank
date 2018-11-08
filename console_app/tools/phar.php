<?php

$rootDir = dirname(__FILE__, 2);

$binDir = $rootDir . '/bin';
$pharFile = $binDir . '/c-tool.phar';

if (!is_dir($binDir)) {
    mkdir($binDir);
}

if (file_exists($pharFile)) {
    unlink($pharFile);
}

$p = new Phar($pharFile);

$p->startBuffering();

$defaultStub = $p->createDefaultStub($rootDir . '/c-tool');

$p->buildFromDirectory($rootDir . '/src');
$p->addFile($rootDir . '/c-tool');
$p->addFile($rootDir . '/vendor/autoload.php');
$p->addFile($rootDir . '/vendor/composer/autoload_real.php');
$p->addFile($rootDir . '/vendor/composer/ClassLoader.php');
$p->addFile($rootDir . '/vendor/composer/autoload_static.php');
$p->addFile($rootDir . '/vendor/composer/autoload_files.php');
$p->addFile($rootDir . '/vendor/composer/autoload_namespaces.php');
$p->addFile($rootDir . '/vendor/composer/autoload_psr4.php');
$p->addFile($rootDir . '/vendor/composer/autoload_classmap.php');
$p->addFile($rootDir . '/vendor/symfony/polyfill-ctype/bootstrap.php');
$p->addFile($rootDir . '/vendor/myclabs/deep-copy/src/DeepCopy/deep_copy.php');
$p->addFile($rootDir . '/src/ConsoleTool/Console/SalaryCli.php');
$p->addFile($rootDir . '/src/ConsoleTool/Console/AConsole.php');
$p->addFile($rootDir . '/src/ConsoleTool/Exceptions/CommandException.php');
$p->addFile($rootDir . '/src/ConsoleTool/Command/ACommand.php');
$p->addFile($rootDir . '/src/ConsoleTool/Command/Help.php');
$p->addFile($rootDir . '/src/ConsoleTool/Command/Salary.php');

$stub = "#!/usr/bin/php \n" . $defaultStub;
$p->setStub($stub);

$p->stopBuffering();
$p->compressFiles(Phar::GZ);

echo 'Successfully created: ' . $pharFile;
