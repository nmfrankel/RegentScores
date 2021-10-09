## UPDATE In Progress

I plan to update this project and optimize it in the future. **Expected finish date: 1/1/2022**
-	The web-app is currently loading static files on the backend
  
    
  
  
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

<!-- ## Project backstory

**coming soon** -->

## Benefits

The obvious benefit of such a system is that parents/students can veiw their (childs') scores as soon as they become available. Additionally, with such a system the facilty get harassed for scores at a significantly lower rate.

## Files Layout Overview

The `/fronend` directory contains all the files run on the browser, i.e. `.html`, `.css`, `.js` and `.png` are some examples.  
The `/api` directory contains all the files to run the web-app normally on [a setup](#getting-started) server.  
The `/static` directory contains a snapshot of a server for use without setting up a database. The `/static` directory is used when accessed from `http://127.0.0.1/`, __not__ `http://localhost/`.

## Getting Started

**Full details and walk thorugh coming soon**
<!-- 
## Cool Feature Ideas

- Exmples coming soon -->

## What I Exercised/Learned

-	Create and interact with a **SQL database**.
-	Developed a **REST API** to communicate between the front and backend.
-	**Authenticate users** to have limited-privilages for the system...
	>	Admin -> admin access to insert scores and block users
	>	Parent/Student -> student access with the ability to view their scores
-	The admin can **lockout a user** to block the Parent/Student from seeing their score until they contact the school.

<!-- ## Resources
https://dribbble.com/shots/4034991-New-Exciting-Project-Splash-Screen -->