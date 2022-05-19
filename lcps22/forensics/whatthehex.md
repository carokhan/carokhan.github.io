# What the Hex is going on (125)
#### forensics - [Louisa County High School](../main.md)

## Challenge description:
> I just hacked my neighbor's WiFi. I think he's up to no good. See if you have what it takes to help me find out.
> 
> Download the packet trace of his network and see if you can find the flag.
> 
> Download file: [whatthehex.pcapng](../assets/whatthehex.pcapng)

## Solution 
Given a packet capture file, the go-to is Wireshark. Opening the file in Wireshark, we see a GET request. We can right click the packet > Follow > HTTP Stream to see the full conversation.
```
GET / HTTP/1.1
Host: 192.168.0.10
Connection: keep-alive
Upgrade-Insecure-Requests: 1
User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.80 Safari/537.36 Edg/98.0.1108.50
Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9
Accept-Encoding: gzip, deflate
Accept-Language: en-US,en;q=0.9

HTTP/1.1 200 OK
Date: Thu, 24 Mar 2022 13:16:56 GMT
Server: Apache/2.4.52 (Win64) OpenSSL/1.1.1m PHP/8.1.4
X-Powered-By: PHP/8.1.4
Content-Length: 184
Keep-Alive: timeout=5, max=100
Connection: Keep-Alive
Content-Type: text/html; charset=UTF-8

<html>
 <head>
  <title>PHP Test</title>
 </head>
 <body>
 4354467b3034313432303232436830373a217d</br>Congratulations, you found it.  However, there is more work to do. </body>
</html>
```

Decoding the hex returns:
```
$ echo 4354467b3034313432303232436830373a217d | xxd -r
CTF{04142022Ch07:!}% 
```

<details> 
    <summary>Flag</summary>
CTF{04142022Ch07:!}
</details>