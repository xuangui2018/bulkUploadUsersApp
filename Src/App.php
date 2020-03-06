<?php

declare(strict_types = 1);

namespace App;

use App\Database\Database;
use App\Exceptions\DatabaseConnectionException;
use App\Helpers\FileHelper;
use App\Controllers\UsersController;

class App {

    private $fileName;
    private $databaseHost;
    private $databaseUsername;
    private $databasePassword;
    private $createTable = false;
    private $dryRun = false;
    private $printHelp = false;
    private $fileContent;
    private $errorMessages = [];

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

    /**
     * Get createTable
     *
     * @return bool
     */
    public function getCreateTable(): bool
    {
        return $this->createTable;
    }

    /**
     * Create users table
     */
    public function createTable(): void
    {
        $query = "
            CREATE DATABASE bulkUploadUsersApp;
            use bulkUploadUsersApp;
            CREATE TABLE users (
                id INT(64) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(100) NOT NULL,
                surname VARCHAR(100) NOT NULL,
                email VARCHAR(200) NOT NULL,
                UNIQUE INDEX (email)
            );";
        try {
            $database = new Database();
            $databaseConnection = $database->getConnection();
            $stmt = $databaseConnection->prepare($query);
            if ($stmt->execute()) {
                print "Users table has been created successfully";
            }
        } catch (Throwable $e) {
            throw new DatabaseConnectionException('Could not create users table.');
        }
    }

    /**
     * Get dry run
     *
     * @return bool
     */
    public function getDryRun(): bool
    {
        return $this->dryRun;
    }

    /**
     * Read file
     *
     * @return $this
     * @throws Exceptions\FileNotFoundException
     */
    public function readFile()
    {
        $this->fileContent = FileHelper::getFileContent($this->fileName);
        return $this;
    }

    /**
     * Process file
     *
     * @return void
     */
    public function processFile(): void
    {
        foreach ($this->fileContent as $lineNumber=>$userDetails) {
            if (trim($userDetails[0]) === 'name' || trim($userDetails[1]) === 'surname' || trim($userDetails[2]) === 'email') {
                continue;
            }
            $usersController = new UsersController();
            $errorMessage = $usersController->store($userDetails, $this->dryRun);
            if (!empty($errorMessage)) {
                $this->errorMessages[$lineNumber+1] = $errorMessage;
            }
        }
        $this->printErrorMessages();
    }

    /**
     * Print out error messages
     *
     * @return void
     */
    private function printErrorMessages(): void
    {
        if (count($this->errorMessages) > 0) {
            foreach ($this->errorMessages as $lineNumber=>$errorMessage) {
                foreach ($errorMessage as $error) {
                    print "Line $lineNumber: $error". PHP_EOL;
                }
            }
        }
    }
}