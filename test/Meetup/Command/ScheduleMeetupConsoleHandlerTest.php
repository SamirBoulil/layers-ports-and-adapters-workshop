<?php
declare(strict_types=1);

namespace Tests\Meetup\Command;

use Meetup\Command\MeetupApplicationConfig;
use Webmozart\Console\Args\StringArgs;
use Webmozart\Console\ConsoleApplication;
use Webmozart\Console\IO\OutputStream\BufferedOutputStream;

final class ScheduleMeetupConsoleHandlerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_schedules_a_meetup(): void
    {
        $container = require __DIR__ . '/../../../app/container.php';

        $config = new MeetupApplicationConfig($container);
        $config->setTerminateAfterRun(false);
        $cli = new ConsoleApplication($config);

        $output = new BufferedOutputStream();
        $args = new StringArgs('schedule Akeneo Meetup "2018-04-20 20:00"');
        $cli->run($args, null, $output);

        $this->assertContains(
            'Scheduled the meetup successfully',
            $output->fetch()
        );
    }
}
