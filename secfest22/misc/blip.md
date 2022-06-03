# blip
#### misc - [SecurityFest](../main.md)

## Challenge description:
> Some of the other organisers told me I shouldn't tell anyone we are leaking a flag.
> 
> Download file: [original.png](../assets/original.png)

## Solution
![Given image](../assets/original.png)


Awww, this looks like steg - however, it is faintly visible.

I wrote some scripts in Python to just alter color values because I don't know real steganography. Several failed attempts, roughly 1200 images, and an hour of squinting later, we got the flag with these:

```py
# adjusts all
In [1]: for i in trange(255):
   ...:     img = Image.open("original.png")
   ...:     for x in range(img.size[0]):
   ...:         for y in range(img.size[1]):
   ...:             r, g, b = img.getpixel((x, y))
   ...:             r += i
   ...:             g += i
   ...:             b += i
   ...:             if r > 255:
   ...:                 r -= 255
   ...:             if g > 255:
   ...:                 g -= 255
   ...:             if b > 255:
   ...:                 b -= 255
   ...:             img.putpixel((x, y), (r, g, b))
   ...:     img.save("fleg" + str(i) + ".png")
```
```py
# adjusts blue
In [1]: for i in trange(255):
   ...:     ...:     img = Image.open("original.png")
   ...:     ...:     for x in range(img.size[0]):
   ...:     ...:         for y in range(img.size[1]):
   ...:     ...:             r, g, b = img.getpixel((x, y))
   ...:     ...:             b += i
   ...:     ...:             #if r > 255:
   ...:     ...:              #   r -= 255
   ...:     ...:             #if g > 255:
   ...:     ...:               #  g -= 255
   ...:     ...:             if b > 255:
   ...:     ...:                 b -= 255
   ...:     ...:             img.putpixel((x, y), (r, g, b))
   ...:     ...:     img.save("bluefleg" + str(i) + ".png")
 
# adjusts green
In [1]: for i in trange(255):
   ...:     ...:     img = Image.open("original.png")
   ...:     ...:     for x in range(img.size[0]):
   ...:     ...:         for y in range(img.size[1]):
   ...:     ...:             r, g, b = img.getpixel((x, y))
   ...:     ...:             g += i
   ...:     ...:             #if r > 255:
   ...:     ...:             #    r -= 255
   ...:     ...:             if g > 255:
   ...:     ...:                 g -= 255
   ...:     ...:             #if b > 255:
   ...:     ...:              #   b -= 255
   ...:     ...:             img.putpixel((x, y), (r, g, b))
   ...:     ...:     img.save("greenfleg" + str(i) + ".png")
 
# adjusts red
In [1]: for i in trange(255):
   ...:     ...:     img = Image.open("original.png")
   ...:     ...:     for x in range(img.size[0]):
   ...:     ...:         for y in range(img.size[1]):
   ...:     ...:             r, g, b = img.getpixel((x, y))
   ...:     ...:             r += i
   ...:     ...:             if r > 255:
   ...:     ...:                 r -= 255
   ...:     ...:             #if g > 255:
   ...:     ...:              #   g -= 255
   ...:     ...:             #if b > 255:
   ...:     ...:              #   b -= 255
   ...:     ...:             img.putpixel((x, y), (r, g, b))
   ...:     ...:     img.save("redfleg" + str(i) + ".png")
   ```
<details> 
    <summary>Flag</summary>
SECFEST{SN1TCHES_GE7_GL1TCHES</details>