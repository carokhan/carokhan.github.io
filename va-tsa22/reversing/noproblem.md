# NOProblem (200)
#### reversing - [Virginia TSA Technosphere CTF](../main.md)

## Challenge description:
> This exectuable is supposed to print a string, but it doesn't? Can you fix it for a flag? Maybe reading up on [syscalls](https://en.wikipedia.org/wiki/System_call) will help you.
> 
> Download file: [noproblem](./../assets/noproblem)

## Solution 
Upon marking the file as executable with `chmod +x noproblem`, I ran it. As the description says, nothing happens. The Wikipedia article did not seem to have anything immediately useful, so I turned to ghidra to disassemble it.

In Ghidra, we see the decompiled entry function:
```c
/* WARNING: Control flow encountered bad instruction data */

void entry(void)

{
  ulong uVar1;
  long lVar2;
  
  uVar1 = 0;
  lVar2 = 5;
  do {
    text[lVar2] = (&xorStr)[uVar1] ^ text[lVar2];
    uVar1 = (ulong)(byte)((char)uVar1 + 1);
    lVar2 = lVar2 + 1;
  } while (lVar2 < 0x19);
  syscall();
                    /* WARNING: Bad instruction - Truncating control flow here */
  halt_baddata();
}
```

Ghidra tells us that the syscall() stopped the program, however, we see before that the binary seems to be decrypting a string. We can use gdb/gef to set a breakpoint and read the values of the variables.

First, we have to set the breakpoint before the syscall. I use `Tab` after typing `disas` (disassemble) to see all available symbols. `_loop` and `_start` are the most interesting to us, as they are straight from the binary. We can look at these functions in Ghidra, and we see that while `_start` does not do much, `_loop` is where our `entry` function was located. 
```
$ gdb ./noproblem
GNU gdb (Ubuntu 9.2-0ubuntu1~20.04.1) 9.2
[...]
For help, type "help".
Type "apropos word" to search for commands related to "word"...
GEF for linux ready, type `gef' to start, `gef config' to configure
96 commands loaded for GDB 9.2 using Python engine 3.8
Reading symbols from ./noproblem...
gef➤  disas 
-function      -label         -line          -probe         -probe-dtrace  -probe-stap    -qualified     -source        _loop          _start         missing.s      
gef➤  disas _loop
Dump of assembler code for function _loop:
   0x00000000004000be <+0>:	mov    al,BYTE PTR [rdx+0x600124]
   0x00000000004000c4 <+6>:	mov    bl,BYTE PTR [rcx+0x400110]
   0x00000000004000ca <+12>:	xor    bl,al
   0x00000000004000cc <+14>:	mov    BYTE PTR [rdx+0x600124],bl
   0x00000000004000d2 <+20>:	add    cl,0x1
   0x00000000004000d5 <+23>:	add    rdx,0x1
   0x00000000004000d9 <+27>:	cmp    rdx,0x18
   0x00000000004000dd <+31>:	jle    0x4000be <_loop>
   0x00000000004000df <+33>:	mov    rax,0x1
   0x00000000004000e6 <+40>:	mov    rdi,0x1
   0x00000000004000ed <+47>:	mov    rsi,0x600124
   0x00000000004000f4 <+54>:	movabs rdx,0x1b
   0x00000000004000fe <+64>:	nop
   0x00000000004000ff <+65>:	nop
   0x0000000000400100 <+66>:	mov    rax,0x3c
   0x0000000000400107 <+73>:	mov    rdi,0x0
   0x000000000040010e <+80>:	syscall 
End of assembler dump.
gef➤ 
```
Disassembling it, we see that the syscall instruction that stopped the program is at `_loop+80`.

We can set a breakpoint, run the program up to that point, and see the variables before the program quits out.
```
gef➤  break *(_loop+80)
Breakpoint 1 at 0x40010e: file missing.s, line 39.
gef➤  run 
Starting program: noproblem 

Breakpoint 1, _loop () at missing.s:39
...
```
gdb hits our breakpoint, and then prints out information from the registry, which is where we can see the addresses and the values at those addresses - including the flag!
```
...
registers
$rax   : 0x3c              
$rbx   : 0x7d              
$rcx   : 0x14              
$rdx   : 0x1b              
$rsp   : 0x007fffffffdd90  →  0x0000000000000001
$rbp   : 0x0               
$rsi   : 0x00000000600124  →  "*************************\n"
...
```

<details> 
    <summary>Flag</summary>
flag{syscallamongfriends}
</details>