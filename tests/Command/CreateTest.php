<?php

/*
 * This file is part of the jascha030/wp-plugin-scaffold package.
 *
 * (c) Jascha van Aalst <contact@jaschavanaalst.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Jascha030\WpPluginScaffold\Command;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Tester\CommandTester;

/**
 * @internal
 */
#[CoversClass(Create::class)]
final class CreateTest extends TestCase
{
    public function testExecuteReturnsSuccessAndOutputsMessage(): void
    {
        $tester     = new CommandTester(new Create());
        $statusCode = $tester->execute([]);

        self::assertSame(Command::SUCCESS, $statusCode);
        self::assertStringContainsString('Creating WordPress plugin scaffold...', $tester->getDisplay());
    }
}
