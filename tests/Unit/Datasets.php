<?php

declare(strict_types=1);

use Symfony\Component\Yaml\Yaml;

dataset('valid', Yaml::parseFile(__DIR__.'/../../spec/valid.yml'));

dataset('invalid', Yaml::parseFile(__DIR__.'/../../spec/invalid.yml'));
