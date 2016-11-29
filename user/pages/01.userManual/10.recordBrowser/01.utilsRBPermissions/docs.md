---
title: Permissions
taxonomy:
    category: docs
---

####Utils/RecordBrowser/Permissions
___

Permissions Editor for Record Browser is a powerful tool allowing system administrators to adjust the access levels and permissions for all users in the system.

####Basic Concept
___

The first premise Record Browser permissions are based on is that the user alone has no access to any data in the system. The access can be granted by adding special **Rules**. Each Record Set has completely separate set of Rules and it is usually installed with some default Rules, allowing users to interact with the system right after installation. As an administrator, you can add, edit and delete rules as you see fit.

The second permise is that each user has a **Clearance** that determine which Rules are applied when the user is interacting with the system. Each user usually has several Clearances assigned, based on their user data and Contact record. The default Clearances available are:

1. **All Users -** this clearance is granted to every active user in the system, it's used for clear Rule presentation

2. **Admin -** this clearance is granted to regular administrators, assigned on user panel

3. **Superadmin -**  this clearance is granted to super-administrators, assigned on user panel

4. **Employee -** this clearance is granted to all users whos contacts have **Employee** added in **Access** field of the contact

5. **Access: Manager -**  this clearance is granted to all users whos contacts have Manager added in Access field of the contact

You can add more access levels by extending the Contacts/Access CommonData table. All these new levels will be managed in the same way Access: Manager or Access: Employee clearance is managed. Please note that some modules may automatically extend Contacts/Access table.

Finally, it should be noted that Super-administrators automatically benefit from all Rules for each Record Set. This does not necessarily mean that they see all the data there is in the system (they can still do that by going to Record Browser section of Administration Panel), but rather that they can see the data as if they had every possible clearance level, regardless of other settings.

####Rules Summary
___

The Rules Summary screen is accessible through Menu -> Administrator -> Record Browser -> Permissions tab.

![Permissions Rules Summary](/images/permissions_rules_summary.png)

First, make sure you've selected correct Record Set, using the select element (1). After selecting the right Record Set, you can see all the rules craeted for this Record Set. Each Rule is represented by a row in the table (2). The columns are as follows:

1. **Actions -** column with buttons that allow you to edit and delete rules

2. **Access type -** what action this Rule allows to perform

3. **Clearance required -** what clearance is required from the user to apply the Rule; all clearances listed for a give Rule must be met in order to apply the Rule

4. **Applies to records -** criteria that select a subset of records that are included in the Rule

5. **Fields -** amount of fields permitted by the rule of all fields in selected Record Set; hovering over the numbers will show a tooltip listing **excluded** fields

Every time the system checks what records can be view/edited/added/deleted, it takes all Rules that are allowed taken user Clearance in consideration and use all these rules to create a summed up list of records the user has access to. If one Rule allows certain records to be accessed and another Rule allows different subset, the user will be able to see records from both groups. If two rules allow the same record to be accessed, it causes no change, making the user see the record. The same is applied to fields: if one Rule allows some fields to be accessed, while another Rule allows to access different fields, as a result the user will be able to access all fields, from both rules. As a result, if you want to block a certain field you have to make sure that all Rules that require clearance below the targeted clearance exclude this field. The Applies to records column is a crucial part of a Rule. In the display, all elements placed in the same text row are conntected with logical operand or, which means that for a record to fit the criteria, one of the items in each text row must be matched. Text rows are linked with and logical operand, which means that every text row must match for the record to be included. To sum it up: for every text row there must be at least 1 criteria that match the record for this record to be included by this rule. Simply reading the criteria will give enough explanation to know what records it includes.

####Adding/Editing Rules
___

Both adding and editing Rules takes place on the same screen:

![Permissions Add/Edit](/images/permissions_add_edit_rule.png)

There are 4 sections to be adjusted when adding/editing a Rule:

1. **Action** The action this Rule allows to perform.

2. **Clearance** Clearances needed to use the Rule. Using the button Add clearance you can additional select elements, allowing you to require more than one Clearance.

3. **Criteria required** Here you decide what records are included in the Rule. Similar to display in summary, elements in one row are conntected with or logical operand, while rows are connected with and logical operand. Using the buttons Add criteria (and/or) you can add more elements to the criteria. The location of the button indicates which row will be extended. Every element in criteria is built using 3 (in some cases 4) select elements:

	![Permissions Add/Edit Example 1](/images/permissions_add_edit_rule_img1.png)

	First select is used to specify the field the criteria will be checking. The second is operator used. The third select is a value used to compare with existing records. The values selection will differ depending on the field selected. If the selected field is of type select and it is linked to another Record Set, then possible values will include references to fields from record that is selected:

	![Permissions Add/Edit Example 2](/images/permissions_add_edit_rule_img2.png)

	If you select one of these values, a fourth select element will be added, alloing you to choose the value used to compare with the field from referenced record:

	![Permissions Add/Edit Example 3](/images/permissions_add_edit_rule_img3.png)

	On the image above, it is set that Rule will include records, where field Company Name points to Companies with Group set to Customer

4. **Fields** The final section allows you to specify what fields are included in this Rule. Simple checking/unchecking related checkbox will include/exclude the field.

####Hints
___

* Leaving a Record Set without any rules specified will cause this Record Set to be completely inaccessible for all users

* Each Access: [option] clearance may have multiple uses depending on other clearances required. For instance, having Access: Manager and Employee clearance would be equivalent of an Employee Manager, while Access: Manager alone would be representation of a Customer Manager

* One should use Add action with criterias carefully. The system simply blocks the option to add new records if the defaults do not match the criteria. Rule does not force defaults on it's own

* Certain fields may be hidden to certain users due to hardcoded functionality. Administrators can not force these fields to appear to these users

* By default, all menu entries are checking if a user is permitted to browse the data. The user has permission to browse data if there are any Rules with action View that user clearance allows. Removing View access completely for certain users will result in hiding menu entry to browse that data. The only exception to that Rule are contacts and companies - user that can see only their own records still won't be able to see menu entries

* If a user has no access to View a record, it also means that the user will be unable to perform any other action (edit/delete) on that record, regardless of other Rules

* If you want to apply the same Rule to users with completely different clearance levels, remember not to add these clearance levels to one rule, it'd mean that both clearances are required to actually apply the rule. You should rework your permissions system so that a single clearance is determinant who can access the Rule. If that is not an option, you should create two Rules that differ only by the clearance required