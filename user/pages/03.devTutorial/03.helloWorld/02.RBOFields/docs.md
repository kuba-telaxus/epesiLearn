---
title: RBO Fields
taxonomy:
    category: docs
---

In the previous tutorial I showed how to use RBO in your module. There are many types of fields you can use in RBO recordsets. You decide which types of fields you will have in Recordset.php in fields() function. Here is a list of all available RBO field types.

####text
___

Holds a string value. HTML entities are escaped. The length of the field must be defined.

	$text = new RBO_Field_Text('<field_name>');
	$text->set_length(24)->set_required()->set_visible();

Because of fluent interface you can customize the field in one line. You can set the length of the text using the set_length(value) method where value is the length of the text. In order for the field to be visible you must always activate set_visible(). If you want the field to be required you can do so by setting it to set_required(). Now the field will notify if someone was to save the record with this field empty and will have to fill it before saving.

i.e.

	$text = new RBO_Field_Text('Text');
	$text->set_length(24)->set_required()->set_visible();

![](/images/)

####long text
___

Holds note (long string value). HTML entities are escaped. It has support for the bbcode feature. Due to the fact that attachments are added to nearly all RecordSets - we limit the length of that field to 400 characters (not counting bbcodes tags).

	$long_text = new RBO_Field_LongText('<field_name>');
	$long_text->set_visible();

i.e.

	$longtext = new RBO_Field_LongText('Longtext');
	$longtext->set_visible();

![](/images/)

####integer
___

Holds integer value.

	$int = new RBO_Field_Integer('<field_name>');
	$int->set_visible();

i.e.

	$integer = new RBO_Field_Integer('Integer');
	$integer->set_visible();

![](/images/)

####autonumber
___

Creates a primary key for every new record.

	$ID = new RBO_Field_Autonumber('<field_name>');
	$ID->set_visible();

i.e.

	$ID = new RBO_Field_Autonumber('helloworldID');
	//$ID->set_visible();;

The id is an autonumber so it does not need to be visible therefor do not use the set_visible method. Comment it.

![](/images/)

*WARNING*: Do not set the field name to *ID*.

####float
___

Holds float value.

	$float = new RBO_Field_Float('<field_name>');
	$float->set_visible();

i.e.

	$float = new RBO_Field_Float('float');
	$float->set_visible();

![](/images/)

####checkbox
___

Holds bool value. Return **true** for checked fields and (empty string - it's used by every type for empty value) for unchecked.

	$CB = new RBO_Field_Checkbox('<field_name>');
	$CB->set_visible();

i.e.

	$CB = new RBO_Field_Checkbox('CB');
	$CB->set_visible();

![](/images/)

####calculated
___

Calculated field doesn't hold any value by default. This field is designed to bring some information (it's read-only) to the user. For this reason display_callback is required property. If needed, data type can be selected via param property - this value is then usually modified in processing callback.

$Calc = new RBO_Field_Calculated('<field_name>');
$Calc->set_visible();
i.e.

$Calc = new RBO_Field_Calculated('Calc');
//$Calc->set_visible();
In order for this field to output some calculations you must use the __display_magic_callback function. So let's say that your calculated field is called 'calc' and you wan't to check if someone checked cb and if so you wan't to return the sum of the integer fields value and 20. This is how the function should look like