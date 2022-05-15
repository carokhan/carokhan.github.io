package main

import (
    "fmt"
)

func main(){
  var front = "flag{"
  var text = "fmi]iahj^e]c`W"
  var end = "}"
  var shift = rune(1)
  var i = 1

  fmt.Println("Welcome to the CTF SuperGoDecoder .000001a")

  fmt.Println("Text: " + text)

  fmt.Print("Decoded flag: ")
  fmt.Print(front)
  for _, theChar := range text{
     shift = theChar + rune(i)
     if (shift > 122) { // Went past 'Z'
        shift = shift - rune(26)
     }
     fmt.Printf("%c", shift)
     i = i + 1
     _ = theChar
  }
  fmt.Println(end)

  fmt.Println()
}
