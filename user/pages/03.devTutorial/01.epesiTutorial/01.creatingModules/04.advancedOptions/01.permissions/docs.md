---
title: Permissions
taxonomy:
    category: docs
---

In EPESI we have created a powerful and configurable permissions system that will allow to adjust the installation to fit nearly any demand.

Clearance
The first important concept of managing Permissions in EPESI is **Clearance**. Every user in EPESI has one, or several, Clearance assigned. Depending on Clearance available, some features of the system will be made available. The Clearance for each user is configured by the Administrator in the user Contact form, the Login Panel section. The default Clearances available are:

   * _ALL_ - All users - this clearance is granted to every active user in the system, it's used for clear Rule presentation

   * _ADMIN_ - Admin - this clearance is granted to regular administrators, assigned on Contact panel

   * _SUPERADMIN_ - Superadmin - this clearance is granted to super-administrators, assigned on Contact panel

   * _ACCESS:employee_ - Access: Employee - this clearance is granted to all users whos contacts have Employee added in Access field of the contact

   * _ACCESS:manager_ - Access: Manager - this clearance is granted to all users whos contacts have Manager added in Access field of the contact

You can add more access levels by extending the *Contacts/Access* CommonData table. All these new levels will be managed in the same way _Access: Manager_ or _Access_: Employee clearance is managed. Please note that some modules may automatically extend _Contacts/Access_ table.

To add additional Clearance level simply extend the Contacts/Access table:

	Utils_CommonDataCommon::extend_array('Contacts/Access',array('my_clearance'=>'My Clearance'));

The key should be noted as this is the value a developer will be using to set default required Clearance to newly added rules"

	ACCESS:my_clearance

####Permissions
___

Every module can create unlimited amount of new Permissions that can be later referenced to check whether given user can access part of the system. To create a new Permission, use the following code:

	Base_AclCommon::add_permission($permission_name [ , $default_rule1 [ , $default_rule2 ... ]);

Permission name should be a string that describes the features the permission unlocks. Following you can create default rule[s] that will enable users to interact with your system right after installation. Each rule should be an array with values set to selected clearances. Please note that providing more than 1 element in any rule will caused the system to check the user for all clearances written in the rule and if any of the clearances included is not passed, the rule is rejected. Providing more than 1 rule will allow checking for different type of users to access section of the system. If the user passes through any of the rules, he will have access to selected parts of the system.

To check if user has access to selected part of the system, use the following code:

	Base_AclCommon::check_permission($permission_name);

This method will return true if the access should be granted or false otherwise.

Finally, when uninstalling your module, you should remove permissions your module introduced:

	Base_AclCommon::delete_permission($permission_name);

Please note that the values for permissions and its rules should not be manipulated outside installing/uninstalling modules, since the interface provided to Administrators allows them to further adjust the permissions.

It should be also noted that permissions can be used across different modules. Make sure that the permission you are using is introduced by a module that you listed in your required modules.