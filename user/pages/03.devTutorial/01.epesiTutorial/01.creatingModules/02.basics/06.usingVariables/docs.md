---
title: Using Variables
taxonomy:
    category: docs
---

There are three basic types of variables available within module:

   * module variables

   * object variables

   * local variables

The major difference between them is their lifetime.

   * Module variables will keep their values after each processing, as long as module is being initialized (ie. displayed or used).

   * Object variables are available within class objects and each processing unsets them.

   * Local variables are available only within function that created them and each processing unsets them.

Local and object variables are defined in casual way, just like in pure php. I assume you have basic knowledge of local and object variables so I'll move on to module variables description.

To initialize module variable simply assign it any value:

	$this->set_module_variable('<variable name>','<value>');

Now you can retrieve your variable with

	$this->get_module_variable('<variable name>');

Each module variable value is kept separately for each instance of a module (not module as abstract model). You can read and write to the variable anytime, as long as you are inside regular module function (_module variables are inaccessible within static functions_). If you want two modules to share a variable (ei. if one module changes the value, the other one will receive new value) you can use function

	$this->share_module_variable('<my variable>', $other_module_instance);

After this code is executed, the other module will be able to retrieve '<variable>' with

	$this->get_module_variable('<variable>');