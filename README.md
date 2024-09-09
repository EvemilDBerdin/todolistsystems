CRUD EXAM

Set Up the Environment
1. Install XAMPP v3.2.4 to get Apache, MySQL, and PHP running locally. (PHP Version 7.2.19)
2. Download and set up the code in the htdocs directory of XAMPP (C:\xampp\htdocs\).
3. for the database sql you can see in the db FOLDER path => todolist\db\todolistsystem.sql
4. create a db in phpMyAdmin with the name of "todolistsystem"



IMPLEMENTATION 
- DATATABLE for PAGINATION
- Hope UI for Interface

Logout-
1. all session is destroyed and it will redirect to Login Interface

Login - use username and password
1. there is a prompt when username doesn't exist
2. there is a prompt when password doesn't exist

Registration - 
1. there is a prompt when username doesn't exist
2. you need to use proper email ex(jondue@yahoo.com)
3. after a successful registration it will redirect to login interface

Home - Todo List view
1. Logout
2. Read
3. Create
4. Update/Edit
5. Delete
6. When status is PENDING - 
-you need to click the "ACCEPT BUTTON" for it to change status into INPROGRESS
-there will also have an error if you try to click the "COMPLETED BUTTON" without clicking the "ACCEPT BTN" 
7. When status is  INPROGRESS -
-if have completed the task you need to click the "COMPLETED BUTTON" manually to change the status
-there's an error if you try to click the "ACCEPT BTN" 
8. When status is  INCOMPLETE -
when the todo-item is in due date it will automatically change the status into "INCOMPLETE". you need to do the task before the due date or else it will change automatically
9. When status is  COMPLETED -
-there will be an error if the "ACCEPT BTN" or "COMPLETED BTN" is click
