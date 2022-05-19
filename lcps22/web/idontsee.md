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
```
$ strings apictureisworth1kwords.jpg -n 8
bFBMD0a000a88010000041400002b270000e7290000c92b0000423e0000ac730000ea790000997c0000c77e00000df70000
((((((((((((((((((((((((((((((((((((((((((((((((((    
dhKc0w9JH1ZFIb-xzcC_
*******************
Photoshop 3.0
E%G3.JMlncT)
eE;`w=z&k
]Q]qcdHs.wEM
`'I=cEW87K
`v.0gg4u^T
~J,nwu't`X
-0-(0%()(
f^/ske>`H
mwW{ZIkI> 
```

<details> 
    <summary>Flag</summary>
CTF{LouisLeads2022}
</details>