# Undergraduate Advisor
The purpose of this program is to enable students and advisiors to create a future plan for student graduation.

## Guide For Use
1. [Download XAMPP](https://www.apachefriends.org/download.html)
2. Clone this repository to http directory found in the xampp directory
3. Open XAMPP Manager Click on "Manage Servers" tab
4. Click "Start All" Button
5. Update phpmyadmin password to: 'snuggle' this is done by going to your [phpmyadmin](http://localhost/phpmyadmin) and running the following code: UPDATE mysql.user SET Password=PASSWORD('password') WHERE User='root'; FLUSH PRIVILEGES;
5. Click here to [Create Database](http://localhost/ug-advisor/php/start.php)

## Database Backup
Click here to [Backup Database](http://localhost/ug-advisor/php/backup.php)

## Startup Users

### ADMIN
- snow,  password: winter
### Faculty
- prof,  password: sugar
- prof_james password: sugar1
- prof_jess password: sugar2
- prof_pam password: sugar3
### Student
- ken, password: SCSU2019
- flowers, password: spring
- bugs, password: summer
- leaf, password: tree
- john, password: smith1
- north, password: west

## Development Stack
- Apache
- mysql (note: mariaDB)
- php
- javascript
- html
- css

## Team Members
- Joshua Connor
- Josh Kenney
- Nick Santini
- Greg Rodriguez

## User Guide

### Administrator
As an administrator you have the ability to make changes to almost all aspects of the Undergraduate Advisor, the only thing out of your control is the ability to create new users. We assume that creating new users would be done via a connector to a schools system or by other means.

Once logged in you are able view potential areas that would require additions or updates. The process for making changes and updates is the same for each section, first by viewing the section. When viewing a section to add a new entry you would click the add button towards the top right of the page. Adding requires you to fill out all fields, once filling in the information needed you can add the click the "add" button to add it to the database. Editing follows a similar process, after entering the view page for specific section, you can edit individual entries by use of the "edit" button on the right side of each entry.

### Adivsors
As an advisor you are able to provide advisement to all students assigned to you. You can do this by accepting or declining students proposed schedules.

Once logged in you are brought to your home page which shows all students you are currently advising. You can see which students needs advisement by the 'take flag' When indicated by the flag you will be able to accept or decline a students proposed schedule. If you feel that further information is needed to be given to the student or would like to meet in person you also have the ability to contact the student via the mail button.

### Students
As a student you are able to build a unique graduation map in order to help you graduate on time. 

Once logged in you are presented with your home page which shows your current graduation map. The map consists of semesters or terms. To start you would select a term by clicking view term. Once viewing that term you have the ability to add courses based on the required courses for your major. After adding courses you an then click "Save Term Update" towards the bottom of the page. You are then able to review the term and if you are happy with it click "Send to Advisor" to allow them to review the proposed courses.
