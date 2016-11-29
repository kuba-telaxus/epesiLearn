---
title: Display Contents
taxonomy:
    category: docs
---

Now, as you probably have the menu entry you should put any output to the main module to actually see it's effect. Edit file <module_name>_0.php and add any print to the body() function. Your <module_name>_0.php should look like this:

	<?php
	defined("_VALID_ACCESS") || die('Direct access forbidden'); // This is a security feature

	class Test_MyModule extends Module {
		public function body(){ // Here you will place the main code for the module 
			print('Hello world!');
		}
	}
	?>

Now, as you select your modules entry in the menu, text you have put in print() should be displayed in the main section of epesi framework.

You can print any HTML tags you want in the body section of your module. However, depending on the theme you are using the space you have might be somehow limited. You should also be very careful with closing random tags at the beginning of the module since this may cause whole framework to work in inappropriate way.

####Summary
___

There are also two other, important aspects of displaying contents of the module which you should use when writing some serious modules. Those are Translations and Templates.

Still, if this is your first test module just go on to the next section of this tutorial.