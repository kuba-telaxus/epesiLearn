---
title: E-mail Management
taxonomy:
    category: docs
---

EPESI has an integrated [Roundcube](https://roundcube.net/) webmail IMAP client, a browser-based multilingual e-mail client with an application-like user interface. It provides full functionality you expect from an e-mail client, including MIME support, address book, folder manipulation, message searching and spell checking.

![Create](/images/create.jpg)
![Destroy](/images/destroy.jpg)

####Manage E-mail Attachments
___

Manage E-mail Attachments is a module that allows to attach e-mails to any kind of record, for example under a task or phonecall. By default e-mails archived from embedded Roundcube Mail Client can be attached only under Contact or Company record types. This module extends the possibilities by far.

E-mails attached to a contact - **threaded view**

![Manage Emails](/images/emails_manage.png)
![Manage Emails2](/images/emails_manage_2.png)

View of the e-mail

![Manage Emails3](/images/emails_manage_3.png)

####Archiving System
___

When e-mail comes to an individual mailbox of the user (Roundcube client) it is not connected in any way to any records in epesi. You can delete it, forward, reply to it - the way you normally do in any mail client. If the e-mail message is to be kept in the history of the particular contact in epesi (Contact or Company) then you need to archive it:

![Email Archive](/images/e-mail_archive.png)

What happens in the background:
	* e-mail message is extracted from the mailbox and stored in epesi as on object (text message is stored in the database with links to atachments stored as files)
	* e-mail message is moved to Epesi Archive folder (in case you want to do something with it in any IMAP e-mail client)
	* e-mail addresses: From, To, CC - are scanned against CRM Contacts in CRM Companies in epesi and links to all matching e-mails/contacts are created for this archives e-mail

Please note that this is a true single instance of the e-mail object - the e-mail message is stored as an independent object with reference links created under all Contacts/Companies for which e-mail match is found.

When sending e-mail from within epesi - Roundcube IMAP client - you can toggle (by clicking on the Archive icon) if the sent message is to be archived the same way or not (simple send). We decided to separate Epesi Archive and Epesi Archive Sent to make it easy for the user to see what was received and what was sent.

######Existing Contact

When archiving an email sent by a contact signed into epesi Contacts the email will automatically be assigned to that contact. After clicking the archive icon epesi will notify you that the email has benn successfully archived and that the message has been moved.

![Archive](/images/archive.png)
![Archive2](/images/archive2.png)

######Non-Existent Contact

If you recieve an email from a non-existent contact the email will fail to archive at first click.

![Archive3](/images/archive3.png)

However, you can force the email to archive anyway although it will not be assigned to any contact other than yours or other matching contacts. Simply click the archive icon once again and it will succeed. This is not recommended.

The recommended solution is to open another window with EPESI, switch to contacts and add new contact with the e-mail address of the sender.

####Paste Mail
__

After an email has been archived you can past it under any record in any module. Do so by clicking the Paste mail icon(.1). It wil appear when in the E-mails tab(.2).

![Paste](/images/paste.png)

A dialog box will pop up asking you once again if you want to paste the emai. Click Paste.

![Paste2](/images/paste2.png)

**The "Paste mail" will paste only the last one archived e-mail by default.**

If you want to paste or link older messages first find it and then click on "copy" icon to place it memory buffer. Then switch to a record under which you want to paste the e-mail, switch to e-mail tab and use "Paste mail" icon.

![Email Linking](/images/e-mail-linking.png)
