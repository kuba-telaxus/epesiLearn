---
title: Add Menu Entry
taxonomy:
    category: docs
---

To make your module accessible via epesi built-in menu you should edit file <module_name>Common_0.php and place there following method to the <module_name>Common class:

	public static function menu() {
		return array('Label'=>array());
	}

Replace Label with appropriate text describing your module. The empty array serves as argument list, where you can assign some values to some variables. Here's example:

	public static function menu() {
		return array('Label' => array( 'MyVariable' => 'MyValue' ) );
	}

Those variables will be available in the main module under $_REQUEST[] variable. In the example above you could access this particular variable by writing $_REQUEST['MyVariable'] which would contain 'MyValue'.

Example:

	public static function menu() {
		return array('Test'=>array('__submenu__'=>1,'HelloWorld'=>array()));
	}

This will create a menu **Test** with submenu **Hello World**.

####Summary
___

As you have added the menu method to the right class, you can now refresh your epesi page and see the entry displayed in the menu. Right now selecting your entry from the menu will make the content panel of the epesi framework to be empty. This is because main module class doesn't display anything. To make it work you should now proceed to the next chapter and find way to display some text.

There is also another section concerning Menu, but we recommend you to visit it later, since it contains more advanced options that are not necessary to make simple module work properly.