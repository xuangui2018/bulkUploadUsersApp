# bulkUploadUsersApp
This project allows to upload multiple users from the .csv file to database

Run user_upload.php in command line: php user_upload.php

The following are command line options (directives) can be used:
• --file [csv file name] – this is the name of the CSV to be parsed
• --create_table – this will cause the MySQL users table to be built (and no further
• action will be taken)
• --dry_run – this will be used with the --file directive in case we want to run the
script but not insert into the DB. All other functions will be executed, but the
database won't be altered
• -u – MySQL username
• -p – MySQL password
• -h – MySQL host
• --help – which will output the above list of directives with details.

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


