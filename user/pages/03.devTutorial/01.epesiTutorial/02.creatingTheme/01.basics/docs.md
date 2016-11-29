---
title: Creating Theme - Basics
taxonomy:
    category: docs
---

####Foreword
___

Epesi templates are based on smarty templates engine.

First thing you should know is that essential part of themes are tpl files. Those files define HTML structure that will hold and organize page contents. As for the styles, we usually store all of them in css files.

All themes are placed under /data/Base/Theme/templates/ path. Each folder stands for a theme and the folder name is used as theme identifier. By default, there is just one theme installed and it is called _default_. If you want to create your own theme, the easiest way is to do this is to use default theme as basis. This will allow you to cover all the files that are used by the framework and you will easily manage all the variables theme is using.

	Notice: It is a good practice to leave the original unchanged
    	    and simply copy necessary files to new folder in /data/Base/Theme/templates/.

You should also remember that if certain *.tpl file is not provided by custom theme the default file will be used. This also means that if you want to customize just a small part of the framework, you can simply copy only those files that will be changed.

####Understanding purpose of each theme file
___

When you start to create your own theme you should have rough idea what is the purpose of each file in template folder.

First of all, each file is assigned to one, particular module. Filename consists of two parts separated with double _. First part is a name of a module that uses this file. Second part describes functionality. If certain module uses only one *.tpl file the description is usually *default*. For instance Apps_Forum__Boards.tpl file is used by Apps/Forum module and, as you can guess, it is used to display forum Boards.

Sometimes you may have problems with determining what does the module or description stands for. Usually, in such case insight to the file contents should be enough to understand it's purpose. As an example of such partial modification you can see PublicPage theme available on our [download page](https://sourceforge.net/project/showfiles.php?group_id=192918).

####Loading css
___

There are also some other files connected with each tpl file you can find in theme folder, the css files. Those files, that are usually specified for each tpl file separately, are not obligatory. Filename for such css file is the same as the tpl (except for extension of course).

Epesi has a rule that if tpl file is being loaded, it will try to fetch a css file to it. Now if the css file is not present **in theme folder from which tpl file was taken**, there will be no further action. A little confusing, so maybe those two examples will clarify it:

* You created new tpl file, but in your theme you didn't place css file connected to it. This means that there will be no css file loaded when your tpl file is used.

* If you wish to only modify css file for certain module, you still need to copy tpl file since without tpl file in your folder, default tpl will be used along with css file from it's (default) folder.

	In other words, you must define your own tpl file for a module to apply stylesheets changes.

####Managing resource files
___

Aside tpl and css files, you can place any other files you want in your template directory and possible subdirectories. This mainly refers to any type of image files. To use those files in css files you should you relative path. For instance:

	table#Base_Box__logged td.module_name {
		background-image: url("images/button-background-2.png");
		width: 286px;
		height: 20px;
		...
	}

However, to use any resource file in tpl theme file, you need to place directory path to your theme. To support full flexibility in naming the theme there is a special theme variable available: {$theme_dir} For now, all you need to know about such variables is how to use {$theme_dir} to use any image in tpl file. Take a look at following example: <img src="{$theme_dir}/images/logo-small.png"> This way, you can change main theme directory any time you want and it will still work properly.

	Notice: Do not change default theme folder name since this will make epesi unable to retrieve default theme and may cause serious malfunction.

	Notice: Changing folder name of currently chosen theme will make epesi configuration invalid and it will use default files for all modules.

####Development issues
___

Here you can read about most common theme developing problems. If those solution placed here doesn't solve the problem you can always ask for support on our [forum](https://forum.telaxus.com).

It is very important to make sure there is no __cache.css file in your theme folder. This file is created each time you switch the theme and is used to reduce bandwidth. If this file is present in your theme directory you can simply delete it. Otherwise, you will be unable to notice any style changes you make in css files.

If no changes are visible there might be few reasons for this:

* Check if the theme you are currently working on is set as active in epesi

* Empty browser cache (this is usually a must to see any changes made in css files)
* Try cleaning up /data/Base/Theme/compiled/ folder. This is rarely a case and if occurs, it usually affects tpl's not being updated.

* Check if you are working with the right file.
