---
title: Using Record Browser RBO
taxonomy:
    category: docs
---

Recordset
Now let's modify our simple module with EPESI's Objective RecordBrowser ( RBO) Utils/RecordBrowser/RBO a utility for presenting and saving records into a database using Record Browser CRUD engine.

Start by creating a file named **Recordset.php** and place it in the ./epesi/module/Custom/HelloWorld path along with already created files that are part of the module:

![Path 2](/images/path_2.png)

Now copy the following code into the file:

	<?php
 
	defined("_VALID_ACCESS") || die('Direct access forbidden');
 
	class Custom_HelloWorld_Recordset extends RBO_Recordset {
 
    	function table_name() { // - choose a name for the table that will be stored in EPESI database
 
        	return 'HelloWorld';
 
    	}
 
    	function fields() { // - here you choose the fields to add to the record browser
 
        	$category_name = new RBO_Field_Text(_M('Name'));
        	$category_name->set_length(24)->set_required()->set_visible();
 
        	$description = new RBO_Field_LongText(_M('Description'));
        	$description->set_visible();
 
 
        	return array($category_name, $description); // - remember to return all defined fields
 
 
    	}
	}
	?>

The module does not do anything useful, it creates only one recordset consisting of two simple fields:

* Name - text field, varchar with the length of 24 characters

* Description - long text field with the max length of 255 characters

Please note, that instead of **$category_name = new RBO_Field_Text('Name')**, where 'Name' is the name and the label of the field, we used **_M(string)** function which provides automatic translation: **$category_name = new RBO_Field_Text(_M('Name'));**. Doing so will allow to translate the label **Name** into other languages making your module multilingual.

You can find more info about translation mechanism used in EPESI here: Base/Lang

The file Recordset.php will be autoloaded after calling it in the installation file of our module. Add the code below to **Custom_HelloWorldInstall.php** in the install() function to install the recordset.

	Base_ThemeCommon::install_default_theme($this->get_type());
	$fields = new Custom_HelloWorld_Recordset();
	$success = $fields->install();
	$fields->add_default_access();
	$fields->set_caption(_M('Hello World'));

Remember to uninstall the recordset later using the *uninstall()* function.

 	public function uninstall() { // Here you can place uninstallation process for the module
  	Base_ThemeCommon::uninstall_default_theme($this->get_type());
  	$fields = new Custom_HelloWorld_Recordset();
  	$success = $fields->uninstall();
  	return true; // Return true on success and false on failure
	}

Now you can use the RecordBrowser engine to browse, view, edit and delete data. In order to call it within the body of our module add this last script into HelloWorld_0.php to the body() function.

	$rs = new Custom_HelloWorld_Recordset();
	$this->rb = $rs->create_rb_module($this, 'Custom_HelloWorld');
	$this->display_module($this->rb);

The entire file should look like this:

	<?php
  
	defined("_VALID_ACCESS") || die('Direct access forbidden'); // - security feature
  
	class Custom_HelloWorld extends Module { // - notice how the class name represents its path
  
      public function body() { // - modules main code
  
    	print('Hello World');
 
	// Here we call Record Browser
 
        	$rs = new Custom_HelloWorld_Recordset();
        	$this->rb = $rs->create_rb_module($this, 'Custom_HelloWorld');
        	$this->display_module($this->rb);
    	}
	}
  
	?>

Reinstall your module and start it. The output of your module should now look like this.

![RBO](/images/RBO.png)

Adding records to the table is quite simple. Click Add new. This is what you should see.

![Fields](/images/fields.png)

Here we have the inputs we chose to have in our table by adding them in Recordset.php in the fields() function. Save the data by clicking save when you are done.

You just created the first module that stores data in the database using Record Browser CRUD engine.

The last part of the tutorial will give you some useful hints.