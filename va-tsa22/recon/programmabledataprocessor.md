# Programmable Data Processor (100)
#### recon - [Virginia TSA Technosphere 2022 CTF](../main.md)

## Challenge description:
> Long time time UNIX afficandos are excited to be able to use a virtual [DEC PDP-11](https://en.wikipedia.org/wiki/PDP-11) and [UNIX V6](https://en.wikipedia.org/wiki/Version_6_Unix) at [http://takahirox.github.io/pdp11-js/unixv6.html](http://takahirox.github.io/pdp11-js/unixv6.html)
> 
> What is the username of user with UID 6? Be sure the username is all lowercase and wrap it within flag{}!

## Solution
Going to the provided website, we can "load UNIX v6 Disk Image". Follow the provided instructions to login. We can then cat the /etc/passwd file to see a list of users with their user id.
```
@rkunix
mem = 1035
RESTRICTED RIGHTS

Use, duplication or disclosure is subject to
restrictions stated in Contract with Western
Electric Company, Inc.

login: root
# cat /etc/passwd
root::0:3::/:
daemon::1:1::/:
bin::3:3::/bin:
***::6:1::/usr/***:
```
<details> 
    <summary>Flag</summary>
flag{ken}
</details>