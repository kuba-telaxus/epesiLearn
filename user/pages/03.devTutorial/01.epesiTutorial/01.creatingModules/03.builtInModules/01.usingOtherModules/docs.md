---
title: Using Other Modules
taxonomy:
    category: docs
---

Basically there are three ways to use one module inside another. However, to do this you should declare used modules as _required_ for your module. To do this first uninstall your module with epesi Administration panel. Secondly, edit file <MyModule>Init_0.php and modfiy required() method:

	public static function requires() {
		return array(
			array('name'=>'<required_module_name>', 'version'=>'<version_number>'),
			array('name'=>'<another_required_module_name>', 'version'=>'<version_number>'),
			...
		);
	}

After it's done you install back your module and use it. As mentioned before there are three ways to use a module, but generally the way you will be using module is dependent on how this included module works.

####pack_module
___

First method is to pack this module. Simply using command

	$child_module = & $this->pack_module('module_path/module_name',$args,$func,$c_args,$name);

This call will create module instance and call a function $func (_body_ by default) with parameters given as $args (**null** by default). $c_args are used as arguments for construct method while $name is a unique id you can give to the module to make it distinguishable. This functions returns module _object_ which you can use to call module methods, but often you won't need to use them so you don't need to assign the result to a variable.

Example module that is used via this method is Base/Lang

####init_module
___

First method is to pack this module. Simply using command

	$child_module = & $this->init_module('module_path/module_name',$args,$name);

This call will create module instance and call a function $func (_body_ by default) with parameters given as $args (**null** by default). $name is a unique id you can give to the module to make it distinguishable. Not that in this case it's necessary to hold module _object_ returned by this function as you will need to configure the module and finally display it. To display module initiated this way you need to call

	$this->display_module($module_object, $args, $func);

or when you want to return content of module instead of displaying it

	$this->get_html_of_module($module_object, $args, $func);

Where $args is list of aguments for the function $func (body by default) that will be called.

Example module that is used via this method is Libs/QuickForm

####module_common
___

Many modules declare some simple functions that perform some quick action, usually without printing output. In such case those methods are usually placed in module common part. All method placed in Commons should be static and no module packing (or initializing) should be used within Common class.

Example module that is used via this method is Base/ActionBar