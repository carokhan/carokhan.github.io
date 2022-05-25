# Hack the code! (350)
#### reversing - [Louisa County High School](../main.md)

## Challenge description:
> Download the attached checkkey.exe. Run it on a windows computer. Your task it to reverse engineer this program to break the code. Once you break the code, enter the flag to win the game!
> 
> The flag format is CTF{key}

## Solution 
Before I ran it on Windows, I decided to run a strings command just to be safe.

```
$ strings hackthecode.exe -n 10
!This program cannot be run in DOS mode.
<ItC<Lt3<Tt#<h
<ItC<Lt3<Tt#<h
PP9E u:PPVWP
the item you seek is encrypted nearby 
596F7544696449543335305074733255
...
```
Decoding the hex returns:
```
$ echo "596F7544696449543335305074733255" | xxd -r -p
*****************%   
```

<details> 
    <summary>Flag</summary>
CTF{YouDidIT350Pts2U}
</details>