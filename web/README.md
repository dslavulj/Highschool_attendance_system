Login page
<br>
The login page has a form that requires the user to enter username and password.
The layout is very simple. One box in the middle of the page containing the "Login" heading. Below that is a username and password fields.
At the bottom of that box is a login button.
If the username is not in the database, or the password is incorrect, the user will not successfully login, and will receive a specific error.
If the information is correct, the system recognizes whether it is a student or a teacher and sends it to the main page.


Student

The student can view attendance only for themselves.
At the top left is "Welcome" and the student's name. On the same level to the right is the "Logout" button.
By clicking on it, the user is no longer able to access the data without logging in again. Also, by clicking the logout button, the user returns to the login page.
The first field in the filter contains a drop-down menu that selects between arrivals and absence. The default is a absence because they are more important.
Next, there is a drop-down menu where the student can select all the subjects or one specific one.
After that there are 2 boxes for entering the date. One is for the start date, the other for the end date. The default gives us an insight into the past 14 days.
If we are interested in all arrivals / absence, we will remove the date "from" by pressing the "X" at the date.
To the right of the filter section is a "Filter" button, which when clicked, will display the filtered information.
Below the filter is a table that lists arrivals or absence, depending on the selection.
The table contains 4 columns: date, school hour, subject and classroom. The data is sorted so that the most recent date is at the top.


Teacher

The teacher can view the arrivals and absence for the subject he/she is teaching or the class where he/she is head teacher, and add and delete the arrivals.
At the top left is "Welcome" and the teacher's name. On the same level to the right is the "Logout" button.
By clicking on it, the user is no longer able to access the data without logging in again. Also, by clicking the logout button, the user returns to the login page.
The first field in the filter contains a drop-down menu to choose between arrivals and absence.
After that there is a choice for the subject or class.
In addition there is a class selection (if browsing for your subject) or a subject selection (if browsing for your class).
Next is student selection.
After that there are 2 boxes for entering the date. One is for the start date, the other for the end date. The default gives us an insight into the past 14 days.
If we are interested in all arrivals / absence, we will remove the date "from" by pressing the "X" at the date.
To the right in the filter section there is a "Filter" button, which when clicked, will display the data that we have selected in the filter.
Below the filter is a table consisting of 6 columns: date, student, school hour, subject, classroom and action.
The first line contains blank fields that serve to add a new arrival. In order to enter the data it is necessary to fill in the fields and press the button to confirm.
After that, the user is taken to a page where they are notified whether or not a new arrival has been added.
It is not possible to create a new arrival for a non-teaching date, nor in the future and it is not possible to add an arrival for a non-existent student or a non-existent subject.
The data is sorted by date so that the most recent date is the highest in the table.
In the table in the action column, for each arrival, there is a icon of the trash bin, which is used to delte the arrival.
