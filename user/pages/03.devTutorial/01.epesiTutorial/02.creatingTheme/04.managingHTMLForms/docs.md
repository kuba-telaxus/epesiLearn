---
title: Forms
taxonomy:
    category: docs
---


####Basics
___

All the QuickForm labels, input fields and headers for particular form are assigned to one variable (an array to be precise). You need to know form identifier which you will need to know to extract information about the form. Usually this identifier is **form** to simplify the use. Now, assuming you need to use commonly used form as identifier, you can open form HTML tag by placing

	{$form_open}

This variable also holds such entries like JS script for the form and all hidden fields of the form. From this point, you can use all the form fields and they will be processed correctly.

After you've placed all the fields and headers, you should close the form. It's recommended to do this with

	{$form_close}

	Notice: To avoid common mistake you can open the form at the beginning of tpl file and place closing statement at the very end of the file. That only applies if there is only one form in a tpl file.

####Form fields
___

Now, to access any field you should use

	{$form_data.field_id.part_of_the_field}

Notice that also in this case form is the form identifier and you should replace it if the id is different.

Most of the fields you will be placing in your template file consists of three parts:

* label - field label (text)

* html - field html code (input tag)

* error - this is a span which is filled with error for this particular field if any occurs

For instance, if you have input of type text with id="name" you can use following code:

	{$form_data.name.label}{$form_data.name.html}<br>
	{$form_data.name.error}

It's rather obvious that button and submit elements don't have label and error parts.

####Headers
___

There is also a group of labels known as headers. All headers are stored under {$form_data.header} variable. To access particular header you should use

	{$form_data.header.header_id}