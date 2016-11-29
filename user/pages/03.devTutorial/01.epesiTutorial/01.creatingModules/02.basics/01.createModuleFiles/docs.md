---
title: Create Module Files
taxonomy:
    category: docs
---

The very first thing you need to do is to create some basic files for the module. It is very important where you place this new module. First of all, you need to place it somewhere within ./modules/ directory, this is where all modules are stored. Then you might want to put your module in some subdirectories. If this is your first module we recommend you to put it inside ./modules/Test/MyModule/. Remember, that the module name will consist of the directory path under ./modules/ you have chosen and in this example it will be "Test/MyModule".

Now, as you have chosen the path (let's say it was ./modules/Test/MyModule/) you should create three files. Each file begins with the directory name it is placed in ("MyModule" in this case). The files should be as follows:

   * MyModule_0.php - this is the module main file
   
   * MyModuleInstall.php - this file is required by the installation process
   
   * MyModuleCommon_0.php - this file provides simple function that are designed to be used by other modules

The number you have put in most of the filenames (0) indicated version number of the module. This feature is designed to allow selective and individual epesi upgrade for each epesi installation. There is no need for you to be bothered about it, just make it 0.

Each file needs to be filled with some minimum code to make it work properly. This code consists mainly of proper class definitions, that epesi will expect to find in those files.

####MyModule_o.php
___

	<?php
	defined("_VALID_ACCESS") || die('Direct access forbidden'); // This is a security feature.

	class Test_MyModule extends Module { // Note, how the class' name reflects module's path.

		public function body(){ // Here you will place the main code for the module.

		}
	}
	?>

There is not much in this file yet, but usually it's the largest file among the module. The method body() is usually called when the module is meant to be displayed. There will be more information about this later on.

####MyModuleInstall.php
___

	<?php
	defined("_VALID_ACCESS") || die('Direct access forbidden');

	class Test_MyModuleInstall extends ModuleInstall {

		public function install() {
	// Here you can place installation process for the module
			return true; // Return true on success and false on failure
		}
	
		public function uninstall() {
	// Here you can place uninstallation process for the module
			return true; // Return true on success and false on failure
		}

		public function info() {
	// Returns basic information about the module which will be available in the epesi Main Setup
			return array(	'Author'=>'<Place your name here>', 
					'License'=>'<Place type of the license here>', 
					'Description'=>'<Place description here>');
		}
	
		public function simple_setup() {
	// Indicates if this module should be visible on the module list in Main Setup's simple view
			return true; 
		}

		public function requires($v) {
	// Returns list of modules and their versions, that are required to run this module
			return array(); 
		}
	
		public function version() {
	// Return version name of the module
			return array('0.1'); 
		}
	}
	?>

####MyModuleCommon_0.php
___

	<?php
	defined("_VALID_ACCESS") || die('Direct access forbidden');

	class Test_MyModuleCommon extends ModuleCommon {

	}
	?>

In this class you should add all simple functions that are connected with module functionality, but can be successfully called outside this module. If you happen to create a module in which this file is empty, you can simple delete it.

####Summary
___

That was the very beginning of creating the module. You can now move to the next chapter and get your module actually working.
