# Is my house locked? (150)
#### web - [Louisa County High School](../main.md)

## Challenge description:
> Use your skills to check out the host 
> 
> The key to this flag is knowing whats open and what is closed. Once you are certin of the open ports, you will need to creat the flag in the correct format. The following is an example of the flage if tcp 8080 and tcp 80 and udp 1701 and tcp 21 are open the flag would be: CTF{tcp8080:udp1701:tcp80:tcp21}
>
> ctf-id-3.lcps.k12.va.us


## Solution 
This is a simple port scan.

``` 
$ nmap ctf-id-3.lcps.k12.va.us
Starting Nmap 7.80 ( https://nmap.org ) at 2022-05-13 16:14 EDT
Nmap scan report for ctf-id-3.lcps.k12.va.us (199.201.191.217)
Host is up (0.0061s latency).
Not shown: 996 filtered ports
PORT     STATE  SERVICE
22/tcp   open   ssh
80/tcp   open   http
7080/tcp open   empowerid
443/tcp  closed https
8080/tcp closed http-proxy

Nmap done: 1 IP address (1 host up) scanned in 17.76 seconds
```

<details> 
    <summary>Flag</summary>
CTF{tcp7080:tcp80:tcp22}
</details>