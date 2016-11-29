---
title: Hints
taxonomy:
    category: docs
---

There's quite a lot to learn to efficiently develop new, powerful applications with epesi. All of this you will find in the tutorial (which probably brought you here), however there are few things you may want to keep in mind while developing new applications. You will not find this information in other sections, so be sure to read them carefully and keep them in mind.

####Refresh
___

You will often find yourself in a situation where you will need to refresh the content of your module. **Browser refresh will completely restart epesi** - which will force you to navigate (via menu/launchpad/applet) to reach your module again. You may, instead, **click on epesi logo** in upper-left corner. This will cause **soft refresh** of the page and allow you to check quickly changes you applied in your module. Please keep in mind that epesi is very sensitive to broken javascript code and often such code will block the refresh this way. Find that broken code, use full refresh and it should work from that point.

####Common Cache
___

One of the optimizations we introduced is Common Cache. It's a simple mechanism that on each install/uninstall call rebuilds one file that contains all Commons file content. This will prevent any changes you make in any Common file across the system to be applied. You can clear that cache manually (by deleting data/cache/common.php - this file will be rebuild automatically), but it is highly advisable to disable this feature during the development process. To do so edit file

	data/config.php

find the line

	define("CACHE_COMMON_FILES",1);

and replace it with

	define("CACHE_COMMON_FILES",0);

**Since EPESI version 1.4**

As we are migrating to use classes autoloading, old _CACHE_COMMON_FILES_ define won't work. If you noticed slow down you can force EPESI to use common cache by adding to your data/config.php

	define("FORCE_CACHE_COMMON_FILES",1);

When we fully switch to use classes autoloading, you should try to disable this forcing setting and see how EPESI works.

####Classes Autoloader
___

Since EPESI 1.4 your classes can be auto-loaded!

Just name them properly. As we are trying to hold compatibility with PHP 5.2, we cannot get advantages of namespaces. To emulate them just use underscores. If your module is Premium/MyModule your custom class is Premium_MyModule_Foo it should be in file modules/Premium/MyModule/Foo.php.

Generic procedure to autoload your custom class is to replace all underscores with directory separator and prepend _modules/_.

**About EPESI modules**

Don't bother that modules classes (Main, Common, Install) don't apply this naming rule. They get loaded when needed, but only if module is installed.


