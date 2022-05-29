# Oh The Vanity - 100
#### osint - [BYUCTF](../main.md)

## Challenge description:
> The vanity and audacity of these scammers and their phishing attacks are just getting ridiculous. I read an article this month about a new way to mask phishing campaigns. They even included this photo. Find the date the article was published.
> 
> Flag format: byuctf{mm-dd-yyyy}
> 
> Download file: [sharky.JPG](../assets/sharky.JPG)

## Solution
We are given an image and told it was used in an article on phishing in the past month.

We can upload the image to [Google's reverse image search](https://images.google.com/) and search with the keyword phishing. This yields [this query](https://www.google.com/search?q=phishing&newwindow=1&tbs=sbi%3AAMhZZit7DZmOgEYZUxKUx_1U3-8pXlxUeSW1zkzgnDaWymieBHx3zu88cNmGJNyjeYslaGRgjA8a3eULpMnUlOhG898hfPnEbPFxKeATDmc3XjsCBydsfXqbX6w-_1o5OcEAQN0W6dJYVImk70xfbcYLHLWzzsWBduD1pPleF5OFx_1j1xoIpHilSKU8K4E1CRm_1h8ocmpHA-qE7_1MP7_16XZi1PNWOleI0-2yKUEe98Gu9E9OadPFR7FgpLLVg-qdVFjz99h7NpVrw6GIgKrcV6afs1rsfqvstV0tH_1fD6HCfaVNpfIJu8ahsigrXw-LtzIpBOyGsC3oKFX8x-u-ViJwvxzjM8Mo4k8ow&sxsrf=ALiCzsY0yrPOM0eGL1SmbV428-OpO1vqwQ%3A1653697556084&ei=FGyRYongBMyxkvQPvYy7qA0&ved=0ahUKEwiJupW794D4AhXMmIQIHT3GDtUQ4dUDCA8&uact=5&oq=phishing&gs_lcp=Cgdnd3Mtd2l6EAMyCAgAEIAEELEDMggIABCABBCxAzIFCAAQgAQyCAgAEIAEELEDMgUIABCABDIICAAQgAQQsQMyCwgAEIAEELEDEIMBMgUIABCABDIFCAAQgAQyCwguEIAEEMcBEK8BOgUIIRCgAToFCC4QgAQ6EQguEIAEELEDEIMBEMcBEKMCOhQILhCABBCxAxCDARDHARCjAhDUAjoOCC4QgAQQsQMQxwEQowI6CwguEIAEELEDEIMBOggILhCABBCxAzoICAAQsQMQgwE6DgguEIAEELEDEMcBENEDOhEILhCABBCxAxCDARDHARDRAzoLCC4QgAQQxwEQowI6CAguELEDEIMBSgQIQRgASgQIRhgASgQIQRgASgQIRhgAUOUBWNYcYKcdaAJwAHgBgAFaiAGBCJIBAjIymAEAoAEBsAEA&sclient=gws-wiz).

We can scroll down to see the pages that include matching images, where we will see [this article](https://www.darkreading.com/cloud/vanity-urls-could-be-spoofed-for-social-engineering-attacks), written in the past month.

The date of publishing is our flag :)
<details> 
    <summary>Flag</summary>
byuctf{05-11-2022}
</details>