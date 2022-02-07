<?php

declare(strict_types=1);

namespace Astral\Tests;

use Hautelook\AliceBundle\PhpUnit\ReloadDatabaseTrait;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase as SymfonyKernelTestCase;

class KernelTestCase extends SymfonyKernelTestCase
{
    use ReloadDatabaseTrait;
}
