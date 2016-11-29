---
title: Troubleshooting
taxonomy:
    category: docs
---

EPESI is being developed since 2006 and it is very stable and tested in number of different configurations: Windows, Linux, OS X, Apache and IIS, XAMP, WAMP, MAMP, Uniserver... etc.

Unfortunately it is not possible to overcome certain configurations problems specific to your server/hosting plan. Before reporting an error please do your homework. We are here to help you but stating that something simply does not work does not give us details necessary to resolve it.

Please follow this step-by-step troubleshooting guide:

   * can you run simple phpinfo script?
   
   * do you have any other php scripts/applications installed on the same server? Are they working?
   
   * are you installing epesi using easyinstall or standard (full download) method?
   
   * was installation successful? Did you get any errors during setup?
   
   * was data directory populated?
   
   * did epesi setup create any tables in the database specified?
   
   * inspect firstrun log file
   
   * try the minimum setup - CRM - you can always add other modules later.
   
   * try to use epesi without any modifications, especially renaming fields, adding custom ones, etc.
   
   * turn on PHP logging and inspect it for any errors. - especially when you don't see any errors on the screen this is where you will find why the application crashes.
   
   * inspect HTTP log as well.
   
   * permissions for data directory must be read/write!
   
   * do you use any PHP accelerator? Disable it and test again.
   
   * are all needed php extensions enabled?
   
   * make sure that you have the latest version of EPESI: <http://www.epesi.org/Get_It>

If you are getting errors at the bottom of the screen in some modules try to disable common file caching. Edit config.php located in data directory:

    define("CACHE_COMMON_FILES",1);

change it to:

    define("CACHE_COMMON_FILES",0);

In recent versions of EPESI error reporting is disabled by default and you need to enable it. Also in config.php file uncomment the following section:

    /*
    * Display errors on page.
    */
    define('DISPLAY_ERRORS',1);

    /*
    * Notifly all errors, including E_NOTICE, etc. Developer should use it!
    */

When reporting a bug try to provide some basic information about your environment like:

   * epesi version and revision (for example: epesi version: 1.1.4 epesi revison: 7579)

   * OS, HTTP version, MySQL version

   * is it your own server or hosted? Is it VPS or private server?

   * do you have access to php.ini? Can you edit it if needed?

At least make sure that data directory permissions are set correctly and inspect PHP error log.