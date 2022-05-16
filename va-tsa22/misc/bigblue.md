# Big Blue (100)
#### misc - [Virginia TSA Technosphere 2022 CTF](../main.md)

## Challenge description:
> Thomas J. Watson has found this message. Unfortunately, his newfangled computers don't seem to understand it and he can't get his IBM 360 running. Do you THINK you can help him?
> 
> 86938187C08995A385999581A3899695819382A4A2899585A2A294818388899585A2D0

## Solution
During the CTF, I just tossed this in to [Cyberchef](https://gchq.github.io/CyberChef/) with the Magic recipe in intensive mode. This returned the flag using the recipes From_Hex('None'), and Decode_text('IBM EBCDIC International (500)').

<details> 
    <summary>Flag</summary>
flag{internationalbusinessmachines}	
</details>