---
title: Using Translations
taxonomy:
    category: docs
---


Epesi, thanks to Base/Lang module, supports translating words or phrases into, basically, anything you want. Having this in mind, term _translation_ used in here refers not only to changing language of word or phrase but also to tweaking it for better look and feel (for instance, shortening too long names).

Translations are global and only super administrator is eligible to change them (through the _Language & Translations_ in Administrator menu). Words or phrases can be translated in the scope of currently used language to tweak look and feel. To completely change EPESI language you should consider using another language pack - special file containing translations. Language packs are included in the default EPESI package.

####Usage
___

Translating mechanism is extremely simple and there's just one method that, when used, will allow users to change the label you entered:

	__($text)

The argument for this method should always be a string, the original label in English. For example, if you want to create a label that states _Click here to view next entry_, simply call

	$label = __('Click here to view next entry');

And you have a string that, when translation is provided, will change depending on user's selected language.

It's also possible to include placeholder elements in the string to be translated. If the label you want to use have a varying part in the middle of it, it's recommended that you use placeholders to keep the label as a single phrase for translation. For example:

	$label = __('This is the %d entry out of %d', array($number, $count));

[printf()] format should be used when using placeholders.

####Special methods
___

There are two special translating methods, beside __(), that are necessary for our automated tool that scans the code for strings to translate to work properly. These are:

   * _V() - translate variable - this method should be used if any part of the string to translate is not explicitly used where the method is called.

   * _M() - mark translation - this method doesn't translate the string (the return value of the method is exactly the same as vsprintf(). It's used to mark certain strings for translation where the call itself requires to pass original (English) version of the string.

The best way to explain these two methods is to use module based on RecordBrowser as example. When installing a RecordSet, the field names are the kind of strings that should be translated (for the end user), but they need to be translated only during the display and not the installation - since the installation saves these fields names in the database and these names are later used in the code to reference these fields. However, it's often the case that beside the installation routine most of the strings are not mentioned in the code anywhere, so there's no convenient place to put these strings in the translation call for the script to catch these strings. That's why, in the installation routine, the _M() method should be called on each field name, so that the script that scans for translations can catch them. At the same time, the string shouldn't actually be translated in that place, since we want to use the English version of the field in the code later.

Now that these English names are in the database, when RecordBrowser is to display these names it needs to translate them. Every call that will create a label for a field will be using a variable to pass the name of the field. If we used __() call in such place, the script that parses the code for string to translate would find a meaningless $label, or other variable name. The system is made that if a variable translation is found in __() it rises a warning and suggests altering the code to prevent this warning and to encourage the developer to make sure that all the possible sources for these variables are surrounded with _M().

The most usual places for using the _M() call is installation routines (CommonData, RecordBrowser) and menu items. The use of _V() should be avoided, if possible.

**Notice:** The script that parses the code for translations is not currently available, we will possibly release the script at a later date