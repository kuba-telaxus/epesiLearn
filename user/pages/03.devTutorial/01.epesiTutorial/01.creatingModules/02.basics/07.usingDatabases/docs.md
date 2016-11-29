---
title: Using Database
taxonomy:
    category: docs
---

To execute any SQL query you can use DB static method Execute:

	DB::Execute($query);
	example: DB::Execute('SELECT * FROM mytable WHERE myfield=5');

While passing any argument to Execute you should use syntax similar to printf to preserve system safety:

	DB::Execute($query,$array_of_values);
	example: DB::Execute('SELECT * FROM mytable WHERE field1=%s AND field2=%d',array($field1,$field2));

Moreover, there are functions that simplify some tasks or grant flexibility. Functions you may find most useful are:

	DB::CreateTable('<table_name>','<fields>',array('constraints'=>'<constraints>'));
	example:DB::CreateTable('my_module__my_table',
		'id I4 AUTO KEY,'.
		'name C(64) NOTNULL,'.
		'user I4 NOT NULL',
		array('constraints'=>', FOREIGN KEY (user) REFERENCES user_login(id)'));

Table creation should be usually placed in <module name>Install.php file, in install() function. Along with table creation you should also add table deletion in the same file within function uninstall(). To drop a table you can use function

	DB::DropTable('<table_name>');