---
title: Create/Delete User
taxonomy:
    category: docs
---

####Administrator Panel
___
Please note, that a user is a CRM Contact that has also login rights. Therefore first you should create a contact record and then assign proper security level etc.

1. using Administrator's panel, or

2. directly from CRM contacts module editing login info for the contact.

#####Method 1

Go to **Administrator panel** in Menu

![Adminstrator Panel](/images/5a_admin_menu.jpg)

You will see all the settings options

![Admin All Settings](/images/admin_all.jpg)

Then find section **User Management** and go to **Manage users**

![Create User](/images/create_user.jpg)

Here you can **add new user** (or select existing one)

![Add New User](/images/add_new_user.png)

#####Method 2

The user will also display as a Contact under Company that belongs to. You can create company name or select from existing ones. You can also choose the group: Customer/Developer/Field Staff/Office Staff that new user will be assigned to.

![Contacts](/images/contacts.jpg)

After saving changes you will be asked to fill Login Panel section. There you can choose user **Login** and **Password** (that can be changed by the user after) and decide the role for him between regular user/Administrator/Superadministrator.

![Login Panel A](/images/login_panel_a.jpg)

**Important:** by default you should leave the password field blank. This way a password will be randomly generated and a welcome e-mail will be sent to the user with a link to the application, login and password.

Make sure that you correctly configured e-mail server and tested it. Also - a contact must have a valid e-mail address to receive the login information.

New users should immediately change the password.

####Cloning
___

After you have created your first contact you might want to use it as a template. To do so go into view of a contact from your Contacts list and click *clone*.

![Clone](/images/clone.png)

Now you have an exact clone of that particular contact with all the values from every field the same. Now just change the fields you need and your ready to go.

####Company Employee
___

The same goes for creating templates for company employees. Go into view mode of your company and in the _Contacts_ (.1) tab click *Add new* (.2). Therefor you will create a new contact that will automatically be assigned to your company.

![Company Clone](/images/company_clone.png)

