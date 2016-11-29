---
title: Using HTML Forms
taxonomy:
    category: docs
---

To create HTML form under epesi we are using PEAR QuickForm library. This library was embedded in module _Libs/QuickForm_ and this is the module you'll be using to create forms. To create single form you can use init_module() function:

	$form = & $this->init_module('Libs/QuickForm');

Now you can use object $form to extend and manage this new form.

####addElement
___

Most basic action you can perform is to add QuickForm element, in general the syntax is as follows:

	$form->addElement($type, $id, $label, $args);

However, some arguments are unnecessary for some types of field. Here is the list of most popular elements along with argument list required to create one:

	$form->addElement('header', null, $label);
	$form->addElement('static', $id, $label, $value);
	$form->addElement('text', $id, $label);
	$form->addElement('textarea', $id, $label);
	$form->addElement('select', $id, $label, $array_of_options);
	$form->addElement('checkbox', $id, $label);
	$form->addElement('radio', $id, $label, $option_label, $option_id);
	$form->addElement('button', $id, $label, $action);
	$form->addElement('submit', $id, $label);
	$form->addElement('reset', $id, $label);
	$form->addElement('hidden', $id, null);
	$form->addElement('file', $id, $label);
	

	Notice: Always remember to put all labels through translation function __(); 

If you want to put many radio fields in one group (and allow user to choose only one option from this group) you should give all the radio fields the same $id. Also, if you will be using default display function you might want to give label only to the first field of the group. Otherwise label will be displayed next to each option you have given if default display function is used.

####addRule
___

To each form field you can add any number of rules. Those rules, if not satisfied, will not allow form to validate. Only one error per field will be reported, no matter how many were not satisfied. Most common set of rules are

	$form->addRule($id, $error_message, 'required');
	$form->addRule($id, $error_message, 'maxlength');
	$form->addRule($id, $error_message, 'minlength');
	$form->addRule($id, $error_message, 'email');
	$form->addRule($id, $error_message, 'numeric');
	$form->addRule($id, $error_message, 'regex', $regex);

Rules names are self-explanatory.

	Notice: Always remember to put all error messages through __() translation function, 

####add submit buttons
___

Default display function places each field in separate line. If you wish to place buttons OK and Cancel it's better to place them in one line. Simplest way to achieve this is to place those buttons in a group:

	$submit = HTML_QuickForm::createElement('submit','submit_button',$this->lang->ht('Create'));
	$cancel = HTML_QuickForm::createElement('button','cancel_button',$this->lang->ht('Cancel'), $place_href_here);
	$form -> addGroup(array($submit,$cancel));

####validation
___

Now you should validate the form and if it success extract values and process the form:

	if ($form->validate()) {
		$values = $form->exportValues();
		...
	}

Function validate() returns true only if no error occurred and the form was submitted. To access a value of a certain field you can now simply retrieve variable $values[$id] where $id is the id you have given to the field.

	Notice: Be aware that if form with an unchecked checkbox field is submitted this field will not be set to any value.
        Only if checkboxes is checked the form will receive value 1 under it's $id.

####display form
___

You are now ready to display the QuickForm. Keep in mind you have to **call display function after validating the form**. This is because QuickForm generates error messages during the validation and it must be done before displaying anything. To display the form you can use

	$form->display();

Instead of direct displaying you can render form to variable

	$form->toHtml();

This is really helpful when using Themes.

Please note that displaying form is not necessary to retrieve the values. So if $form->validate() returns true you can simply process the form and skip form displaying.