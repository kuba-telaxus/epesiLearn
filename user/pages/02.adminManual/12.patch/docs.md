---
title: Patch
taxonomy:
    category: docs
---

####What is Patch
___

Patch is a small script inside of module directory that is used to run any necessary code during module upgrade. It will be executed only once - system will store information that patch has been executed in simple database table patches. Patch file location and name are used to generate unique patch id. If you will rename patch or move it to another module it will be executed once again.

If patch has failed due to some errors it will be executed every time you'll run patches.

**Patch location and filename**

Every patch is located in _patches_ directory inside of any module. E.g. _modules/CRM/Contacts/patches_.

Patches should be named in special format to make sure that they are run in specific order. Every newly created patch filename should follow these format

**YYYYMMDD_patch_description.php**
   
   where **YYYYMMDD** is a date format
   
   example patch name: **20121129_admin_display.php**

Patches are sorted by that dates. Every patch that doesn't follow these naming rules will be executed earlier! It's a special case for the system important changes - they have to be executed before any other patches. For instance let we have some patch that adds a field to recordset. If we have changed fields definition structure and there is already a new PHP code for that new structure, we have to update database before we can add any field.

####Run Patches
___

System update procedure runs patches.

If you wish to run them without system update, open Admin tools, select Patches menu entry and run procedure.

####For Developers
___

If you wish to write a patch for your module then you have to create patches directory in your module. As patches are intended for upgrade of installed modules, they won't be executed during module installation, but they will be marked as applied. For instance your first module version has a recordset with one field. You have decided to add a field, so you have to update install procedure (RBO class) to add new field. Then you have to create patch to add exactly the same field as in new installation procedure.

**Guidelines**

   * Write patch as a foolproof code - it may occur that it will be executed twice due to some errors in system.

   * Check for the table before you'll create it, check for the column before you'll create it.

   * Make sure you won't overwrite some user changes.

   * Use checkpoints.

   * Split lengthy operations to atoms and use time requirements.

   * Do not use **die** - throw Exceptions if you have to, but only is some special cases, as it will require admin intervention.

   * Use access control statement defined("_VALID_ACCESS") || die('Direct access forbidden');

**Simple example**

Just for a quick start - here is a simple patch to add some fields to recordset:

    defined("_VALID_ACCESS") || die('Direct access forbidden');
 
	$my_recordset = new Custom_MyModule_Recordset();
	// field definition - as in the new install method
	$field = new RBO_Field_Text(_M('Sample'), 128);
	$field->set_visible()->set_required();
	// check if field already exists
	$fields = Utils_RecordBrowserCommon::init($my_recordset->table_name());
	if (!isset($fields[$field->name])) {
      $my_recordset->new_record_field($field);
	}

**Database operations**

If you wish to alter database tables that you've created with

	DB::CreateTable( ... );

You should use special functions for that:

	PatchUtil::db_add_column($table_name, $table_column, $table_column_def)
	PatchUtil::db_drop_column($table_name, $table_column)
	PatchUtil::db_rename_column($table_name, $old_table_column, $new_table_column, $table_column_def)
	PatchUtil::db_alter_column($table_name, $table_column_name, $table_column_def)

To create or drop table you can use standard DB static methods.

**Patch checkpoints**

Sometimes patch is more complicated and contains several operations. You should check is it needed to apply desired changes to avoid double execution of some code. Sometimes you won't be able to retrieve this information from the system, so we've invented checkpoints system for that.

Checkpoint:

   * has a name,

   * will last as long as patch is not fully applied. Then all checkpoint data will be deleted,

   * can be marked as executed,

   * can store additional variables

Checkpoint data is stored in data directory in the directory _patch_<patch_id>_, e.g. _patch_af467809ee1e033d54ba1dd98f0c8bba_.

Inside this directory will be a files - one for each checkpoint. For checkpoint named test it will be a file

	098f6bcd4621d373cade4e832627b4f6.dat // md5('test').dat

Inside those files you'll find serialized object with data.

Data is serialized and stored to file every time you'll set checkpoint's variable.

Example:

	defined("_VALID_ACCESS") || die('Direct access forbidden');

	$rs_checkpoint = Patch::checkpoint('recordset');
	if (!$rs_checkpoint->is_done()) {
		// do something
		$rs_checkpoint->done(); // this updates checkpoint's dat file
	}

	$another_checkpoint = Patch::checkpoint('other');
	$i = $another_checkpoint->get('i', 0); // 0 is a default value if variable doesn't exist
	while ($i < 10) {
		Patch::require_time(3); //require at least 3 seconds -- see further for more information
		// some lengthy operation
			$i += 1;
		$another_checkpoint->set('i', $i);  // this updates checkpoint's dat file
	}

**Time requirements**

Most servers limits script execution time. EPESI update is just a script that will be terminated if it will last too long. It may break update process, so we have to split time consuming tasks in chunks. Between those chunks we have to save our progress with checkpoints and call require_time to check how much time we have left.

You have to use require_time if you suspect that your code will be time consuming - e.g. process every record - You can't be sure how many records are there.

Code will break at require_time call if patch doesn't have enough time. We've assumed that patches run process can be 30 seconds long. You should split your code to small chunks and do not require more than 30 seconds. If you'll require more than 30 seconds during the first second of patches execution, then your code will be executed - however it may fail due to server time limits.

Example:

	defined("_VALID_ACCESS") || die('Direct access forbidden');
 
	$checkpoint = Patch::checkpoint('process_records');
	if ($checkpoint->is_done() == false) {
		$id = $checkpoint->get('id', 0);
		$records = Utils_RecordBrowserCommon::get_records('contact', array('>id' => $id), array(), array(':id' => 'ASC')); // get records - make sure to order by ID
		foreach ($records as $r_id => $r) {
			Patch::require_time(3); //require at least 3 seconds
			// process record here
 
			// save id
			$checkpoint->set('id', $r_id);
		}
		$checkpoint->done();
	}

You can also use dynamic time calculation by using checkpoint's require_time. It calculates time between consecutive calls and requires the longest period. It may slowdown total patches execution but it should be more safe than previous method. Slowdown may occur if one cycle has been very time consuming, then every next call will require much more time than it requires in fact.

Example:

	1st cycle require default argument. Execution lasts 5 seconds
	2nd cycle require 5 secods. Execution lasts 20 seconds
	3rd cycle require 20 seconds - not enough time (25 seconds already passed - just 5 sec left) - break execution
	Run patches again with next http request
	1st cycle require 20 seconds. Execution lasts 5 seconds
	2nd cycle require 20 seconds. Execution lasts 5 seconds
	3rd cycle require 20 seconds - not enough time (about 10 seconds passed - slightly less than 20 left) - break execution
	Run again...
	etc...

Modified patch example:

	defined("_VALID_ACCESS") || die('Direct access forbidden');
 
	$checkpoint = Patch::checkpoint('process_records');
	if ($checkpoint->is_done() == false) {
		$id = $checkpoint->get('id', 0);
		$records = Utils_RecordBrowserCommon::get_records('contact', array('>id' => $id), array(), array(':id' => 'ASC')); // get records - make sure to order by ID
		foreach ($records as $r_id => $r) {
			$checkpoint->require_time(3); // require 3 seconds for the first call. Every consecutive call will require max of all previous calls.
			// process record here
 
			// save id
			$checkpoint->set('id', $r_id);
		}
		$checkpoint->done();
	}

**Patch identifier**

If you'll peek into _patches_ table, you'll see one column with identifiers. If certain patch has been applied, EPESI gets its identifier and stores it in the database. Identifier generation is simple MD5 sum of the relative path (with slash for Windows too).

**Patch**

   _modules/CRM/Contacts/patches/20140812_description_callbacks.php_
   
   Identifier: _af467809ee1e033d54ba1dd98f0c8bba_

If you're during patch development and you wish to run it again you can delete certain identifier from _patches_ table.