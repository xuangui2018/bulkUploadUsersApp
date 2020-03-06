# bulkUploadUsersApp
This project allows to upload multiple users from the .csv file to database

Run user_upload.php in command line: php user_upload.php

To list all command line options (directives):
php user_upload.php --help

To create database and users table:
php user_upload.php -h=localhost -u=root -p --create_table
OR
php user_upload.php --create_table

To run the script and print out a Insert statements and errors if there is any:
php user_upload.php --file=users.csv --dry_run

To run the script and insert all the users into users table and print out errors if there is any:
php user_upload.php -h=localhost -u=root -p
OR
php user_upload.php --file=users.csv


