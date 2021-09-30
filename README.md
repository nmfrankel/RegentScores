## UPDATE | In Progress

I plan to update this project and have optimize it in the future. Expected finish date: 1/1/2022

<pre>
||\\   ||\\   //||||||||  
|| \\  || \\ // ||  
||  \\ ||  \\/  |||||  
||   \\||       ||  

	NOSSON M FRANKEL
	nossonmfrankel@gmail.com
	ALL RIGHTS RESERVED, © 2020
</pre>

# RegentScores
This is a blackboard web-app I built for my high-school to post and host our regent scores online.

## Benefits
-	The basic benefit of such a system is that parents/students can veiw their (childs') scores as soon as they become available.
-	Additionally, with such a system the facilty get harassed for scores at a significantly lower rate.

## Setup
1.	Configure your database's credentials in ``./Setup/regentScore.sql`` under ``INSERT INTO 'users'``.
2.	Host the current folder on a server and open ``./Setup/index.php`` to create the required database.
* For security purposes keep the ``setup`` folders online __ONLY__ as needed.

Default admin user credentials
Username: ``username``
Password: ``password``

## What I Exercised/Learned
-	Create and interact with a **mySQL database**.
-	Developed a **RESTful API** to communicate between the front-end and back-end.
-	**Authenticate users** to have limited-privilages for the system...
```
	Admin -> admin access
	Parent/Student -> student access
```
-	The school can **lockout a user** to block the Parent/Student from seeing their score temporarily.
