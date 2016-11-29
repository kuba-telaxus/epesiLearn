---
title: Cron
taxonomy:
    category: docs
---

Cron is used to periodically execute some job. Every module can define several methods with different intervals.

All you need to do is to set up a system to run _cron.php_ file at least as frequently as the shortest interval defined by modules that use cron.

EPESI will manage cron tasks period. In other words - if you've got a task every 10 minutes, then it's ok to set up cron for 1 minute interval. Your task **will not** be executed more than once per 10 minutes. All other 9 calls to cron.php will do nothing.

Because of that you should set cron as frequently as you can. **1 minute** interval is suggested.
___

**IMPORTANT**

With 1.6.0 and 1.6.1 versions you **have to** set up cron to make upper-right corner search working. Since 1.6.2 search will work without cron, but it's recommended to use cron.

####Modules That Use Cron
___

* Utils/RecordBrowser - search engine index

* Utils/Messenger - send emails with alerts

* Premium/CampaignManager - send campaign emails

* Premium/Warehouse - some synchronization tasks

* Premium/GeneralContractor/Planner

Until 1.6.0 version only one of the core modules required cron - _Utils/Messenger_. It has been working without cron, but not sending emails.

Since 1.6.0 **Utils/RecordBrowser** requires cron to create search index. Since 1.6.2 **Utils/RecordBrowser** recommends cron to create search index, but it will be also created by browser AJAX requests.

####How to Configure - File Execution
___
_Note: all examples are based on linux operating system. You have to adjust them for your server's operating system._


You have to periodically execute _cron.php_ file, that's located in the main folder of EPESI. It depends on your server (or hosting) how to set up cron job.

Execution of _cron.php_ file means run it through PHP interpreter.

You have to remember about running it as a proper user - as it would be ran by http server.

    $ sudo -u <HTTP Server user> php <EPESI_DIR>/cron.php

For example - _apache_ as a user and /var/www/epesi as EPESI_DIR:

    $ sudo -u apache php /var/www/epesi/cron.php

If you'd like to store log for the job, then you can redirect stdout and stderr to the log file

    $ sudo -u apache php /var/www/epesi/cron.php &>> "/home/user/epesi_cron.log"

Proper configuration of the cron job is out of this help page, because it highly depends on your system.

However in most cases you'll have to set up cron in the /etc/cron.d/ folder. It's recommended to create a separate file with desired name and put there:

    * * * * * apache php /var/www/epesi/cron.php

Please review your cron settings help, because user argument is optional and some cron servers does not allow to set it.

####How to Configure - URL Fetch
___

Many hosting providers allow to set cron in the way, where some server job loads specific url in defined time periods. You have to obtain EPESI specific url from _Menu -> Administrator -> Cron_. This url contains unique token, that's also saved on disk. Cron tasks will be executed only if a valid token is supplied. This prevents from unwanted requests to _cron.php_ file.

This method of running cron has some drawbacks. Your cron call may be terminated because of query time limits. It depends on server configuration.

If your hosting provider allows you to set by url, or by file execution, always use the latter one. Please refer chapter above for more information about file execution.

####How EPESI Cron Works
___

**This is a detailed description made for people who'd like to know behind the scenes.**

   1. System runs cron.php file through commandline or url fetch
   
   2. Token validation for url fetch method - prevent DoS attacks
   
      1. Check for token $_GET variable
   
      2. If it's supplied, then check for file DATA_DIR/cron_token.php
   
      3. Compare stored and supplied tokens
   
   3. Check for lock file to prevent multiple execution of the same function
   
      1. Finish if DATA_DIR/cron.lock exists
   
      2. Create lock file otherwise
   
   4. Load EPESI, set time limit to unlimited, increase memory_limit
   
   5. Call all cron common methods to retrieve all possible cron jobs
   
   6. List all methods that has to be executed - all methods, that hasn't been ran for specified interval time and are not currently executed
   
   7. Pick the oldest job
   
   8. Remove cron.lock file - allows to pick next job in the next cron.php execution, even when the previous job is still running
   
   9. Mark selected job as running in the database
   
   10. Run method! (Note that only one method is running every cron.php file call)
   
   11. Log errors or output to DATA_DIR/cron.txt file.
   
   12. Mark selected job as not running

With this approach we can execute all cron jobs and do not starve any. But as you can see you have to execute _cron.php_ as often as it's possible. EPESI will handle rest - it won't execute any job more often than it should.

Here's description by example. We've got three cron jobs to execute. A (1 minutes), B (1 minutes) and C (3 minutes). We've set to run _cron.php_ every one minute.

Running schedule

    12:00 - A
    
    12:01 - B

    12:02 - A

    12:03 - C

    12:04 - B

    12:05 - A

    12:06 - B

    12:07 - C

    12:08 - A

    ...

So as you can see A and B are executed every 2 minutes, sometimes even 3, because C is executed in this time.

Now let we have three jobs A (5 minutes), B (5 minutes), C (10 minutes). Run cron every minute.

Running schedule

    12:00 - A

    12:01 - B

    12:02 - C

    12:03 - none

    12:04 - none

    12:05 - A

    12:06 - B

    12:07 - none

    12:08 - none

    12:09 - none

    12:10 - A

    12:11 - B

    12:12 - C

    ...

Now every process is execute with exact interval.

Things get even more complicated, when some job is time consuming. If it'll last more than it's interval, then it will be executed only if previous execution has finished.

####Use Cron in Your Module
___

To use cron in your module you have to implement cron() method in Common file. This method has to return array of functions to execute in format function name => interval in minutes. Function has to be static method in the same class (Common).

Any return or printed text will be treated as error message. If your cron job has been executed without issues you must not return value or print any text.

    class Custom_MyModuleCommon extends ModuleCommon {
 
        public static function cron() {
            return array(
               'cron_job_1' => 1, // every minute
               'cron_job_2' => 24*60 // every 24h
            );
        }
 
        public static function cron_job_1() {
           $success = true;
           // do something
           if (mt_rand(0,4) === 1) $success = false;
           if (!$success) {
               print 'You have no luck'; // This is error message
            }
        }
 
        public static function cron_job_2() {
           // you can use other classes loaded by autoloader for better code separation
           $obj = new Custom_MyModule_VeryComplicatedCronJob();
           try {
              $obj->execute();
           } catch (Exception $ex) {
              return $ex->getMessage(); // return exception message as cron error
           }
           // if execute doesn't throw exception then don't use return - it means everything is ok
        }
    }
