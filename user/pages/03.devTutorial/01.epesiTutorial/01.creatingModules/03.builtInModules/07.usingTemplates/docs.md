---
title: Using Templates
taxonomy:
    category: docs
---

Epesi's template system bases on Smarty. If you are already familiar with smarty, you don't need to know more, than how to start smarty engine in epesi.

####Basics
___

Template is a file which has HTML code of our module and offers methods to fill it with data. Very simple example of template file could be this:

	<html>
		<head>
			<title>{$title}</title>
		</head>

		<body>
			<h1>{$title}</h1>
			<p>{$content}</p>
		</body>
	</html>

It looks just like a regular HTML file except for {$title} and {$content} parts. Later on, while template is processed, those are changed to values you set in PHP file. HTML is kept in separate file. This method has most advantages over "printing" HTML code directly in PHP files.

First of all, it lets you separate design section (HTML/CSS) from code. Thanks to that, module's looks may be quickly altered by just editing its template file, which is very similar to regular HTML file. That means people not knowing PHP are able to customize module for their needs, provided thay know HTML well enough (HTML compared to PHP is much easier).

Moreover, PHP code itself is much cleaner. It just provides data for template.

####Initialization
___

Here we learnt how to start the module and display it. Next section covers filling template with data.

To initialize template module we have create its instance.

	$theme = & $this->init_module('Base/Theme');

To display the template we use

	$theme->display();

This loads module's default template (theme/default.tpl and theme/default.css).

**Advanced**

	$theme->display($user_template, $fullname);

_$user_template_ is path to template you want to load. It has to be specified without extension. _Base/Theme_ tries to load both .tpl and .css files for theme you specify.

$fullname is used to differentiate between module's own files located in its theme directory and global files. When _$fullname_ is set to **false**, _$user_template_ is expected to be in _theme_ directory. When **true** you must specify full path to template (without extension).

####Setting Data
___

Let's assume that instance of Base/Theme is in $theme variable (set as in here). Also remember, you have to use dislpay() to show template.

**Disclaimer**

Technically, $theme is a reference to main smarty class, so most of what you know about smarty can be applied. To read more about smarty, visit its homepage: [1]

**Examples**

Below examples are just to show some of templating system's functionality.

**Simple replace**

Code in template file:

	<h1>{$title}</h1>
	<p>{$content}</p>

Code in PHP file:

	$theme->assign('title', 'Testing title for tutorial');
	$theme->assign('content', 'And some content...');

The _assign_ method tells the templating system to replace string passed as first argument with second argument. HTML result:

	<h1>Testing title for tutorial</h1>
	<p>And some content...</p>

**More complex replace**

Code in template file:

	<h1>{$article.title}</h1>
	<p>{$article.content}</p>

Code in PHP file:

	$article = array(
		'title' => 'Testing title for tutorial',
		'content' => 'And some content...'
	);
	$theme->assign('article', $article_data);

Here we assign whole array to a variable. Note, that a dot is used to access array's elements. HTML result (the same as above):

	<h1>Testing title for tutorial</h1>
	<p>And some content...</p>

Even more complex replace (foreach loop)

Code in template file:

	<table>
	{foreach from=$numbers_list item=row}
		<tr>
		<td>{$row.number}</td>
		<td>{$row.square}</td>
		</tr>
	{/foreach}
	</table>

Code in PHP file:

	$numbers = array();
	for($i = 1; $i <= 3; $i++) {
		array_push(
			$numbers, 
			array(
				'number' => $i,
				'square' => $i*$i
			)
		);
	}
	$theme->assign('numbers_list', $numbers);

The _foreach_ loops goes through _$numbers array_. Its elements are also arrays, so to display their content, we have to access elements with the dot. HTML result:

	<table>
		<tr>
		<td>1</td>
		<td>1</td>
		</tr>

		<tr>
		<td>2</td>
		<td>4</td>
		</tr>

		<tr>
		<td>3</td>
		<td>9</td>
		</tr>
	</table>