# Can you speak this language? (75)
#### general - [Louisa County High School](../main.md)

## Challenge description:
> To capture this flag, you needed to have made good grades in Kindergarten. You know, where you learned your abc's and 123's. You must decode the secret message to reveal the flag: 23-5-12-3-15-13-5 20-15 20-8-5 10-21-14-7-12-5
>
> Enter the flag as ctf{decoded message}


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