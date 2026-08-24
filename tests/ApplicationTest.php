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

namespace Jascha030\WpPluginScaffold;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Tester\ApplicationTester;

/**
 * @internal
 */
#[CoversClass(Application::class)]
final class ApplicationTest extends TestCase
{
    public function testRunCreateCommand(): void
    {
        $application = new Application();
        $application->setAutoExit(false);

        $tester     = new ApplicationTester($application);
        $statusCode = $tester->run(['command' => 'create']);

        self::assertSame(Command::SUCCESS, $statusCode);
        self::assertStringContainsString('Creating WordPress plugin scaffold...', $tester->getDisplay());
    }

    public function testApplicationHasCreateCommand(): void
    {
        $application = new Application();

        self::assertTrue($application->has('create'));
    }
}
