# Noah's Compression (200)
#### programming - Virginia TSA Technosphere 2022 CTF

## Challenge description:
> Let's see if you can extract a flag from a file without any file extensions
> 
> Download file: [noahscompression](../assets/noahscompression)

## Solution 
We can run the file command to see if the header reveals the file type.

```
$ file noahscompression
noahscompression: ARC archive data, dynamic LZW
```

Googling ARC archives revealed they could be extracted using the arc utility, which can be installed with aptitude using `sudo apt install arc` 

While the flag file itself still seems to be compressed, the flag itself is in plaintext.
```
$ arc x noahscompression
Extracting file: flag
$ cat flag
PK
    ��Rxe�lag.txtUT    ��a��aux
                                ��**************************
PK
    ��Rxe���flag.txtUT��aux
                               ��PKN]
```

<details> 
    <summary>Flag</summary>
flag{twoofeachcompression}
</details>