# vending machine
#### algo - [HSCTF 2022](../main.md)

## Challenge description:
> buy some stuff nc vending-machine.hsctf.com 1337
>
> Download file: [Vending_Machine.pdf](../assets/Vending_Machine.pdf)

## Solution 
As described in the PDF, we can use the Display command to get a list of items and coins to buy them with.

For example:
```
Items:
1: 35289
2: 52515
3: 44929
4: 53084
5: 70619


Coins:
1: 19128
2: 16897
3: 6270
4: 19730
5: 10993
6: 17374
7: 17098
8: 12443
9: 16057
10: 10926
11: 17140
12: 8508
13: 16911
14: 7096
15: 12019
16: 15149
17: 8943
18: 16957
19: 9411
```
The gimmick seems to be to buy all the items, keeping in mind that the vending machine does not give back change. I scripted my solve script in Python.
```py
from itertools import chain, combinations

# multi-line input for entering the items
print("Items? CTRL-D to save")
items = []
while True:
    try:
        line = input()
    except EOFError:
        break
    items.append(line)
items = [int(x.split(":")[-1].strip()) for x in items] # splits the supplied item string into a list

print("\n")

# multi-line input for entering the coins
print("Coins? CTRL-D to save")
coins = []
while True:
    try:
        line = input()
    except EOFError:
        break
    coins.append(line)
coins = [int(x.split(":")[-1].strip()) for x in coins] # splits the supplied coin string into a list

def sublists(arr):
    """
    Generates all possible sublists of any size from a list.
    For example: [1, 2, 3] [[1], [2], [3], [1, 2], [2, 3], [1, 2, 3]]
    """
    return list(chain.from_iterable(combinations(arr, r) for r in range(1, len(arr)+1))) 


def solve(item, coinCombos):
    """
    Takes in a list of sublists of coins and returns the one which, when totaled, 'wastes' the least amount of money/uses the least change for a given item.
    """
	diffs = {coin - item: coinCombos[coin] for coin in coinCombos.keys() if coin - item >= 0}
	return diffs[min(diffs.keys())]

def simulate(coins, items):
	print("[!] Solving with coins: " + str(coins))
	print("[!] Solving with items: " + str(items))
	print("\n")
	itemsLeft = items[:]
	for item in items:
		coinCombos = {sum(sublist): sublist for sublist in sublists(coins)} # Generates all possible collections of coins and assigns them to their sum
		used = solve(item, coinCombos) # See solve function
		print("[!] Item '" + str(item) + "' solved with '" + str(used) + "'. Difference of: " + str(sum(used) - item)) # Outputs the 'solved' combination for each item
		for coin in used:
			coins.remove(coin) # Removes used coins
		itemsLeft.remove(item) # Removes solved items
	print("\n")
	print("[!] Coins left: " + str(coins))
	print("[!] Items left: " + str(itemsLeft))
	return coins, itemsLeft

coinsLeft, itemsLeft = simulate(coins, items)
```

This returned:
```
Items? CTRL-D to save
1: 35289
2: 52515
3: 44929
4: 53084
5: 70619


Coins? CTRL-D to save
1: 19128
2: 16897
3: 6270
4: 19730
5: 10993
6: 17374
7: 17098
8: 12443
9: 16057
10: 10926
11: 17140
12: 8508
13: 16911
14: 7096
15: 12019
16: 15149
17: 8943
18: 16957
19: 9411
[!] Solving with coins: [19128, 16897, 6270, 19730, 10993, 17374, 17098, 12443, 16057, 10926, 17140, 8508, 16911, 7096, 12019, 15149, 8943, 16957, 9411]
[!] Solving with items: [35289, 52515, 44929, 53084, 70619]


[!] Item '35289' solved with '(17374, 8508, 9411)'. Difference of: 4
[!] Item '52515' solved with '(16897, 6270, 12443, 16911)'. Difference of: 6
[!] Item '44929' solved with '(17098, 10926, 16957)'. Difference of: 52
[!] Item '53084' solved with '(10993, 16057, 17140, 8943)'. Difference of: 49
[!] Item '70619' solved with '(19128, 19730, 7096, 12019, 15149)'. Difference of: 2503


[!] Coins left: []
[!] Items left: []
```

Upon entering these into the vending machine and buying all the items, the flag was printed out :)
<details> 
    <summary>Flag</summary>
flag{b40m1k3_15_4_f4rm3r_663471478}</details>