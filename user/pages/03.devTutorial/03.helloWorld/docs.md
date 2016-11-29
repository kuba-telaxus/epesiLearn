---
title: Hello World
taxonomy:
    category: docs
---

####Introduction
___

In order to create a basic module you must first create 3 files. They should be placed within the ./epesi/module/Custom directory ( If you do not have a „Custom” folder please create one ). When naming your files and folders remeber to use CamelCase notation, therefore if you want to name your module „HelloWorld” your path should look like this ./epesi/modules/Custom/HelloWorld. After you have done so it is time to create the 3 basic files :

* HelloWorld_0.php – this is the main file of every module

* HelloWorldCommon_0.php – this file consists of functions used by other modules

* HelloWorldInstall.php – here we place code needed for the installation process

The end result should look like this:

![Path 1](/images/path_1.png)

The 0 indicates the version of the module. It is nothing to be concerned about, just remember to set it to 0 as shown above.

HelloWorld_0.php
This is the main file of any module which defines the class responsible for main view of the module. Here we have a simple code.

	<?php
 
	defined("_VALID_ACCESS") || die('Direct access forbidden'); // - security feature
 
	class Custom_HelloWorld extends Module { // - notice how the class name represents its path
 
      public function body() { // - modules main code
 
        print('Hello World');
 
    	}
	}
 
	?>

This class represents a bare minimum that is required. For the class to be treated as a module it is important to inherit from class **Module**. The **body function** is where you place the content that is to be viewed. The output of this module will be 'Hello World'.

**HelloWorldInstall.php**
___

You must create an installation class for the module to get installed. Here we have a simple installation code:

	<?php
 
 
 
	defined("_VALID_ACCESS") || die('Direct access forbidden');
 
 
 
	class Custom_HelloWorldInstall extends ModuleInstall {
 
        public function install() { // Here you can place the installation process for the module
 
        	return true; // Return true on success and false on failure
 
    	}
 
        public function uninstall() { // Here you can place uninstallation process for the module
 
        	return true; // Return true on success and false on failure
 
    	}
 
    	public function info() { // Returns basic information about the module which will be available in the epesi Main Setup
 
        	return array( 'Author'=>'Place your name here'
            	'License'=>'<Place type of the license here>',
                     	'Description'=>'<Place description here>');
 
    	}
 
    	public function simple_setup() { // Indicates if this module should be visible on the module list in Main Setup's simple view
 
        	return array('package' => __('HelloWorld'), 'version'=>'0.1'); // - now the module will be visible as "HelloWorld" in simple_view
 
    	}
 
    	public function requires($v) { // Returns list of modules and their versions, that are required to run this module
 
        	return array();
 
    	}
 
    	public function version() { // Return version name of the module
 
        	return array('0.1');
 
    	}
	}
 
	?>

Please note that our installation class **Custom_HelloWorldInstall** extends ModuleInstall. There are many parameters and options that can be specified here, but for now let's leave it at this basic minimum.

**HelloWorldCommon_0.php**

This file should contain all the functions connected with the modules functionality and that can be called outside the module. i.e. to create a submenu for the module on the main page.

	<?php
 
	defined("_VALID_ACCESS") || die('Direct access forbidden');
 
	class Custom_HelloWorldCommon extends ModuleCommon {
 
    	public static function menu() {
 
    	    return array(__('Module') => array('__submenu__' => 1, __('Hello World') => array())); // - this will output as Module->HelloWorld in the main menu
 
    	}
	}
 
	?>

####Installation
___

Now we have created a basic module. In order for the module to work we must install it. First you must open the administrator panel:

![Adminstrator Panel](/images/5a_admin_menu.jpg)

Under the "Server configuration" tab click "Modules administration & store".

![Modules Administration Store](/images/MAS.png)

Now it is time to rebuild the module database so we can see our newly created module. Do so by clicking the „rebuild module database” button placed in the upper tab menu.

![Rebuild Module Database](/images/RMD.png)

You will see a dialog box informing that it may take several minutes for parsing for additional modules. Just click OK. It will start loading and after a while you should see your module ready for installation ( it will be under the "All" tab or you could go to the advanced view ).

![Module SV](/images/module_sv.png)

Now click Available->Install in order to install it. You could also install it from the advanced view. To do so first go into advanced view by clicking "Advanced view" at the top.

![Advanced View](/images/adv.png)

Now change your module from "not installed" to "0.1" in the select menu and click save at the upper tab menu as shown below.

![Module Add](/images/module_ad.png)

A dialog box will inform you that the package has been installed. Refresh epesi.Now you should be able to find your module in the menu under Module → Hello World. Click it.

![Module -> HelloWorld](/images/menu_2.png)

If you have done everything right the page will print out „Hello World” at the top center of the page:

![Hello World](/images/helloWorld.png)

You just created your first module in EPESI.

In the next part of the tutorial we will start using the database utilizing the sophisticated Record Browser CRUD engine.