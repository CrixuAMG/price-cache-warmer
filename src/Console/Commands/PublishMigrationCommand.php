<?php

namespace CrixuAMG\PriceCacheWarmer\Console\Commands;

use CrixuAMG\PriceCacheWarmer\DriverManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class PublishMigrationCommand extends Command
{
    protected function configure()
    {
        $this->setName('publish:migration')
            ->setDescription('Publish migration for a specific driver')
            ->setHelp('Publish migration for a specific driver')
            ->addArgument('driver', InputArgument::REQUIRED, 'Driver name.')
            ->addArgument('migration-destination', InputArgument::REQUIRED, 'Target path to publish the migration.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $driver = DriverManager::driver($input->getArgument('driver'));

        $migrationPath = $driver->getMigrationPath();

        if (empty($migrationPath)) {
            throw new \Exception('Migration path is required.');
        }

        $migrationContents = file_get_contents($driver->getMigrationPath());

        if (empty($migrationContents)) {
            throw new \Exception('Migration content is required.');
        }

        $destination = $input->getArgument('migration-destination');

        $migrationToPath = $driver->getMigrationName();

        if (empty($migrationToPath)) {
            throw new \Exception('Migration to path is required.');
        }

        file_put_contents($destination.'/'.$migrationToPath, $migrationContents);

        return 0;
    }
}
