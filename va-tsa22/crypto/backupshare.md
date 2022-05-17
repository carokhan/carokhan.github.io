# backup-share (200)
#### crypto - [Virginia TSA Technosphere CTF](../main.md)

## Challenge description:
> Our school administrator left those files on our samba share, I wonder what do they do...
> 
> Download files: 
> - [backup-share/memo.txt](../assets/backup-share/memo.txt)
> - [backup-share/SYSTEM](../assets/backup-share/SYSTEM)
> - [backup-share/SAM](./../assets/backup-share/SAM)

## Solution 
We are given two registry files and a text file.
```
$ file *
memo.txt: ASCII text
SAM:      MS Windows registry file, NT/2000 or above
SYSTEM:   MS Windows registry file, NT/2000 or above
```
The memo mentions "mimi-katz" - [mimikatz](https://github.com/ParrotSec/mimikatz), a tool that can be used, among other things, to dump password hashes from registry files. This seems to be what we must do with these registry hives. However, mimikatz is a Windows only utility, so I used [pypykatz](https://github.com/skelsec/pypykatz), a platform independent implementation written in Python, instead.
```
$ pypykatz registry --sam SAM SYSTEM
WARNING:pypykatz:SECURITY hive path not supplied! Parsing SECURITY will not work
WARNING:pypykatz:SOFTWARE hive path not supplied! Parsing SOFTWARE will not work
============== SYSTEM hive secrets ==============
CurrentControlSet: ControlSet001
Boot Key: 271370244845c9195284fc34491a3385
============== SAM hive secrets ==============
HBoot Key: 76deb1f25450c2bcfa8423554e726244b64f41db9ac284f38e9f5ad609f2f3ce
Administrator:500:aad3b435b51404eeaad3b435b51404ee:31d6cfe0d16ae931b73c59d7e0c089c0:::
Guest:501:aad3b435b51404eeaad3b435b51404ee:31d6cfe0d16ae931b73c59d7e0c089c0:::
LAB:1000:aad3b435b51404eeaad3b435b51404ee:25700d98aafce3db5ffad8a949731c6d:::
flag_user:1002:aad3b435b51404eeaad3b435b51404ee:032c72c6d11bf91e740ea34c523f9c21:::
```
It seemed like the fourth entry on the flag_user line would be our password hash, as the third line remains constant between each line. Using [https://crackstation.net/](https://crackstation.net/) returns the password.

<details> 
    <summary>Flag</summary>
flag{meatballs1}
</details>