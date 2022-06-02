# Fetaverse - 50
#### web - [BYUCTF](../main.md)

## Challenge description:
> Come explore the fetaverse of cheesy puns and pics. It's an un-brie-lievably well-designed site!
>
> http://fetaverse.byuctf.xyz


## Solution
Looking at the requests, we see images are stored at /images. There is a local folder inclusion for the memes directory, in which there is an image with the flag.
<details> 
    <summary>Flag</summary>
byuctf{welc0me_t0_the_fetaverse}</details>