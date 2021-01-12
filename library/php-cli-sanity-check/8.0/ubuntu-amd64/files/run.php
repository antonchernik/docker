#!/usr/bin/env php
<?php
include_once __DIR__ . '/lib.php';

$dirSrc = getenv('DIR_SRC');
$basePath = getenv('BASE_PATH');
$level = getenv('PHPSTAN_LEVEL');
$level = false !== $level ? $level : '1';
$strictChecks = array_map('trim', explode(',', getenv('STRICT_CHECKS')));

Console::log('Source folder path: ', 'yellow', false);
Console::log($basePath);

Console::log('Source files: ', 'yellow', false);
Console::log($dirSrc);

$commands = [
    'PHPCS'     => sprintf('/home/app/vendor/bin/phpcs --standard=PSR12 --ignore=vendor,tests --extensions=php %s', $dirSrc),
    'PHPMD'     => sprintf('/home/app/vendor/bin/phpmd %s text /home/app/phpmd.ruleset.xml --exclude vendor,tests', $dirSrc),
    'PHPCPD'    => sprintf('/home/app/vendor/bin/phpcpd %s --exclude vendor --exclude tests', $dirSrc),
    'PHPSTAN'   => sprintf('cd %s && php -d memory_limit=-1 /home/app/bin/phpstan analyse -l %s src tests', $basePath, $level),
];

$commandStatus = false;
$commandCode = 0;
foreach ($commands as $name => $command) {
    Console::log(sprintf('%s: %s', $name, $command), 'green');
    passthru($command, $commandCode);
    $commandStatus |= $commandCode && in_array($name, $strictChecks);
}

exit((int) $commandStatus);
