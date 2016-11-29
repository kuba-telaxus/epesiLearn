---
title: Installation
taxonomy:
    category: docs
---

####Fundamentals
___

EPESI installation consists of:

   1. Core files
      All files in EPESI directory except **/data**, **/modules** and **/admin** directories.
   
   2.
      Modules in **/modules** directory, that are distributed with release archive.

   3. Addition modules
      Additional modules that are downloaded from EPESI Store or any other source. Located under **/modules** directory.

   4. Data directory
      **/data** directory that holds modules data (e.g. file attachments), cache and logs.

   5. Database
      MySQL or PostgreSQL database that is used to store installation data.

   6. Additional admin tools
      **/admin** tools are distributed with release archive, however they are not necessary. They should simplify EPESI maintenance and modules development.

####Requirements
___

* HTTP web server (apache, IIS) with PHP 5.1.3 support. If possible install the latest PHP version due to several bugs in older versions.

* HTTP server should be configured with index.php as one of default documents.

* PEAR installed with valid include_path in PHP config.ini.

* MySQL 4+ or PostgreSQL 7+ database server.

* FTP or local/shell access to the server.

* A web browser (Chrome or Firefox recommended).

####Choose installation method
___

* New installation or update. (Instruction for update at the bottom of page)

* Installation from compressed file via FTP or local access (shell etc.)

* Easy installation using easyinstall script (preferred method)

####New Installation Using Compressed File
___

* Download the latest version of EPESI from [source forge](http://sourceforge.net/projects/epesi/)

* Decompress all files and place them in the directory from which EPESI will be run. You will need to setup /data directory with read/write access.

* Create a database, note the username, password and database name. Make sure that the user has full rights to the database (read, write, create tables etc.)

* Point your browser to the location from which EPESI will be run, for example: http://www.yourcompany.com/epesi

* EPESI setup should start automatically. Accept license agreement and the setup wizard will guide you through all steps which includes creation of the configuration file config.php, necessary directories within /data directory, tables, superadmin user account and password, default data and settings, etc.

* Finally the setup scans all available modules and you will be greeted with the default dashboard. The installation is complete.

* Create new users as new contacts and explore the application.

####New Installation using easyinstall.php script
___

* Create a database, note the username, password and database name. Make sure that the user has full rights to the database (read, write, create tables etc.)

* Download the latest version of easyinstall script from http://sourceforge.net/projects/epesi/

* Place the file in the directory from which EPESI will be run. Make sure that the directory has a read/write access. Start the script in a web browser.

* There is no need to download the entire EPESI application as a compressed file. This easy install script automatically connects to SourceForge server, downloads the latest version, verifies it, decompresses files on the server, sets proper directory permissions and starts EPESI setup.

* Accept license agreement and the setup wizard will guide you through all steps which includes creation of the configuration file config.php, necessary directories within data directory, tables, superadmin user account and password, default data and settings, etc.

* Finally the setup scans all available modules and you will be greeted with the default dashboard. The installation is complete.

* Create new users as new contacts and explore the application.

####Reinstallation
___

* By reinstallation we mean complete, new installation of the application without preserving any of the old data.

* Open config.php located in /data directory and note the database name, user and the password. You will need to enter the same data during the setup.

* Delete the entire content of /data directory with the exception of index.html file (which is needed for security reasons).

* Point your browser to the location from which EPESI was running, for example: http://www.yourcompany.com/epesi

* During the setup follow instruction above as if it was a new installation.

####Update
___

* Before updating the application backup the entire application directory and especially data directory.

* Backup the database.

* Download the new version of EPESI and overwrite all files.

* Point your browser to the location from which EPESI was running, for example: http://www.yourcompany.com/epesi

* If the database schema did not change you will be already running new version.

* If the database schema did change the update process will start automatically during which tables will be altered to this new database schema.

* Once update process is complete you will be redirected automatically to the new version of EPESI application.

####Support
___

Any questions, comments and bug reports should be posted on our [forum](http://forum.epesibim.com)