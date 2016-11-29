---
title: Contact & Company Import
taxonomy:
    category: docs
---

**Contact & Company Import** is a new module available in the EPESI store as a free Premium module. This module allows you to import companies and contacts. Only CSV and Excel format files are accepted (Does not work with Excel 2007 and later). After installing it it is available through Menu->Import.

[![Data Import Tutorial](http://img.youtube.com/vi/MXzxWy9mzwM/0.jpg)](https://www.youtube.com/watch?v=MXzxWy9mzwM&feature=youtu.be)


####Overview
___

Here we have a step by step preperation for importing.

  1. Prepare data file to be imported into EPESI. Import module accepts Excel or CSV file format. Therefore from the application (database) you are using export data in one of those formats. Note: EPESI uses PHPExcel library which does not work with files created with Excel 2007 and later.

  2. To import Companies and Contacts linked to those companies you need to import Companies first. Using an application that can read and format and sort CSV or Excel files (MS Excel, OpenOffice etc.), prepare the file for import. Take the exported file and make a copy of it. The first row has to have column names which are field definitions. Cleanup all unnecessary columns (fields) and rename columns to something short, like Company, Address1, WorkPhone (Work Phone), etc. Try to avoid spaces - use underline or camel case notation. Instead of "Work Phone" use "WorkPhone" or "Work_Phone"

  3. Sort all data by Company Name. Remove all duplicates of companies - each one has to be unique. The Company Name will be used as a foreign key to link with Contacts that will be imported later. It is critically important that those names will match. Save it to a file called companies.xls (or companies.csv).

  4. The same way as you prepared an import file to import Companies (step 2), create a copy from the original file and call it Contacts (xls or csv). This time you may have several records (rows) with the same company name if there are more than one contact linked to the same company. As in step 2 - the first row has to contain field definitions. Remove all unnecessary columns and rename them to something simple like Last (for Last Name), First (for First Name), etc.

  5. Open Import module. Here you need to define field mapping for Companies. For example column ZIP (US postal code) in your file is called in epesi Postal Code, therefore you will specify something like this: ZIP - Postal Code

NOTE: remember to backup your database in case something goes wrong !

####Companies
___

To import a company into EPESI the first thing you have to do is create a CSV or Excel file. I will be using LibreOffice Calc for this. The required fields in every company are the comapnies name but it is a good practice to add some extra data to the company.

![Import 3](/images/import3.png)

Now i will save this file as i.e. Import.csv and head the import module.

In the companies tab click the Please define column mapping button as shown below.

![Import 2](/images/import2.png)

After you have done so replace column names with fields that match your export file columns, leave empty to ignore it.

This is how I filled my fields:

![Import 4](/images/import4.png)

Save the mapping by clicking the Save button in the upper menu. Import your file by clicking Browse in the specify file field and click upload.

![Import 5](/images/import5.png)

The import should succeed.

![Import 6](/images/import6.png)

Go to your Companies module (Menu->CRM->Companies). The company you inported should be listed in the RecordBrowser.

![Import 7](/images/import7.png)

####Contacts
___

Do the same for Contacts. Save field mapping - it is stored in user's settings (per user, not globally).

Import Companies first. Go to Companies module and inspect data. If something did not work as expected restore the database from the backup. Unfortunately sometimes it is a trial and error kind of work.

If data imported for Companies looks good reopen Import module and proceed with importing Contacts. During import contact's company field is automatically linked by name to a company record that was created in epesiBIM during import of Companies.

Below is the sample mapping for Excel file :

![Import](/images/import.png)

####Additional
___

This is a simple, generic import tool. We wrote several custom import modules that take data from custom MS Access databases, Act! program, etc. - and import this data with notes, edit history, file attachments etc. A lot can be done beyond the simple import, however this is a subject too complex to cover here.

To import multiple groups per company simply separate them with a comma (or semicolon). The format should be like this then:

        "Company Name", "Address 1","first group,second group"

or if not escaping with "

        Company Name,Adres 1,"First Group,Second Group"

Please note how quotation marks are placed in both cases.

You do not need to edit Company groups in Common Data tree - groups will be created automatically during import.

