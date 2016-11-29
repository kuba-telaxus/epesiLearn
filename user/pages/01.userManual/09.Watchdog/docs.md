---
title: Watchdog
taxonomy:
    category: docs
---

**Watchdog** is a module that informs you about changes made by other users to records that you observe.

####Watch
___


To start observing a module you must enter the module, for instance navigate to _Menu->Module->HelloWorld_ from the Hello World tutorial and click the watch button (1.) or if you only want to watch changes made to certain records click the watchdog icon (2.). To stop watching click the **Stop Watching** button.

![Watchdog Watch](/images/watchdog_watch.png)

Now to enable the module in the watchdogs applet view navigate to _Menu->My settings->Control panel_ and click **Watchdog**. The watchdog configuration screen should show up. Change the select field value to _Enable_.

![Watchdog Enable](/images/watchdog_enable.png)

####Watchdog Notification
___

After you add a record to HelloWorld recordset you can assign employees to watch that record.

![Watchdog Employee](/images/watchdog_employee.png)

Make sure your employee also has your module set to _enabled_ in watchdog configuration panel like above. When you assign an employee to a record they will be notified by the watchdog.

![Watchdog Notify](/images/watchdog_notified.png)

Now after the employee makes a change to the record you will also be notified about it.

![Watchdog Notify2](/images/watchdog_notified2.png)

####Watchdog Toolbar
___

![Watchdog Panel](/images/watchdog_panel.png)

	1. Starting from the left we have the **view icon** which allows us to view the whole record.
	2. Second we have the **watchdog icon** which allows you to unwatch changes made to the record (you can start watching it again in the module).
	3. Third we have the **mark as read** button which allows you to mark the record as read hence it will be taken of the watchdog list. You will still be notified if new changes are made to the record.
	4. Last is the **information icon** which when hovered over displays a pop up of the old value and the new value of a the specified field.

####Watchdog Configuration
___

Since every applet has a **Watchdog** configuration screen, you can check a recordset if you want to watch it or uncheck if you don't.

![Watchdog Config](/images/watchdog_config.png)
