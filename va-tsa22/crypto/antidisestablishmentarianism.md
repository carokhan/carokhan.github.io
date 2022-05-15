# Antidisestablishmentarianism (100)
#### crypto - [Virginia TSA Technosphere 2022 CTF](../main.md)

## Challenge description:
> Gilbert S. Vernam is quite frustrated that you have broken all his ciphers and is, for this one time only, bringing out the big time cipher for the security of his iPad. Can you still break in? Be sure to include the braces!
> 
> FYTORVWMKMHFWWFLXMRLTECMOMJ

## Solution
Gilbert S. Vernam is known for the creation of a cipher, the Vernam cipher. This cipher is also known as the One Time Pad Vigenere cipher. 

We can use [dcode.fr's tool](https://www.dcode.fr/vernam-cipher) to decrypt this.

Passing in the ciphertext with antidisestablishmentarianism as the key reveals the flag.

<details> 
    <summary>Flag</summary>
flag{ONEISTHELONELIESTNUMBER}
</details>