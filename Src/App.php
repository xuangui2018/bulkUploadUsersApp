<?php

declare(strict_types = 1);

namespace App;


class App {

    private $fileName;
    private $databaseHost;
    private $databaseUsername;
    private $databasePassword;
    private $createTable = true;
    private $dryRun = false;
    private $printHelp = false;

    /**
     * App constructor.
     * @param array $arguments
     */
    public function __construct(array $arguments)
    {
        $this->fileName = $arguments['file'];
        $this->databaseHost = $arguments['h'];
        $this->databaseUsername = $arguments['u'];
        $this->databasePassword = $arguments['p'];
        if (isset($arguments['create_table'])) {
            $this->createTable = true;
        }
        if (isset($arguments['dry_run'])) {
            $this->dryRun = true;
            $this->createTable = false;
        }
        if (isset($arguments['help'])) {
            $this->printHelp = true;
        }
    }

    /**
     * Get printHelp
     *
     * @return bool
     */
    public function getPrintHelp(): bool
    {
        return $this->printHelp;
    }

    /**
     * Print out help commands
     *
     * @return void
     */
    public function printOutHelpCommands(): void
    {
        $helpCommands = [];
        $helpCommands[] = '--file [csv file name] – this is the name of the CSV to be parsed';
        $helpCommands[] = '--create_table – this will cause the MySQL users table to be built (and no further action will be taken)';
        $helpCommands[] = '--dry_run – this will be used with the --file directive in case we want to run the script but not insert into the DB. All other functions will be executed, but the
database won\'t be altered';
        $helpCommands[] = '-u – MySQL username';
        $helpCommands[] = '-p – MySQL password';
        $helpCommands[] = '-h – MySQL host';
        if ($this->printHelp) {
            foreach ($helpCommands as $helpCommand) {
                print $helpCommand . PHP_EOL;
            }
        }
    }

}