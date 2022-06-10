# vending machine
#### algo - [HSCTF 2022](../main.md)

## Challenge description:
> Euclidean traveling salesman over single dimension? nc travelling-salesman.hsctf.com 1337
>
> Download file: [Traveling_Salesman.pdf](../assets/Traveling_Salesman.pdf)

## Solution 
this is literally just sort numbers
```py
def solve(rooms):
    """
    Takes in a list of room numbers and formats it for submission.
    """
    rooms.sort()
    rooms = [str(room) for room in rooms]
    return " ".join(rooms)
```

```
$ nc travelling-salesman.hsctf.com 1337
== proof-of-work: disabled ==
[34, 33, 81, 58]
order: 33 34 58 81
[17, 42, 90, 94, 82, 13, 63, 89, 39, 73]
order: 13 17 39 42 63 73 82 89 90 94
[19, 44, 98, 37, 90, 71, 64, 55, 47, 60, 75, 39, 84, 40, 33, 63, 93, 85, 13, 21, 43, 42, 91, 24, 14, 45, 53, 72, 31, 20]
order: 13 14 19 20 21 24 31 33 37 39 40 42 43 44 45 47 53 55 60 63 64 71 72 75 84 85 90 91 93 98
[30, 35, 91, 16, 22, 38, 92, 41, 81, 64, 57, 87, 25, 97, 84, 86, 53, 50, 11, 24, 82, 89, 20, 61, 44, 28, 78, 77, 75, 72, 51, 29, 98, 65, 12, 93, 55, 68, 90, 85, 18, 47, 52, 54, 43, 70, 34, 94, 88, 59]
order: 11 12 16 18 20 22 24 25 28 29 30 34 35 38 41 43 44 47 50 51 52 53 54 55 57 59 61 64 65 68 70 72 75 77 78 81 82 84 85 86 87 88 89 90 91 92 93 94 97 98
[17, 64, 25, 93, 54, 45, 22, 14, 90, 65, 31, 50, 55, 87, 59, 83, 15, 61, 24, 63, 40, 23, 82, 39, 89, 88, 44, 32, 60, 91, 11, 70, 77, 38, 35, 75, 16, 66, 96, 84, 81, 67, 47, 51, 33, 42, 72, 74, 97, 69]
order: 11 14 15 16 17 22 23 24 25 31 32 33 35 38 39 40 42 44 45 47 50 51 54 55 59 60 61 63 64 65 66 67 69 70 72 74 75 77 81 82 83 84 87 88 89 90 91 93 96 97
flag{*************************************************************************************}
```
<details> 
    <summary>Flag</summary>
flag{the_fitness_gram_pacer_test_is_a_multistage_aerobic_capacity_test_8182295882010254837}</details>