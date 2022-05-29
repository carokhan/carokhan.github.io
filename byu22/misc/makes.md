# Makes - 267
#### misc - [BYUCTF](../main.md)

## Challenge description:
> Uhoh! I was learning how to make makefiles, and somehow I made all of my targets messed up... Which target will print the pattern 1111111l11lll1ll11l11111111l when called?
> 
> Flag format - byuctf{target_name} (ie byuctf{8585bc2f9})
> 
> Download file: [Makefile](../assets/Makefile)

## Solution
Not knowing how Makefiles worked, I learned they take different targets as arguments, each following a different path and executing different instructions in the Makefile. I then googled [how to get a list of all targets in a Makefile](https://unix.stackexchange.com/questions/230047/how-to-list-all-targets-in-make).

From there, I scripted a solution in Python. While running it, I noticed the script would get stuck on certain targets that would run infinitely. I blacklisted these and continued running the script.


```py
from tqdm import tqdm
import subprocess
from subprocess import run

allres = {}
cmd = """
make -qp |
    awk -F':' '/^[a-zA-Z0-9][^$#\/\t=]*:([^=]|$)/ {split($1,A,/ /);for(i in A)print A[i]}' |
    sort -u
    """
# https://unix.stackexchange.com/questions/230047/how-to-list-all-targets-in-make
targets = x = run(cmd,shell=True,stdout=subprocess.PIPE).stdout.decode('utf-8').split("\n")[:-1] # Gets all targets from command output

bad = ['l6f83d9ad', 'Ja56c77a6', 'n103193b0']
# Infinite looping targets

for t in bad:
	targets.remove(t) # Removes "bad" targets

pbar = tqdm(targets) # Fancy progress bar :)
for x in pbar:
    pbar.set_description(x)
    allres[run(["make", x, "-s"], stdout=subprocess.PIPE).stdout.decode('utf-8').replace("\n", "")] = x 
    """
    We use -s as it filters out all debug/actual Make-related output. The command being passed into subprocess.run is then `make <target> -s`.
    The output is then decoded as it is a bytes object, and the newlines are removed.
    The target is then assigned to the result of the command so we can look it up later.
    """

print(allres["1111111l11lll1ll11l11111111lNope!"]) # Looks up the desired output
# *********
```
We can now verify the solution.

```
make ******** -s
1
1
1
1
1
1
1
l
1
1
l
l
l
1
l
l
1
1
l
1
1
1
1
1
1
1
1
l
Nope!
```
This matches the output we needed :)
<details> 
    <summary>Flag</summary>
byuctf{y2f45206c}
</details>