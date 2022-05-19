# Knowledge is the key to success (50)
#### osint - [Louisa County High School](../main.md)

## Challenge description:
> To get this key, you must be a sleuth. You have been given the ipaddres of 19.12.97.37. To capture this flag, you must know the OrgID and the RegDate. 
>
> The flag format is CTF{OridID:YYYY-MM-DD}


## Solution 
OrgID means organization ID and RegDate means registration date. We can use an IP whois service for this. For example: [https://iplocation.io/ip-whois-lookup/%2019.12.97.37](https://iplocation.io/ip-whois-lookup/%2019.12.97.37) 

This provides the necessary information.

<details> 
    <summary>Flag</summary>
CTF{FORDMO:1988-06-15}
    </details>