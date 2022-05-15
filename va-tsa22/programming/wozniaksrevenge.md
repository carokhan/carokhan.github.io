# Wozniak's Revenge (100)
#### programming - Virginia TSA Technosphere 2022 CTF

## Challenge description:
> Steve Wozniak needs an all-purpose symbolic programming language for his new computer and, for practice, has hidden a flag in his chosen programming language. Can you find the flag?
> 
> Download file: [wozniaksrevenge.bas](../assets/wozniaksrevenge.bas)

## Solution 
We are given a .bas file. I initially thought it was a typical BASIC file, however running it as if it were one was unsuccessful. I then searched for ".bas file apple", revealing the file contained Applesoft Basic code. I found an [interpreter](https://www.calormen.com/jsbasic/) online and ran the code, returning the flag. 

<details> 
    <summary>Flag</summary>
flag{applesoft}
</details>