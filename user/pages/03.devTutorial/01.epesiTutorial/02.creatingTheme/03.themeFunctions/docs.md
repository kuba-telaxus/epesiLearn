---
title: Smarty Functions
taxonomy:
    category: docs
---

There are many functions available in smarty engine, but here I'll introduce you to those functions that are most widely used and usually fulfill all the needs.

	Notice: In all smarty functions it is very important to know where to use and don't use $ char.

####IF
___

First of all, you should familiarize yourself with _if_ statement:

	{if <condition>}
		<contents that will be used if the condition is satisfied>
	{else}
		<contents that will be used if the condition is not satisfied>
	{/if}

The <condition> is **similar** to php syntax. Here you can have few examples:

* {if $my_variable} - satisfied if $my_variable is not empty

* {if $my_variable==5} - satisfied if $my_variable is equal to 5

Often some of the variables provided by the module are optional (they are not always passed). In such case you may want to check if particular variable was set and use appropriate style depending on the result.

####FOREACH
___

Sometimes you will need to fetch an array of variables instead of simple variable. In this case a _foreach_ statement allows us to easily browse all the variables placed within.

	{foreach key=key_name item=item_name from=$variable_you_are_parsing}
		...
	{/foreach}

In such loop you have two new variables available: $key_name and $item_name (you can obviously use some other names in foreach call and then use them in the loop respectively). The $key_name holds key under which this fetched variable, available as $item_name, was assigned. Usually $key_name holds additional information abut data or no information at all (a number), while $item_name holds the text itself.

####ASSIGN
___

You will rarely need to use this function. It eventually come in handy when you need to count some objects to, for instance, place _new line_ in the right place.

	{assign var=variable_name value=<new_value>}

To simply increment a variable by one you can use

	{assign var=x value=$x+1}