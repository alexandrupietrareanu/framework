<?php

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__.'/src')
    ->in(__DIR__.'/Adapters')
    ->in(__DIR__.'/public');

return (new PhpCsFixer\Config())
    ->setRules([
        '@PSR12' => true,
        'array_syntax' => ['syntax' => 'short'],
        'strict_param' => true,
        '@PhpCsFixer' => true,
        '@PhpCsFixer:risky' => true,
        'php_unit_strict' => false,
        'php_unit_data_provider_static' => false,
        'phpdoc_to_comment' => false,
        'declare_strict_types' => true,
        'ordered_interfaces' => true,
        'static_lambda' => false,
    ])
    ->setFinder($finder);
