---
title: Phone Calls
taxonomy:
    category: docs
---

The purpose of the Phone Call module is similar to **"While You Were Out"** (see below) form used in offices in USA. Of course you had to come to the office to pick it up, and was filled out generally by a receptionist or secretary receiving the call. The deficiencies of this outdated paper solution are obvious - no permanent record in the history of a contact, can not pick it up from home, had to enter Company and Contact name and phone number every time etc. It is also so much more professional when an old customer, calling your office hears: "Mr. Smith - should John call you back at your office or cell phone number? Office - great, let me verify: it is 610-123-4556..." etc. This is also a great time to update his/her record if it changed.


![While You Were Out](/images/while-you-were-out.jpg)

####Overview
___

The version in epesi is an automated version - when you select a Company it shows only Contacts for this company, once you select a contact it shows only phone numbers on file (using chained-select), and so on. Also - you can create a phone call reminder for yourself and set a date and time in the future. How do you decide to use this module is up to you. We modified it for one customer where there is an additional select box and you can link it to a project.

The defaults are: employee=you (assuming that you create the reminder to call someone for yourself), date and time defaults to now. However you can create a Phone Call records for someone (another employee or employees). It has a status - open, in progress, closed. When switching from "In Progress" status it allows you to choose a follow-up action, enter a note. You can attach notes, files etc.

Did you create a Phone Call record for someone? Please remember about filter settings - CRM Filter - when you login to epesi you work with records (Tasks, Phone Calls, Calendar) that are assigned to you. Everything is assigned to someone (employees). Check the filter to All employees and see if it is there. Also make sure that you view All records (not recent or favorites - phone calls have only All or Recent).

If a client/customer calls requesting a phone call from an employee of the organization you need to specify who will be calling back (one or more people can be assigned this task). Another approach is to create a Phone Call NOT assigned to ANYONE (like our module Tickets - ticket created with no Employee assigned will show in the list of ALL employees and they can claim it), however this is impractical and not recommended.

To check if record was created go to Administrator -> Record Browser and at the top from the Recordset select menu select Phone Call and in the Manage Records view. All records will be shown there, including the one that were deleted. You have a filter: all, active, deactivated (deleted).

![Phone Calls Module](/images/phone-calls-module.png)