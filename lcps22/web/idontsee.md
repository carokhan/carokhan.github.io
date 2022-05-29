# I don’t see how you can ever finish, if you don't begin (100)
#### web - [Louisa County High School](../main.md)

## Challenge description:
> Please visit the following site
> 
> This one is simple. All you need to do is login with the correct username and the flag will be shown.
>
> Users: admin, bob, suresh, ramesh, alice, voldemort, frodo, hodor, rhombus
>
> http://ctf-id-2.lcps.k12.va.us/login.php
>
> Download file: [idontseehow.php](../assets/idontseehow.php)

## Solution 
While there is the intended solution of trying different SQL injection payloads, during the CTF I took a different approach. On my initial scan, I noticed something interesting on lines 18-20 and 92.
```php
<p class="lead" style="color:white">
				Simple Login Page with SQL Injection
			</p>

		<p>Riyaz Walikar | @riyazwalikar</p>
```
I searched "Riyaz Walikar SQL injection" and found [this Github repo](https://github.com/riyazwalikar/sql-injection-training-app).

Looking in the README, we see that using `admin' -- // ` as a payload should work.

Trying this is successful, and we get this message:
> All hail the admin!!
> Nice Try. Great job, getting this far.
> 
> Checkout the hint below
> Don't go down the rabbit hole.

Looking at the list of users, Alice of Alice in Wonderland fame is most commonly associated with rabbit holes.

Logging and changing our payload to `alice' -- // ` returns:
> In wonderland right now :O
> 
> Collect Your Flag:
> \********************

<details> 
    <summary>Flag</summary>
ctf{Catj'7[v@pKzPG*}
</details>