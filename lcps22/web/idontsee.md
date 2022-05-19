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
Running strings on the image reveals the flag. We can run it with the `-n` flag to say we only want strings above 8 characters. (This is a pretty safe assumption as the "CTF{}" format is 5 characters, and we can always remove our threshold.)

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