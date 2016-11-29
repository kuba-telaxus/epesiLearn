---
title: RBO
taxonomy:
    category: docs
---

####Introduction
___

RecordBrowser object wrapper allows easy creation, use and maintenance of RecordSets. It covers most of functionality provided by RecordBrowser, but everything is done in objective way. It's wrapper around static RecordBrowser's methods, so if you need better performance than code readability use RecordBrowser directly, but in most cases any slow down wouldn't be noticed.

**Glossary**

* RecordBrowser (RB) - Module Utils/RecordBrowser documented here.

* RecordSet - a set of records managed by RB (same as here).

* Field definition - set of properties required to create field in new RecordSet (such as name, type, etc - more info)

**Brief classes description**

Every built-in class name related to this extension begins with **RBO_** prefix.

**RBO_Recordset**

	Object of this class represents RecordSet. Here is proxy to all RB functions, but you have to extend this class with your own implementation (details below) or use Recordset Accessor.

**RBO_Record**

	Represents single record from RecordSet.

**RBO_RecordsetAccessor**

	This class provides object wrapper for any RecordSet.

**RBO_FieldDefinition**

	This is generic field definition class. You can use it, but simpler and better is to use specific field classes listed here.

**Field definitions classes**

* RBO_Field_Text

* RBO_Field_LongText

* RBO_Field_Integer

* RBO_Field_Float

* RBO_Field_Checkbox

* RBO_Field_Calculated

* RBO_Field_Date

* RBO_Field_Timestamp

* RBO_Field_Currency

* RBO_Field_Select

* RBO_Field_MultiSelect

* RBO_Field_CommonData

* RBO_Field_PageSplit

####Learn by example
___

**Usage for already created RecordSet**

You can create RecordSet object for any existing RecordSet by using RBO_RecordsetAccessor class.

	$rbo = new RBO_RecordsetAccessor('contact');
	echo $rbo->get_records_count();
	$record = $rbo->get_record(23);   // retrieve contact with id = 23
	if ($record != null) {
    	echo $record->first_name;
    	$record->first_name = 'Test'; // change first name field
    	$record->save();              // save record
	}
	$records = $rbo->get_records(array('first_name' => 'Test'));

**Your own RecordSet**

To make your own RecordSet you have to write one single class that extends RBO_Recordset class.

At first you have to create module. If you don't know how, please read documentation. I assume that our module path is EPESI_DIR/modules/Custom/Inventory. Our RecordSet class name have to consist of module name followed by file name to let autoloader load this class. If your installation doesn't have autoloading feature you need to include file manually.

**Only RecordSet class**

File modules/Custom/Inventory/Categories.php:

	class Custom_Inventory_Categories extends RBO_Recordset {
 
    	function table_name() {
        	return 'custom_inventory_categories';
    	}
 
    	function fields() {
        	$category_name = new RBO_Field_Text('Name');
        	$category_name->set_length(24)->set_required()->set_visible();
 
        	$description = new RBO_Field_LongText('Description');
        	$description->set_visible();
 
        	return array($category_name, $description);
    	}
	}

And your RecordSet is ready to use! Now you have to install RecordSet during module's install procedure.

	class Custom_InventoryInstall extends ModuleInstall {
 
    	function install() {
        	$categories = new Custom_Inventory_Categories();
        	$success = $categories->install();
        	return $success;
    	}
     
    	...
	}

**RecordSet class and Record class**

You can define your own class that extends RBO_Record. Use it to specify your own methods attached to record. Every record returned from your RecordSet will be object of your Record class.

File modules/Custom/Inventory/Category.php:

class Custom_Inventory_Category extends RBO_Record {
 
    function print_summary() {
        print $this->name . " - " . $this->description;
    }
}

File modules/Custom/Inventory/Categories.php:

	class Custom_Inventory_Categories extends RBO_Recordset {
 
    	function table_name() {
        	return 'custom_inventory_categories';
    	}
 
    	function class_name() {
        	return 'Custom_Inventory_Category';
    	}
 
    	function fields() {
        	$category_name = new RBO_Field_Text('Name');
        	$category_name->set_length(24)->set_required()->set_visible();
 
        	$description = new RBO_Field_LongText('Description');
        	$description->set_visible();
 
        	return array($category_name, $description);
    	}
	}

Sample usage:

	$rb = new Custom_Inventory_Categories();
	$rec = $rb->get_record(1);
	$rec->print_summary();

####Magic callbacks
___

**Overview**

Sometimes there is a need to modify data before display or show it in different color according to some rules. This can be simply achieved using magic callbacks. Magic callbacks are QFfield and display callbacks, known from Utils/RecordBrowser, but you don't have to define them explicitly in field definition.

Just create method named display_<field id> or QFfield_<field id>, where field id is id returned by Utils_RecordBrowserCommon::get_field_id. Simply its lowercased name with every non alphanumeric character replaced by underscore. Name => name, Last Name => last_name, Address 1 => address_1. Such methods may be defined in your RecordSet class or Record class. During RecordSet install process they will be discovered and set as appropriate callback.

File modules/Custom/Inventory/Categories.php:

	class Custom_Inventory_Categories extends RBO_Recordset {
 
    	function table_name() {
        	return 'custom_inventory_categories';
    	}
 
    	function fields() {
        	$category_name = new RBO_Field_Text('Name');
        	$category_name->set_length(24)->set_required()->set_visible();
 
        	$description = new RBO_Field_LongText('Description');
        	$description->set_visible();
 
        	return array($category_name, $description);
    	}
 
    	function display_name($record, $nolink) {
        	return $record->record_link('my prefix' . $record->name, $nolink);
    	}
	}

**In which class define those methods?**

As mentioned You can define such method in RBO_Recordset or RBO_Record child class. If you will define in both, RBO_Recordset method will be used.

It's up to you where you put this method. When defined in Record class $this is your record's object filled with all data, but it's one more class to write.

**Display callback**

**Function arguments**

There are two cases, depending on where you have defined method. If you've defined method in Record class you will not get record object as first argument.

Parameters:

   1. Object of RBO_Record class (or class returned by class_name() method) - only for method in RecordSet class!
   
   2. Do not create link directive.
   
   3. Field definition in array

**Examples**

In Record class:

	class Custom_Inventory_Category extends RBO_Record {
 
    	...
 
    	function display_name($nolink) {
        	return $this->record_link('my prefix' . $this->name, $nolink);
    	}
	}

In RecordSet class:

	class Custom_Inventory_Categories extends RBO_Recordset {
 
    	...
 
    	function display_name($record, $nolink) {
        	return $record->record_link('my prefix' . $record->name, $nolink);
    	}
	}

**QFfield callback**

It's used in every place where QuickForm library would render field.

**Function arguments**

   1. Libs/QuickForm module instance

   2. Field id (e.g. first_name, address_1)

   3. Field label/name (e.g First Name, Address 1 - same as defined in Field Definition as name)

   4. Form display mode.

   5. Default value. Default value or current record's value for this field.

   6. Field definition in array

   7. Utils/RecordBrowser module instance

**Examples**

In Record class:

	class Custom_Inventory_Category extends RBO_Record {
 
    	...
 
    	function QFfield_name($form, $field, $label, $mode, $default) {
        	if ($mode == 'view') {
            	$form->addElement('static', $field, $label, $this->display_name());
        	} else {
            	$form->addElement('text', $field, $label);
            	$form->setDefaults(array($field => $default));
        	}
    	}
	}

In RecordSet class:

	class Custom_Inventory_Categories extends RBO_Recordset {
 
    	...
 
    	function QFfield_name($form, $field, $label, $mode, $default) {
        	if ($mode == 'view') {
            	$record = $this->record_to_object($rb_obj->record);
            	$form->addElement('static', $field, $label, $record->display_name());
        	} else {
            	$form->addElement('text', $field, $label);
            	$form->setDefaults(array($field => $default));
        	}
    	}
	}

####Detailed classes description
___

**RBO_Recordset**

This class is abstract. You must extend it to define own Recordset.

Example:

	class Custom_Inventory_Categories extends RBO_Recordset {
    	...
	}

**Abstract methods**

Abstract methods that have to be implemented:

**table_name()**

   Return table name used to identify RecordSet.
      
      * It should consist only of alphanumeric and underscore characters (regex [a-zA-Z_0-9])
      
      * Returned string length can't exceed 39 characters.
      
      * To avoid name collisions it should begin with module name.
   
   We suggest to use names lower-cased names like '<category>_<module>_<recordset>' or just '<category>_<module>', when only one recordset is used, e.g.

      * premium_listmanager_element

      * premium_listmanager_history

      * crm_assets

Example:

	function table_name() {
    	return 'custom_inventory_categories';
	}

**fields()**

   Return array of fields used to install recordset.

      * Every array entry should be instance of RBO_FieldDefinition.

      * Order of fields in array is significant and it defines order of fields display.

Example:

	function fields() {
    	$category_name = new RBO_Field_Text('Name');
    	$category_name->set_length(24)->set_required()->set_visible();
 
    	$description = new RBO_Field_LongText('Description');
    	$description->set_visible();
 
    	return array($category_name, $description);
	}

**Optional override**

**class_name()**

   Override this method to specify class, that extends RBO_Record. Records retrieved from RecordSet will be in this specified type. Use this to add custom methods to your records.

Example:

	class Custom_Inventory_Item extends RBO_Record {
    	function is_my_favourite() {
        	// code here
    	}
	}
 
	class Custom_Inventory_Items extends RBO_Recordset {
    	function table_name {
        	return 'custom_inventory_items';
    	}
 
    	function fields() { /* implementation here */ }
 
    	function class_name {
        	return 'Custom_Inventory_Item';
    	}
	}
**Overriding constructor**

**__construct()**

   Constructor can be overriden but you have to call parent's constructor to initialize object properly.

	function __construct() {
    	parent::__construct();
    	// your code goes here
	}

**Creating record object from existing data**

Sometimes you may get record stored in array and you are sure, that this is record from certain RecordSet. This may be when you retrieve record using Utils_RecordBrowserCommon::get_record() directly, or when you get record data in display callback call. In such situation you use one of the following methods.


array_to_object($record_array)
   
   Create object from single record.

	// record data in array
	$record = Utils_RecordBrowserCommon::get_record('custom_inventory_items', $id);
 
	$rs = new Custom_Inventory_Items();
	$object = $rs->array_to_object($record);

**array_of_records_to_array_of_objects($array_of_record_arrays)**
   
   Create array of objects from array of records stored as array.

	// get all records
	// $records = Utils_RecordBrowserCommon::get_records('custom_inventory_items');
 
	//    $records = array(
	//        array('id' => 1, 'field1' => 'data1'),
	//        array('id' => 2, 'field1' => 'data2'),
	//        etc.
	//    );
 
	$rs = new Custom_Inventory_Items();
	$objects = $rs->array_of_records_to_array_of_objects($records);
 
	//    $objects = array(
	//        instance of RBO_Record,
	//        instance of RBO_Record,
	//        etc.
	//    );

**create_record_object($recordset_class_name, $record_array)**

   This is protected static method to create record's object and bind it to RecordSet. It can be used only in class that inherits from RBO_Recordset and is created for convenience.

   Due to limitations of PHP version lower than 5.3 we cannot determine class name in inherited static methods, nor use late static binding. As custom display or QFfield callback are always static methods, we cannot create generic method in parent to obtain record object in child class. We must give class name explicitly and we can do this using __CLASS__.

   Maybe you don't need this method - read more about Magic callbacks.

Right use of this method is such as below:

	class Custom_Inventory_Items extends RBO_Recordset {
    	...
 
    	function custom_display_callback($record_array, $nolink, $field_desc) {
        	$object = self::create_record_object(__CLASS__, $record_array);
        	// ... further code
    	}
	}

**RBO_Record**

RBO_Record is used to represent record from any recordset. Object of this class allows you to manipulate record by calling specific methods.

Also you can extend this class to declare own methods attached to record, or implement QFfield or display callback. In such situation you have to declare class_name() method in your RecordSet class.

**Accessing data**

Data is stored in object properties. Every defined field from RecordSet has related property. Property name may be retrieved from field name by function Utils_RecordBrowserCommon::get_field_id(). Result is just lowercased field name with replaced all non-alphanumeric characters with underscore - e.g. Name => name, Last Name => last_name, Address 1 => address_1.

Also RBO_Record class implements ArrayAccess interface to allow using object like array, what holds compatibility with plain data retrieved from Utils_RecordBrowserCommon functions. If you have written functions, that operate on data arrays from RecordBrowser they should work as well with RBO_Record objects.

Preferred way to access data is to use properties, because using array like access is just slower.

	$rs = new RBO_RecordsetAccessor('contact');
	$record = $rs->get_record(1);
 
	echo $record->first_name;
	echo $record['first_name'];  // slower

**Creating new records*

To create new record object you should use RBO_Recordset::new_record() method instead of directly creating RBO_Record object.

Example:

	$rs = new RBO_RecordsetAccessor('contact');
	$record = $rs->new_record();
	$record->first_name = 'Joe';
	$record->last_name = 'Doe';
	$record->save();

However if you have some record's data stored in array you can supply this array directly to RBO_Recordset::new_record() method and record will be created in database and record's object will be returned:

	$rs = new RBO_RecordsetAccessor('contact');
	$data = array('first_name' => 'Joe', 'last_name' => 'Doe');
	$joe = $rs->new_record($data);

**Special properties**

Every record object has four special properties:

**id**

   Records ID. This is read-only property. You shouldn't edit it. Every record retrieved from RecordSet has this property set to numeric value. Every newly created record with RBO_Recordset::new_record() method has this property null and it will be filled when save() method is called.

**_active**

   This property indicates that record is active (not deleted) or not (deleted). All deleted by user records are in fact marked as not active. You can manipulate state of record using function such as: delete(), restore(), set_active($state).

**created_by**

   ID of user, that created record. For new (not saved) records it's null. After calling save() it will get id of currently logged user - value returned by Acl::get_user() function.

**created_on**

   Date and time in format returned by date('Y-m-d H:i:s'). It's only filled in records retrieved from database. This property won't be filled after calling save() on newly created records.

**Select/Multiselect returned value**

Value of select or multiselect field is always id from other RecordSet, that this field links to. It's integer however it's stored in string, because that's how it's returned from database, even it's DB type is integer.

	$contacts = new RBO_RecordsetAccessor('contact');
	$record = $contacts->get_record(1);
	assert(is_numeric($record->company_name));
	assert(is_string($record->company_name));
 
	$companies = new RBO_RecordsetAccessor('company');
	$company = $companies->get_record($record->company_name);
	$real_company_name = $company->company_name;

**About returned types**

Some object properties, as _active, id, fields of checkbox or integer type, may be of string type. Always use weak comparison operator - double equal, not triple (==, not ===).

	$rs = new RBO_RecordsetAccessor('contact');
 
	$record = $rs->get_record(13);
	assert(is_int($record->id));
 
	assert(is_string($record->_active));
	assert($record->_active == true);
	// as $record->_active is string "1"
 
	$record = $rs->get_record('13');
	assert(is_string($record->id));

**RBO_RecordsetAccessor**

Use this class to access any recordset by it's name. All records returned are objects of RBO_Record class.

There is one restriction according to objects of this class - you can't use fields() function, because it triggers error. This class can't read fields definition from existing RecordSet. This is not a problem, because fields() function is used only to install RecordSet and, as you are trying to access existing RecordSet, you shouldn't call install() method. But you can call uninstall() method if you want to.

	$rs = new RBO_RecordsetAccessor('company');
 
	// example 1
	$all_records = $rs->get_records();
 
	// example 2
	$new_record = $rs->new_record();  // returns RBO_Record instance
	// fill data
	$new_record->save();
 
	// etc ...

**RBO_FieldDefinition**

This is a base class used to describe field definition. Use this directly class only when you need to use custom types. For basic fields use one of field definition subclasses.

Every specific class has defined constant type where field type used by RecordBrowser is stored. If you need to use somewhere type's name you don't have to remember it's string, when you use auto-completing IDE.

Methods:

**__construct($display_name, $type, $param = null, $extra = false, $required = false, $visible = false, $filter = false, $display_callback = null, $QFfield_callback = null, $position = null)**

   For some type of fields $param is required.

**get_definition()**
 
   Returns array with definition, like for RecordBrowserCommon::new_record_field() method.

**set_extra()**

   Set field as extra. By default every new field described by FieldDefinition class is marked as non-extra field.
   Extra fields can be modified by administrator and in view mode they appear in tab, like addons.
   Returns self reference.

**set_required()**
Set field as required. By default every new field described by FieldDefinition class is optional.
Returns self reference.
set_visible()
   Set field visible in browse mode. In other words visible fields will make new column in tabular view. By default every new field described by FieldDefinition class is showed only in view mode.
   Returns self reference.

**set_filter()**

   Set filtering according to this field. For instance, if checkbox field has filtering enabled, then you will have option to show records, where checkbox was checked or not. If field is select you will have dropdown list to choose value to filter.
   By default filtering for field is disabled.
   Returns self reference.

**set_display_callback($callback)**

   Set custom display callback for field. Argument must be callable. For more info see Magic callbacks
   Returns self reference.

**set_QFfield_callback($callback)**

   Set custom QFfield callback for field. Argument must be callable. For more info see Magic callbacks
   Returns self reference.

**set_position($position)**

   Set position for new field. Use only in case of adding new fields to RecordSet. When position for field is not supplied it will be set at the end. During install process just place definitions in right order in array returned by fields() method.
   
   Supplied argument may be:
      
      * numeric

      starting from 1. Field with position = 1 will be set as first field in view. With position = 2 as second, etc.

      * string

      Supply field name (e.g. 'First Name') and new field will be right after supplied field.

      * RBO_FieldDefinition object

      New field will be placed right after this field. It may be more convenient to use this way, but this object is just used to extract field name.

**Simple example**

	// used for custom type defined by CRM/Contacts
	$contact = new RBO_FieldDefinition(_M('Owner'), 'crm_contact', array('field_type' => 'select'));
	$contact->set_visible()->set_required();
 
	// _M('Owner')  -- marks string "Owner" to translate later and returns original string.

**Basic fields**

Every specific class has defined constant type where field type used by RecordBrowser is stored. If you need to use somewhere type's name you don't have to remember it's string, when you use auto-completing IDE.

**RBO_Field_Text ($display_name, $length = null)**

   length parameter may be null, but then you have to use set_length method
   
   **set_length($length)**
      
      length in characters

**RBO_Field_LongText ($display_name)**

**RBO_Field_Integer ($display_name)**

**RBO_Field_Float ($display_name)**

**RBO_Field_Checkbox ($display_name)**

**RBO_Field_Calculated ($display_name)**
 
   set_db_type($type, $param = null)

      Set database representation of this field.

      $type name of type or field instance. In case of field instance only type and it's param will be copied and this function $param will be ignored.

      $param is length of field when $type = 'text', otherwise null.

**RBO_Field_Date ($display_name)**

**RBO_Field_Timestamp ($display_name)**

**RBO_Field_Currency ($display_name)**

**RBO_Field_Select**
   
   See PHP docs for more info.

   **from($linked_recordset)**

   **fields($field, $_ = null)**

   **set_crits_callback($crits_callback)**

   **set_advanced_properties_callback($advanced_properties_callback)**

**RBO_Field_MultiSelect**

   Same as RBO_Field_Select, but user has option to select multiple values.

**RBO_Field_CommonData**

   **from($commondata_array_name)**
      
      Common array name as supplied to Utils_CommonDataCommon::new_array($name, $values).

   **set_order_by_key()**

      Force order by array keys.

   **chained_select($field, $_ = null)**

      Set previous field(s) for chained select.

**RBO_Field_PageSplit ($name)**

   Adds new tab to view mode. All fields after page split will be on this tab, until next page split. Name is string to display on tab.

Examples:

	// Sometimes there is more than one valid way to define field. Choose you own method.
 
	$first_name = new RBO_Field_Text(_M("First Name"), 15);
	$first_name->set_required()->set_visible();
 
	$last_name = new RBO_Field_Text(_M("Last Name"));
	$last_name->set_length(30)->set_required()->set_visible();
 
	$bio = new RBO_Field_LongText(_M("Biography"));
 
	$siblings = new RBO_Field_Integer(_M("Siblings"));
 
	$weight = new RBO_Field_Float(_M("Weight"));
 
	$likes_tomatoes = new RBO_Field_Checkbox(_M("Likes tomatoes"));
 
	$age = new RBO_Field_Calculated(_M("Age"));
	$age->set_visible();
 
	$birth_date = new RBO_Field_Date(_M("Birth date"));
	$birth_date->set_required()->set_visible();
 
	$last_visit = new RBO_Field_Date(_M("Last visit"));
 
	$assets = new RBO_Field_Currency(_M("Personal assets"));

####Changelog
___

**1.4.0**

First release.

**1.5.0**

* Add option to disable magic callback generation for certain field

* Fix :active property issue. Now it's translated properly to _active.

* Add option to set multiselect from CommonData.

* Add method to delete field from recordset RBO_Recordset::delete_record_field

* New field types: Time, Autonumber, Company, Contact, CompanyOrContact, Employee, Email, Phone