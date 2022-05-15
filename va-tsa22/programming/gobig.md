# GO Big (100)
#### programming - Virginia TSA Technosphere 2022 CTF

## Challenge description:
> Ken Thompson has a new programming language he is trying to promote so he has written a program that will give you a flag when you run it. He promises this new language can be installed on Mac OS X, Linux, or Windows. Can you find the flag?
> 
> Download file: [gobig.go](../assets/gobig.go)

## Solution 
We are given a .go file. Simply running the file in go reveals the flag.

```
$ go run gobig.go        
Welcome to the CTF SuperGoDecoder .000001a
Text: fmi]iahj^e]c`W
Decoded flag: ********************
```

<details> 
    <summary>Flag</summary>
flag{golangorgohome}
</details>