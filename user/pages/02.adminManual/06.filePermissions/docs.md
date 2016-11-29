---
title: File Permissions
taxonomy:
    category: docs
---

File permissions are very HTTP server specific, but general guide is:

   1. EPESI directory tree (all files and dirs) has to be readable by HTTP server user.

   2. **/data** directory tree has to be writable by HTTP server user.

   3. Additionally **/modules** directory has to be writable by HTTP server user, when you're going to use EPESI Store.

But to simplify maintenance it's recommended to set EPESI directory tree both - readable and writable by HTTP server user.

####Linux Example
___

Examples below are not universal solutions for every situation and server. You have to know limitations of your server and decide what permissions are acceptable when privacy matters.

**Configuration**

   1. **/var/www/epesi** - EPESI installation directory

   2. **apache-user** - HTTP server user

   3. **apache-group** - HTTP server group

   4. **johny** - your user

   5. **root** - root user

**HTTP server access only**

Basic permissions - readable and writable by only HTTP server user or group. Johny will not be able to read files.

	johny@localhost:/> su

   	root password: ***

	root@localhost:/> chown -R apache-user:apache-group /var/www/epesi

	root@localhost:/> chmod -R a=,ug+rwX /var/www/epesi

**Note:** Some apache extensions doesn't allow to run scripts that are writable by group. In such case set writable by user only

	root@localhost:/> chmod -R a=,ug+rX,u+w /var/www/epesi

**Development Permissions**

Johny is a developer and wants to have access to files. Also we don't care about read permission and allow everyone to read files (Everyone can read your attachments!)

	johny@localhost:/> su
	
	root password: ***
	
	root@localhost:/> chown -R johny:apache-group /var/www/epesi
	
	root@localhost:/> chmod -R a=,a+rX,ug+w /var/www/epesi