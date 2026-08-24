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

use Jascha030\WpPluginScaffold\Command\Create;
use Symfony\Component\Console\Application as BaseApplication;

final class Application extends BaseApplication
{
    public function __construct()
    {
        parent::__construct('wp-plugin-scaffold');

        $this->addCommand(new Create());
    }
}
