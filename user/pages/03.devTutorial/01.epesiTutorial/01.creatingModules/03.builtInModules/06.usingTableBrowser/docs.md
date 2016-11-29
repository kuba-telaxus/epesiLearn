---
title: Using Table Browser
taxonomy:
    category: docs
---

Generic Browser is a module created to present data in tabular form. It is useful when displaying database query results or multiplication table...

####Usage
___

First, we need to init Utils/GenericBrowser module:

	$gb = &$this->init_module('Utils/GenericBrowser', null, 'table\'s name');

2nd argument ... and 3rd is for identyfcation of the table.

With GenericBrowser initialized, we can start to populate it with data. First, we need to set table's columns:

	$gb->set_table_columns(
		array(
			array('name'=>'Row number', 'width'=>60),
			array('name'=>'header 2', 'width'=>5),
			array('name'=>'last header', 'width'=>25)
		)
	);

The above code makes the table have 3 columns, where the first one is the widest and middle one the narrowest. Of course, you are not limited to just 3 columns.

Now we can populate table with data:

	for( $i = 0; $i < 10; $i++) {
		$gb->add_row( 'Row '.$i, 'narrow', 'last' );
	}

Note that total number of arguments for method add() must be the same as number of columns specified earlier. Otherwise an error occures.

To display the table use:

	$this->display_module( $gb );