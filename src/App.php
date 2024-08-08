<?php

require __DIR__.'/../vendor/autoload.php';

use DI\ContainerBuilder;
use Wossnap\CommissionTask\Configs\Config;
use Wossnap\CommissionTask\Services\CommisionCalculator;

$containerBuilder = new ContainerBuilder();
$containerBuilder->addDefinitions(Config::containerDefinitions());
$container = $containerBuilder->build();

$calculator = $container->get(CommisionCalculator::class);

foreach (explode("\n", file_get_contents($argv[1])) as $row) {
    if (empty($row)) {
        break;
    }

    $transaction = json_decode($row, true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        echo "Incorrect Format!\n";
        continue;
    }

    $bin = $transaction['bin'] ?? null;
    $amount = $transaction['amount'] ?? null;
    $currency = $transaction['currency'] ?? null;

    $commision = $calculator->calculate($bin, $amount, $currency);

    echo $commision;
    print "\n";
}
