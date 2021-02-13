# Matcha
This aim of the Matcha project is to build on the foundations we learnt while building Camagru.

Matcha is a small web application that works much like tinder, allowing you to find people around you based on certain preferences like age, gender and geo location.

# The Requirements

The requirements for the project are:
    HTML, CSS
    PHP
    MAMP/XAMPP
    MySQL
    JavaScript

# Initialize

To begin:
Download project source code from repository: Use Git to clone repository to desktop.

Download MAMP/XAMPP from the Bitnami page. Once downloaded, install software. Begin servers in the app interface if servers aren't running. Copy cloned Camagru repository to the apache2\htdocs folder, which is located in the installation path of MAMP/XAMPP.

Open browser and go to URL http://localhost/Matcha The website should be up and running.

To check that the site is running well, navigate to phpMyAdmin folder http://localhost/phpmyadmin. Once logged into the management system, go to databases and verify the creation of a Camagru database. File Structure & Code Breakdown

Database Management Systems (DBMS):

MySQL
phpMyAdmin

Server:
PHP

Client:

HTML & CSS
JavaScript

File Structure:

	config:
		* database.php
		* setup.php
	
    css:
        * main.css
        * search.css
        * slider.css

	includes:
		* activate.inc.php
		* image_upload.inc.php
		* login.inc.php
		* logout.inc.php
		* Reset-pwd.inc.php
		* SendReset-pwd.inc.php
		* signup.inc.php


	root folder files:
		* author
		* advance_process.php
		* advanced_search.php
		* browserProfile.php
		* Create-new-pwd.php
		* data.php
		* displayProfile.php
		* footer.php
		* header.php
		* home.php
		* index.css
		* json.js
		* like.php
        * Profile_upload.php
        * PublicProfile.php
        * README.md
        * resetpassword.php
        * savecam.php
        * SaveCameraImage.php
        * search.php
        * search.processing.php
        * signup.php
        * style.css
        * tester.php
        * testupdate.php
        * update.php
        * uploadbrowser.php

# Running Matcha

Check for:

PDO configuration in config/database.php
Check for presence of index.php

Start Web Server:

Launch MAMP/XAMPP, start all servers.
Open browser & navigate to http://localhost/Matcha. You will find the landing page.

Create, verify and login to account:

Enter your credentials here, wait for verification email once complete. Once received verification email, click on the link and verify your account. Once verified, navigate to Login page.

Login, upload profile image & edit profile:

Once logged in, you must upload a profile image and then update profile.

Once a profile is updated - you are then free to explore.

Exploring:

You are able to view other users based on distance and other preferences. You are free to browse other users and match or unmatch with them.

Change user credentials:

In the profile menu, users are able to modify their name, email address and passwords.
Compatibility:

App is compatible with Firefox & Chrome.
Administration:

Admin users can access the backend of the site by visiting http://localhost/phpmyadmin. There, users can enter the security credentials to gain access to the databases. Users are able to view all the databases, and in the Matcha database users will be able to see all active accounts on the site. The password is encrypted for security.