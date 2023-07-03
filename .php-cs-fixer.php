<?php

use BombenProdukt\PhpCsFixer\ConfigurationFactory;
use BombenProdukt\PhpCsFixer\Preset\Standard;

$config = ConfigurationFactory::fromPreset(new Standard());
$config->getFinder()->in(__DIR__);

return $config;
