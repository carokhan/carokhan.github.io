# Knowledge is the key to success (50)
#### osint - [Louisa County High School](../main.md)

## Challenge description:
> To get this key, you must be a sleuth. You have been given the ipaddres of 19.12.97.37. To capture this flag, you must know the OrgID and the RegDate. 
>
> The flag format is CTF{OridID:YYYY-MM-DD}


## Solution 
We notice that none of the numbers in the cipher are above 26 characters. This is characteristic of the A1Z26 cipher.

While we can do this manually, we can also script it in Python.

```py
>>> cipher = "23-5-12-3-15-13-5 20-15 20-8-5 10-21-14-7-12-5"
>>> words = cipher.split(" ") 
>>> letters = [word.split("-") for word in words]
>>> final = "".join([string.ascii_lowercase[int(i)-1] for i in letters for l in i])
>>> print(final)
******************
```

<details> 
    <summary>Flag</summary>
ctf{welcometothejungle}
</details>