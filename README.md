## Flexpedia Invoice System
## Table of contents
* [Features](#features)
* [Technologies and Tools](#technologies-and-tools)
* [Running the Project](#running-the-project)


## Features
* List the invoices from the database table into an HTML paginated table, having 5 records per page.
* Export the transactions as a CSV file. 
* Export a CSV customer report.
* Changes payment status of each invoice via the interface to paid / unpaid.

## Technologies and Tools
Project is created with:
* PHP         :7.4.11
* HTML5      
* Bootstrap   :4.3.1
* jquery.js   :3.5.1
* Css
* Mysql
* Visual Code(Editor)
* Xampp
	
## Running the Project
The project is build via PHP and you do not need to install it ,it needs XAMPP so please download it if you do not have a server to run php.

When you install the XAMPP software, it creates the htdocs directory, which is the document root of your default web server domain: localhost.
Clone the project or download it as a zip and extract inside the htdocs folder of the xampp installation. 

In that case you should have the following path:

`` xampp/htdocs/report_system``

The database of the application is stored in:

``xampp/htdocs/report_system/database.sql``

Create a database via mysql and import database.sql file.

The database configuration file is stored in:

``xampp/htdocs/report_system/config``

You can change your serverName,userName,database and password refering to your data.

To run the application open xampp start apache and phpmyadmin and follow the link to browser:

``http://localhost/report_system/index.php``

## Thank you!
