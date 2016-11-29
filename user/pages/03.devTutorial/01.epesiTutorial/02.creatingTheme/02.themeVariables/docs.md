---
title: Variables
taxonomy:
    category: docs
---

Usually, there is a lot of contents that is placed on the page which is not theme-related but is the contents of the application. Even simple messages like 'Logged as **admin**' are in fact independent to the theme. Because of this theme variables are essential in templates.

When you place a call to a theme variable it will be simply replaced with a string provided by the module. To use theme variable you need to use

	{$variable_name}

Some variables might be a little bit more complex (arrays). If you know all the keys under which data is placed you can extract it using

	{$variable_name.key} 

If you simply want to fetch all the rows from an array, you should familiarize yourself with section Theme functions.

You can use one variable any number of times you need.

Now, to create appropriate tpl file you will need to use variables that are defined by the module. To know what variables are defined you will usually need to browse default theme file. If you wish to get better insight to available variables, you can view module main part source and look for calls similar to

	$theme->assign('variable_name', 'value');

Each of those calls defines new variable.