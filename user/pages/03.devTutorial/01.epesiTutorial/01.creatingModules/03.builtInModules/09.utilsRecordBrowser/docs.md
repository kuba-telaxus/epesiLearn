---
title: Utils/RecordBrowser
taxonomy:
    category: docs
---

####Feature Overview
___

RecordBrowser allows quick and easy deployment of highly-customizable sets of records. It automatically covers browse, search, view and edit interface, favorites and recent records, full edits history and gives access to multiple types of fields. It also simplifies the use of Watchdog module.

You may be also interested in Objective RecordBrowser.

####Glossary
___

* RecordBrowser (RB) - the name of this CRUD engine

* RecordSet - a set of records managed by RB

* Field Name - name of the field as used in installation process - example: Company Name

* Field Key - key of the field as used outside installation process; it's a lowercase variant of Field Name, with spaces replaced with underscores - example: company_name

* Criteria (Crits) - set of rules for record subset retrieval

####Development
___

**New RecordSet**

To make your own custom RecordSet it's highly recommended that you make a new module to manage that new RecordSet. It's not necessary to have separate module for each RecordSet, but for the purpose of this tutorial we suggest this solution.

Once you're past that stage, you need to create installation procedure of your RecordSet - you should place it in ModuleInstall.php install() method.

First step is to define fields for this new RecordSet. Fields' definitions are to be given as an array to the install_new_recordset() method from RBCommon. Each element in this array should be a definition of a field. Each definition should be an array, with format property_name=>value.

Two properties are obligatory - name and type. The use for the rest of properties depends on the type that was selected - for some types certain properties are unusable and there's no need to specify them. Lists of properties and types are available below.

Example:

	$field1 = array('name'=>'Field 1', 'type'=>'text');
	$field2 = array('name'=>'Field 2', 'type'=>'date');
	$fields_definition = array($field1, $field2);
	Utils_RecordBrowserCommon::install_new_recordset('my_recordset',$fields_definition);

Or shorter version:

    Utils_RecordBrowserCommon::install_new_recordset('my_recordset',
     array(
      array('name'=>'Field 1', 'type'=>'text'),
      array('name'=>'Field 2', 'type'=>'date')
     ));

After you've created the RecordSet, you can now manipulate certain properties of this RecordSet:

* Quickjump - enables GenericBrowser quickjump feature for a certain field

	Utils_RecordBrowserCommon::set_quickjump($recordset_name, $field);

* Favorites - enables/disables ($bool=true/false) favorites for this RecordSet.

	Utils_RecordBrowserCommon::set_favorites($recordset_name, $bool);

* Recent - enables/disables ($amount=integer/false) recent for this RecordSet. Please note that when enabling $amount should be set to the number of stored recent entries.

	Utils_RecordBrowserCommon::set_recent($recordset_name, $amount);

* Caption - sets the ModuleIndicator caption for all windows (browse/view/edit/history). Please note that this caption will go through translation automatically, don't invoke Lang module here.

	Utils_RecordBrowserCommon::set_caption($recordset_name, $caption);

* Access Callback - sets a callback that will be used to determine access to records in this RecordSet for different user groups. More details here.

Utils_RecordBrowserCommon::set_access_callback($recordset_name, $callback);

* Processing Callback - registers a callback that enables pre/post-processing of records, on each view/edit/delete/restore. More details here.

	Utils_RecordBrowserCommon::register_processing_callback($recordset_name, $callback);

* Watchdog - enables watchdog over this RecordSet. Callback defined should hold details regarding record display in Subscription applet. More details here.

	Utils_RecordBrowserCommon::enable_watchdog($recordset_name, $callback);

**Field Properties**

* **name** - name of the field; this value will be also used as a label for the field

* **type** - type of the field; it determines the HTML form element that will be used in add/edit form and the display format (please bear in mind there's a method of overriding these properties for each field separately - we will get on that later)

* **required** - setting this to true will make RB call QuickForm error if user will try to submit form with empty value in that field. This property doesn't apply to checkbox, hidden and calculated data types. Value of this property can be changed by user with super administrator permissions. Also, please be aware that if you are going to disable a field with javascript in certain circumstances - marking that field as required will render user unable to submit the form

* **visible** - enabling this property (set to true) will make this field display by default in table view, when browsing records. This property doesn't apply to hidden data type. The use of this property will change in near future - because of user-defined views
* **extra** - by default this value is set to true. It controls the access user (super administrator) is given to the field properties. Non-extra fields are considered crucial to the system and it's impossible by admin to change their name, type and certain properties

* **filter** - if set to true it will enable filter for this field while browsing
**param** - additional parameter highly dependable on the field type. For instance, it holds the length for text fields. It may be also very useful property for fields that use QFfield_callback - since parameters given here will be available in this callback. Please refer to field types for details on param use

* **QFfield_callback** - a callback to a method that will define the field for add/edit forms. This is the method to be used if you want to execute additional javascript code or add QuickForm rules. You can also freely modify HTML select options or define custom auto-complete field. Please be aware that if QFfield_callback was defined for a certain field, RB won't do any additional processing regarding that field - you need to manually set defaults for that field and define required rule. This property is never obligatory

* **display_callback** - a callback method to define custom display method for a field. Every place where the value of the record is displayed by RB will go through this callback, if defined. This applies to view and browse interface. This property is required by calculated data type

**Built-in Field Types**

| Name | QF Type | DB Type | Description | Param |
|------|---------|---------|-------------|-------|
| text | input type="text" | C(param) | Holds a string value. HTML entities are escaped. The length of the field must be defined. | Defines the length of the field. |
|long text | <textarea>	| X	| Holds note (long string value). HTML entities are escaped. It has support for the bbcode feature. Due to the fact that attachments are added to nearly all RecordSets - we limit the length of that field to 400 characters (not counting bbcodes tags). | none |
| integer | <input type="text"> | I4 | Holds integer value. | none |
| float	| <input type="text"> | F | Holds float value. | none |
| checkbox | <input type="checbox">	| I1 | Holds bool value. Return **true** for checked fields and '' (empty string - it's used by every type for empty value) for unchecked. | none |
| calculated | *none* | Depends on param | Calculated field doesn't hold any value by default. This field is designed to bring some information (it's read-only) to the user. For this reason display_callback is required property. If needed, data type can be selected via param property - this value is then usually modified in processing callback. | DB data type. Omit for no DB representation. Please use Utils_RecordBrowserCommon::actual_db_type($type, $param) to get the correct data type. |
| date | <input type="text"> | D | Simple date field with a button that brings pop-up calendar. | none |
| timestamp | <input type="text"> for date and <select>(...)</select> for hour | T | Simple date and time field with a button that brings pop-up calendar. Time is selected using HTML select elements. The timezone conversion is done automatically for both display and update. |
| currency | <input type="text"> for date and <select>(...)</select> for hour | C(128) | Field that holds value and currency. Currency is selected using HTML *select* elements. Data format is float_value__currency_id. See Utils_CurrencyField module for more details. |
| select | <select><option>..</option></select> | I | Holds key to selected value. This type is designed to link to other RecordSets and records ids are always used as keys. Param is essential here. | Please see Select/multiselect parameter section for details |
| multiselect | <select multiple="1"><option>..</option></select> | X | Holds keys to selected values. This type is designed to link to other RecordSets and also CommonData data sets. Param is essential here. **This is the only field that returns and accepts value as an array, rather than single value** | Please see *Select/multiselect* parameter section for details |
| commondata | <select><option>..</option></select> | X | Holds key to the selected value. This type is designed to link to other RecordSets and records ids are always used as keys. Param is essential here. This type supports ChainedSelect functionality. | Must be an array. order_by_key key, with value true, can be used to indicate order by keys. Following should be list of elements (values) for ChainedSelect chain. This list is optional. Last element in the param array should be the name of CommonData table. |
| page_split | none	| none | It's a delimiter that splits different tabs of data. Each page split adds new tab with fields under that page split displayed in this tab. | The number of columns that data section should use. Default is 2 (2 fields in each row). |

**Additional Field Types**

RecordBrowser also allows to define custom data types. Mechanic of those custom data types is simply a pre-processing method that accepts field definition and returns modified field definition. This processing method may for instance add QFfield_callback, modify param property and change the type back to one acceptable by RecordBrowser.

The module CRM/Contacts already defines two such data types (*crm_contact and crm_company*). Both fields can be either a select or multi-select field that allows you to select contacts. Param should be an array with defined keys *field_type* ('select' or 'multiselect') and *crits* (a callback to static method in *Common part of a module).

Additionally, *crm_contact* has two more features. First of all, *param* can also contain *format* key with value holding a callback to static method. This method will be used to format the string in both edit and view. Two most common methods to be used in this place are:

	'format'=>array('CRM_ContactsCommon','contact_format_default')
	// John Doe [Some Company]

and

	'format'=>array('CRM_ContactsCommon','contact_format_no_company')
	// John Doe

The second feature is the option of replacing multiselect element with auto-mutliselect (autocomplete/multiselect combo). At this time the selection is rather rough, as to do this you need to return _**true**_ value in crits method when first argument is _**false**_ and return actual crits when first argument is _**true**_. This is to be changed in the near future.

**Select/multiselect parameter**

Select and multiselect param properties are somewhat more complicated. To link to another RecordSet (both field types) param should consist of 3 parts, separated with ;. 2nd and 3rd parts are optional.

First part:

	RecordSet name::Fields list with | as delimiter

Indicates which RecordSet this element refers to. You can list multiple fields if needed, they will be separated with space, listed in given order. Those fields will also be used to determine which fields are to hold given value when user uses search by this select/multiselect field.

Second part:

	ModuleCommon::crits method

This is a callback to a method that should return crits that will limit the selection of records. If not specified full set of records will be used.

Third part:

	ModuleCommon::advanced properties method

This is a callback to a method that should return additional properties for record selection, given as an array. Expected (yet, all are optional) keys are order, cols and format_callback. This third part as a whole is optional, most likely you won't need it in every field.

Example param string to configure select field that links to premium_projects RecordSet could be:

	'param'=>'premium_projects::Project Name;'.
    	     'Premium_Projects_TicketsCommon::projects_crits;'.
        	 'Premium_Projects_TicketsCommon::projects_advanced'

**Adding fields past-installation**

Usually you will define all fields to a RecordSet when calling install_new_recordset(), however sometimes you will need the option to add a field to a RecordSet that is installed in another module. Instead of editing that module code (which is bad ;)) you can use new_record_field() method from RBCommon.

First parameter for that method is RecordSet name, second is field definition, almost exactly the same format we use in install_new_recordset() (Please be aware that install_new_recordset() expects an array of field definitions, while new_record_field() accepts only single field definition)

The only difference is that in new_record_field() you can also specify position key. The value can be either an integer or a string. If it's given as integer, it will be placed **exactly on that position**, pushing fields with that position one step further (it will push page_splits as well - the layout won't be broken because of it). If position is given as a string, it should be a name of the column after which the new field will be placed.

**Access Management**

	Notice: Please be aware that access management will go through major overhaul in near future. 
	We are going to change the input/output structure to simplify achieving fields behavior.

In RecordBrowser you can specify different access levels to all actions performed on the record. You can permit only certain group to browse RecordSet, limit the pool of displayed records depending on his groups and specify who can edit what record.

All of this is done using the access callback, which you can define in installation procedure of your module:

	Utils_RecordBrowserCommon::set_access_callback($recordset_name, $callback);

This callback will be used by RB each time details regarding access are needed. It will pass up to 3 arguments. First argument is always the action performed - add, browse, edit, delete, view, fields. First 4 actions require from you to return either true or false, depending on whether you want to grant access to current user or not. View action expects an array of crits to be returned - those crits will be used to filter out records. In edit and delete, the 2nd argument is the record in question.

The _fields_ action is much more sophisticated and due to the fact it'll be deprecated very soon, we will not describe it here.

**Pre/Post-Processing (Triggers)**

RecordBrowser allows you to specify your own, custom actions on each action performed by RecordBrowser. You can modify fields or modify another RecordSet. All this is managed using processing callback. Again, to use this feature you need to register a new processing callback it in your module install() method:

	Utils_RecordBrowserCommon::register_processing_callback($recordset_name, $callback);

Please note that every RecordSet can have unlimited amount of processing callbacks defined, each of them called consecutively on every action. Processing callback can be used in handful of situations, allowing you both pre- and post-processing. Each call will pass to your method 3 arguments:

* data in question; Often, it will be record on which action is performed, but for some events, it may contain only default values for record creation (*adding*) or consist of two records (*clone*)

* action performed; full list of those action is below

Action strictly defines what is the actual data you get as first parameter as well as what is the valid result of this method. Please be aware that if processing should return updated record and nothing (array(), false, null) is returned, RecordBrowser will consider this a valid update - that removed all the fields leaving the record empty. The table below describes it all:

| Action | Data (1st param) | Expected result | Notes |
|--------|------------------|-----------------|-------|
| adding | defaults    | new defaults | Action that allows you to influence defaults for newly created record or execute Javascript code. |
| editing | record | updated record | Action that allows you to influence record right before displaying edit form. Remember that changing values here doesn't affect the record until user confirms the edit by saving changes. |
| view | record | updated record | Action that allows you to influence record right before displaying it. Remember that changing values here doesn't affect the record. Also - this action is performed only when user chooses to view the record, it doesn't work for browse mode. |
|add | record | updated record | Action that is used each time a new record is about to be created. This also applies to direct new_record() calls. Due to the time of the call for this action, it doesn't hold the id of the record. If you need id of the record, you need to use _added_ action. |
| added | record | none | Action that is used each time a new record is created. This also applies to direct new_record() calls. Different to add action, this one is called after the record is created and it already holds the id of the record. If you need to manipulate the record in this action, you must explicitly use update_record() method. |
| edit | record | updated record | Action that is used each time a new record is edited. This also applies to direct update_record() calls. |
| clone | old and new record in form of an array('original'=>$old, 'clone'=>$new) | none | Action that is used after record is cloned. |
| delete | record | none | Action that is used on delete. It's called after the record is marked as deleted. |
| restore | record | none | Action that is used on restore. It's called after the record is marked as deleted. |

**Watchdog Integration**

RecordBrowser drastically simplifies the use of Watchdog module. First of all, you need to enable the feature, by giving a callback to a method that will process Watchdog requests. As usual, this should be placed in install() method:

	Utils_RecordBrowserCommon::enable_watchdog($recordset_name, $callback);

This callback usually is fairly complicated, due to the fact is needs to bring all the data Watchdog needs. Using RB built-in method to service Watchdog requests, we get the following (example):

	public static function watchdog_label($rid = null, $events = array(), $details = true) {
 	return Utils_RecordBrowserCommon::watchdog_label(
       'task',
       Base_LangCommon::ts('CRM_Tasks','Tasks'),
       $rid,
       $events,
       'title',
       $details
      );
	}

Arguments are as follows:

	1. RecordSet name
	
	2. Label for the category
	
	3. Record id, simply passed from arguments
	
	4. Events list, passed from arguments
	
	5. Name of the field that will be used as label for a record
	
	6. Details, as passed to this function as 3rd argument

Alternatively, 5th argument can be a callback to a method, that will be given the record as first argument and is expected to return a string - the label to be used. Example below:

	public static function watchdog_label($rid = null, $events = array(), $details = true) {
 	return Utils_RecordBrowserCommon::watchdog_label(
       'premium_tickets',
       Base_LangCommon::ts('Premium_Projects_Tickets','Tickets'),
       $rid,
       $events,
       array('Premium_Projects_TicketsCommon','watchdog_label_format'),
       $details
      );
	}
	public static function watchdog_label_format($r) {
 	return $r['ticket_id'].': '.$r['title'];
	}

**Manipulating Records**

To preserve RecordBrowser's database table structure abstract to developer, several method allowing record manipulation and retrieval were created.

**new_record()**

Let's start with the most basic method:

	Utils_RecordBrowserCommon::new_record($record_set, $values);

This method allows you to create new records. Be advised that processing actions 'add' and 'added' still apply. This method only accepts fields defined via install_new_recordset() and new_record_field() methods. You cannot influence id or other data related to that record. This method will return the id of newly created record.

**update_record()**

To modify existing record you should use:

	Utils_RecordBrowserCommon::update_record($record_set, $id, $values, $full_update=false, $date=null, $dont_notify=false);

First three arguments are RecordSet name, id of the record to update and associative array of values that will be used to modify the record. Full_update argument is used to determine whether unspecified fields should be left with old value (false) or erased and saved with empty value (true). Date argument allows you to modify the edited on date. Dont_notify, when set to true, will prevent sending an event to Watchdog module - it's useful when you are preforming minor updates on records.

**get_record()**

Now to retreieve a single record, the following procedure should be used:

	Utils_RecordBrowserCommon::get_record($record_set, $id, $htmlspecialchars = true);

This method returns an array containing the record on success, null otherwise. First argument is the name of the RecordSet and second is the internal id of the record. Third argument is optional and allows you to retrieve records without escaping (htmlspecialchars() method) values. Please note that this method doesn't check whether record is active or not (i.e. deleted by user). It will, however, contain a key 'active' that indicates it's state.

**get_records()**

When we need to get multiple records that meet various conditions, get_records is the way to go:

	Utils_RecordBrowserCommon::get_records($record_set, $crits = array(), $cols = array(), $order = array(), 
     $limit = array(), $admin = false);

This method is fairly complicated. First of all, you need to pass the RecordSet name so RB will know which records to retrieve. Please keep in mind that by default only active (i.e. not deleted) records are gathered.

Second argument is so-called crits - criteria or conditions that records must meet to be placed in result pool. Crits take form of an array, where key is the column key (possible with various modifiers) and value is the value record must contain in this field. If the value is given as an array, it's treated as alternative - if record's value meets any of the values in the array - it's qualified for that criteria.

Each pair of key and value represents one of the criteria and by default they are joint with AND operator - i.e. each of them must be met by a record for it to be placed in the result pool. To give a simple example, applicable to CRM/Contacts:

	$crits = array('first_name'=>array('John','Tom'), 'last_name'=>'Doe')

In this example we will select all records where first_name is either 'John' OR 'Tom' AND where last_name is 'Doe'. Thus John Doe meets those criteria where Jeremy Doe doesn't.

In above example, order of keys doesn't matter, but depending on your choice of modifiers it may be very important. All modifiers are placed in key string, in the beginning of that string. Possible modifiers table:

| Modifier sign | Description |
|---------------|-------------|
| : | This modifier is used to indicate you want to filter by certain internal fields. Possible keys following that modifier are (case-sensitive): id, Fav, Recent, Created_on, Created_by, Edited_on. Fav and Recent as switch for whether current user must (true) or mustn't (false) have record saved in favorites and recent respectively. |
| ! | Negation - use this to invert the logic of the statement. If the value is an array, it will request from RB records in which key value doesn't match any of values contained in that array. |
| " | Disables escaping quotes when building SQL query. By default all strings are automatically escaped when building the query. This modifier is very handy when it comes to building LIKE queries, as you will need to add wildcard using DB::Concat() method. **Notice:** You must be very cautious when using this modifier, as when misused it may allow SQL injections on the system. |
| <
 > 
 <=
 >=	| Operators valid for string, integer, date and timestamp fields. Expression 

 	array('<start_date'=>'2009-01-01')

means that start_date must be lower than 2009-01-01. |
| ~ | Operator valid for string values. It replaces default = operator with LIKE operator. This operator is case-insenstive. Most handy combination using ~ modifier looks similar to:
array('"~last_name'=>DB::Concat(DB::qstr('%'), DB::qstr('foo'), DB::qstr('%')))
Which basically means last_name field must contain work foo (Foobar, Barfoobar, BarFOO). Please note that " modifier was used as well, due to the fact that escaping result of DB::Concat() is never desired. |
| ( | modifier, will be put in the same bracket and separated with ORs. More details available below. |
| | | Indicates element of OR chain. If there was no OR chain in progress, it will start a new one. More details available below. |

Of all modifiers, ( and | are definitely least intuitive. First of all, let me state clearly that when those two modifiers enter the criteria, the order in the array starts to matter. We'll explain this one based on examples. Let's say we need to find everyone who's first name is John **OR** his last_name is Doe. Either of following criteria should be used:

	array('(last_name'=>'Doe', '|first_name'=>'John')

or

	array('(first_name'=>'John', '|last_name'=>'Doe')

Both criteria will give you exactly the same result. Notice that in both of them, ( (opener) goes first, and the second element is using |. This is two-element OR chain, each element in such chain creates a rule that if met, satisfies whole chain. We can easily add another element - let's say that we also want to include everyone who is from New York. To achieve this simply add another element with | modifier:

	array('(first_name'=>'John', '|last_name'=>'Doe', '|city'=>'New York')

Now the question may arise why do we distinguish between ( and |. The reson is simple, sometimes you will need to make construction like (cond_1 OR cond_2) AND (cond_3 OR cond_4). To do this, you should use opener (() for condition_1 and condition_3. RecordBrowser, when parsing your criteria, will notice that condition_3 opens a new OR chain.

Two final notes:

* You should always start new OR chain with (, whether or not other OR chains are involved. This is because you may simply not be aware of additional criteria with which those you are currently writing might be joined with. (for instance - criteria from 'view' access)

* Every element without | modifier will break OR chain. Thus:
array('(first_name'=>'a', 'city'=>'b', '|last_name'=>'c')
Doesn't actually hold any valid OR chains (there are two one-element chains). Swapping last_name with city would create one.

**Modifying Browse view**
**Custom fields**
**Custom Templates**
