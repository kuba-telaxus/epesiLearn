---
title: Create Links
taxonomy:
    category: docs
---

The most basic way to navigate through pages and perform actions is to use links. In epesi there are a few ways you can create such a link, depending on what functionality you need. Still, no matter what way you choose, all functions have one thing in common: they return string which format is

	href="<here goes link parameter>"

As you may notice, <a> tag is omitted and eventually you'll need to add it by yourself.

####Callback Link
___

This is the most useful type of link. It allows you to choose which function should be called after the link is used. Additionally you may give this function some parameters. To create simple callback link open <module_name>_0.php and define _body_ function as follows:

	public function body() {
		print('This is a page no. 1 <br>');
		print('<a '.$this->create_callback_href(array($this,'second_page')).'>Link to the second page</a><br>');
	}

Notice that result of function create_callback_href() was placed in <a ...> tag. Now you need to define function second_page():

	public function second_page() {
		print('This is a page no. 2<br>');
		return true;
	}

The _true_ value that is returned by this function indicates that module main function (_body_ in this case) will not be called after second_page() function. Feel free to try out how this works by accessing epesi page.

Now redefine function second_page() like this:

	public function second_page() {
		print('This text will be displayed above page 1 contents<br>');
		return false;
	}

Again, take a look on epesi page and how does your module work.

So when should we return true and when false? It's fairly easy, you should return true whenever you wish to go to a new section of your module. If contents of the page is meant to change you will most likely want to avoid displaying the main section of the module.

On the other hand, returning false allows you to perform simple action like deleting or marking something on the page. In such situation the function called by callback_href won't display anything, just modify the module data or database. After such action you might want to get back what you were displaying before.

Remember that callback function will be technically called before the main module function so all the data that will be displayed by the main module function will be up-to-date.

####Variable Link
___

You can also create links that may set some variables to certain value. There are two distinct ways: create_href and create_unique_href. The difference is significant. First function will set variable visible to all modules that will be currently displayed while create_unique_href will make those values only visible to the module that created this href. It's recommended to use create_href with extreme caution since it may cause side effects that will cripple the system.

Both functions are called in the same fashion:

	$this->create_href( array('key1'=>'value1', 'key2'=>'value2', ...) );
	$this->create_unique_href( array('key1'=>'value1', 'key2'=>'value2', ...) );

However the way you extract the values differ greatly. For values set via create_href() use $_REQUEST['key1'] to get the value. Values given by create_unique_href() should be accessed with $this->get_unique_href_variable();

In general, you won't need to use create_href() nor create_unique_href() if you'll rely on create_callback_href(). However, there is a particular use for create_href that you might find handy.

	$this->create_href(array('box_main_module'=>'<module_name>'));

If your epesi is using Base_Box as main module (default installation) such link will force epesi to display module given under 'box_main_module' key. You can also set function that will be called from within module by setting 'box_main_function' (_body_ by default) and define list of arguments by setting 'box_main_arguments'.

####Back Links
___

There is a special type of links that is meant to be put under any sort of _back button_ (or link). To create such href simply use

	$this->create_back_href();

or the whole link:

	print('<a '.$this->create_back_href().'>Back</a>');

To check if such link was clicked you can use

	$this->is_back();

which returns true if any linked created with create_back_href() was clicked. is_back() will return true only once per click if not defined otherwise. To make is_back() return true multiple times define particular link as

	$this->create_back_href($x);

Where $x is number of times function is_back will return true after next processing (1 by default).

Here is a sample module code that will show you how to use is_back() and create_callback() efficiently:

	<?php
	defined("_VALID_ACCESS") || die('Direct access forbidden'); 

	class Test_MyModule extends Module {

		public function body($arg) {
			print('<a '.$this->create_callback_href(array($this,'instead')).'>Instead</a> :: ');
			print('<a '.$this->create_callback_href(array($this,'before')).'>Before</a> :: ');
		}
	
		public function instead() {
			if($this->is_back()) return false;
			print('instead main function<hr>');
			print('<a '.$this->create_back_href().'>Back</a>');
			return true;
		}

		public function before() {
			print('before<hr>');
			return false;
		}
	}
	?>

####Confirm Links
___

If you want to create link that requires confirmation (recommended for any sort of deletion links) you can simply add _confirm_ to the function name:

	$this->create_confirm_callback_href('<message>',$function,$arguments);
	$this->create_confirm_href('<message>',$array_with_variables);
	$this->create_confirm_unique_href('<message>',$array_with_variables);

After clicking such link user will get window with message provided in the function call and two buttons _Ok_ and _Cancel_. If he selects _Ok_ processing will follow as usual. If _Cancel_ is selected, nothing will happen (ie. there will be no processing).