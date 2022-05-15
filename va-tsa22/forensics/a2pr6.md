# A2PR#6 (100)
#### programming - Virginia TSA Technosphere 2022 CTF

## Challenge description:
> A disk a day will keep the doctor away.
> 
> Download file: forgot to save :(

## Solution 
We can run the file command to get more information on the file.

```
$ file a2pr6.dsk 
a2pr6.dsk: Apple ProDOS Image, Volume /SYSTEMSK, 280 Blocks
```

A Google search on working with ProDOS images revealed the tool [AppleCommander](https://github.com/AppleCommander/AppleCommander/).
While I did not have success with the GUI versions, the CLI release, AppleCommander-acx-1.7.0.jar, was fine.

```
$ java -jar AppleCommander-acx-1.7.0.jar ls --disk=a2pr6.dsk

File: a2pr6.dsk
Name: /SYSTEM/
  PRODOS          SYS      034 09/19/2007 12/15/1991     16 509          
  TEST            BAS      001 09/19/2007 09/19/2007          3 A=$0801  
  FINDER.DATA     FND      001 12/13/2020 12/13/2020        107          
  BASIC.SYSTEM    SYS      021 02/13/1992 04/10/1993     10,240 A=$2000  
  STARTUP         BIN      001 01/30/2022 01/30/2022         38 A=$8000  
  FINDER.ROOT     FND      001 12/13/2020 12/13/2020          9          
ProDOS format; 109,568 bytes free; 33,792 bytes used.

$ java -jar AppleCommander-acx-1.7.0.jar x STARTUP --disk=CTF.dsk
Offset   Hex Data                                          Characters
=======  ================================================  =================
$000000  20 58 FC A2 00 BD 11 80  F0 06 20 ED FD E8 10 F5   X|".=.. p. m}h.u
$000010  60 E6 EC E1 E7 FB E1 F0  F0 EC E5 E9 E9 E6 EF F2  `******* ********
$000020  E5 F6 E5 F2 FD 00 .. ..  .. .. .. .. .. .. .. ..  *****.           
** END * *
```
<details> 
    <summary>Flag</summary>
flag{appleiiforever}
</details>