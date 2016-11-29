---
title: Using ActionBar
taxonomy:
    category: docs
---

ActionBar is a module that displays buttons at the top of the screen. To add a button to the ActionBar you need to call the following function:

	Base_ActionBarCommon::add($icon, $label, $action);
	Notice: Despite the fact you are not creating module instance
        	you need to mark ActionBar as required by your module

The $icon argument specifies which icon should ActionBar use for this button. Here you have the list of icons currently available in epesi default theme:

   * home

   * back

   * report

   * calendar

   * search

   * folder

   * new

   * edit

   * view

   * add

   * delete

   * save

   * settings

   * print

Second argument, $label, defines text that will be displayed on the button. And finally argument $action defines action that will be performed if the button is clicked. Simplest way to create new action is to use one of the 'create_href' functions.

For example, to create button that will launch module method _delete_entry_, using icon _delete_ and description _Delete_ you can use the following:

	Base_ActionBarCommon::add('delete',$lang->ht('Delete'),$this->create_callback_href(array($this,'delete_entry'),$id));

Where $lang is object of Base/Lang module. Please note that hidden translation should be used for ActionBar button labels.