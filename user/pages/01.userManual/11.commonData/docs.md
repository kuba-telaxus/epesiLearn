---
title: CommonData
taxonomy:
    category: docs
---

####Utils/CommonData
___

**Common Data** is a tree-like structure to store all lists (like in select field and chained select) in a single place.

This tree is used in many EPESI modules to store values like:

* Countries

* Access level

* Record status

* Record permission

etc.

####Overview
___

The idea of CommonData is to create a customized array and save it for later use in a recordset. First create a new CommonData array in Menu -> Administrator -> CommonData and click **New array**.

![Common Data Add Array](/images/commonData_1.png)

As every associative array we have a **key** that holds a **value** or is assigned to an array as CommonData type supports **chain select functionality**. Name your key (which in this case will also be the name of your array) in a way that represents its purpose i.e. "books" and save it.

![Common Data Edit Node](/images/commonData_2.png)

Now to add certain positions to your array click on the **view** button next to it.

![Common Data View](/images/commonData_3.png)

Click on add array. Type the title into the **value** input and set the key to a unique value.

![Common Data Array Node](/images/commonData_4.png)

After you have added a couple of books you should now have a list.

![Common Data Array List](/images/commonData_5.png)

In order to use this array in a specific recordset you must add a new field to it in Menu -> Administrator -> Record Browser. Choose the recordset you want to add the field to from the recordset drop down list at the top. Click **New field** In the **Manage Fields** tab .

![Common Data Manage Fields](/images/commonDataManageFields.png)

Choose **Select field** for the **Data Type**.

![Common Data Data Type](/images/commonDataDataType.png)

Now you should see a new field appear called **Source of Data**. Choose CommonData.

![Common Data Source](/images/commonDataSource.png)

Type "books" in **CommonData table** field so you can use it as your source.

![Common Data Books](/images/commonDataBooks.png)

After you have filled in all the necessary fields click save. Open your recordset and you should see a select field named "books" with the values from CommonData.

![Common Data Books Value Saved](/images/commonDataBooksView.png)

####Tips
___

Do not delete any default CommonData tables and do not change their keys nor values if you are not sure about where they are used. To be 100% sure you would need to inspect the module's code and also make sure that the value to be deleted has not been assigned to any record yet and/or used by any other module. In any case it is generally safer to change the value (description) but not the key itself (the key is stored in the other table and may have been hard coded so if you remove it the module may simply crash). For example /Premium_Project_Status uses the following keys/values:

		0 - Planned
		1 - Approved
		2 - Canceled
		...etc.

You could change the value "Planned" to something else and it will probably work. But EPESI was designed to allow translation of any string into any other language/string. Use Admin/Language & Translation tool to translate the required string. Your custom translation will overwrite the default string. For example you can translate/rename a sting "Contacts" to "Clients" or "Customers". This applies to CommonData values/strings as well. You can simply rename existing "predefined" keys to whatever you want.

Note that a CommonData tree branch can be shared among multiple modules and some values may be hard-coded. Removing an array or renaming it will crash those modules.

Making any changes directly in the database from Admin Panel is recommended only for experienced users. A backup of the database prior to making such changes is necessary.

