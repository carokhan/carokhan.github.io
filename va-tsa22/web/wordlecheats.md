# Wordle Cheats (50)
#### web - Virginia TSA Technosphere 2022 CTF

## Challenge description:
> I'm really bad at Wordle. Can you cheat for me and show me how to make my max streak 1337?
> 
> [https://vatsa-wordle-cheats.chals.io/](https://vatsa-wordle-cheats.chals.io/)

## Solution
Opening the Developer Tools and going to the Search in the bottom panel, we can search for 1337. This returns line 1965 in main.e65ce0a5.js. 

The entire code snippet is:

```js
   let statistics = localStorage.getItem("statistics")
    if (statistics) {
        statistics = JSON.parse(statistics)
        if (statistics.maxStreak === 1337) {
            let key = statistics.maxStreak.toString();
            let text = 'W_RPJCAXWV@DX\\]V]lDXCW_RnC_VHVAJ';
            let result = '';
            for (let i = 0; i < text.length; i++) {
                result += String.fromCharCode(text.charCodeAt(i) ^ key.charCodeAt(i % key.length));
            }
            alert(result);
        }
    }
```

If we play through a round, we can get statistics through the console.

```js
> let statistics = localStorage.getItem("statistics")
> statistics
'{"currentStreak":1,"maxStreak":1,"guesses":{"1":0,"2":0,"3":0,"4":1,"5":0,"6":0,"fail":0},"winPercentage":100,"gamesPlayed":1,"gamesWon":1,"averageGuesses":4}'
```

We can then edit the value of the variable and run the code after the first line.

```js
> statistics = '{"currentStreak":1337,"maxStreak":1337,"guesses":{"1":0,"2":0,"3":0,"4":1,"5":0,"6":0,"fail":0},"winPercentage":100,"gamesPlayed":1,"gamesWon":1,"averageGuesses":4}'

> if (statistics) {
        statistics = JSON.parse(statistics)
        if (statistics.maxStreak === 1337) {
            let key = statistics.maxStreak.toString();
            let text = 'W_RPJCAXWV@DX\\]V]lDXCW_RnC_VHVAJ';
            let result = '';
            for (let i = 0; i < text.length; i++) {
                result += String.fromCharCode(text.charCodeAt(i) ^ key.charCodeAt(i % key.length));
            }
            alert(result);
        }
    }
```

An alert is then sent with the flag.
<details> 
    <summary>Flag</summary>
flag{professional_wordle_player}
</details>