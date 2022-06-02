# Wordle - 359
#### web - [BYUCTF](../main.md)

## Challenge description:
> Have you ever wanted to mix wordle with password cracking? I know I have. There are a few out there already like Crackzor and passwordle but I wanted to take things a different direction. Remember to use the share button when you finish to follow wordle tradition. Who knows? It might just give you some insight if you're stuck.
>
> If you solve the wordle, you'll get the flag. Enjoy!
> 
> http://byuctf.xyz:40003
> 
> Download file: [wordle.zip](./../assets/wordle.zip)


## Solution
Just playing through the wordle, after entering a word, you would get a hash, such as dbf1897c0991bbf7922e86de847d4df4. Looking at the source code, we can trace this to the function `getHashString` in `utils.py`.
```py
def getHashString(guess_status):
    passString = ''
    for i in guess_status:
        if i["state"] == 0:
            passString += '⬛'
        elif i["state"] == 1:
            passString += '🟨'
        elif i["state"] == 2:
            passString += '🟩'
        else:
            passString += '?'

        hashString = hashlib.md5(passString.encode('utf-8')).hexdigest()
    return hashString
```
We see the hash we get is of the string of squares representing our guess. From here, we can generate hashes of each possible guess state, and reference them to solve the Wordle.
```py
>>> import hashlib
>>> possible = ("⬛", "🟨", "🟩")
>>> states = {hashlib.md5((a + b + c + d + e).encode('utf
-8')).hexdigest(): a + b + c + d + e for a in possible fo
r b in possible for c in possible for d in possible for e
 in possible}
>>> states["dbf1897c0991bbf7922e86de847d4df4"]
'⬛⬛⬛⬛⬛'
```
<details> 
    <summary>Flag</summary>
byuctf{b@c0n_grease}</details>