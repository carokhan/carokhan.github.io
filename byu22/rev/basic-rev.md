# Basic Rev - 50
#### rev - [BYUCTF](../main.md)

## Challenge description:
> How well do you know assembly? Do you know of any tools that can help you? (Hint, they both start with the letter G)
> 
> Download file: [basic_rev](../assets/basic_rev)

## Solution
The description hints at two tools to work with, likely [Ghidra](https://ghidra-sre.org/) and [gdb](https://ctf101.org/reverse-engineering/what-is-gdb/)/[gef](https://github.com/hugsy/gef).

First, I ran the binary.
```
$ ./basic_rev
Enter an integer: 1337
Wrong number!
```
All it does is ask for an integer, and presumably, the correct one will return a flag.

Opening up Ghidra, we see the decompiled main function:

```c
undefined8 main(void)

{
  int local_c;
  
  local_c = 0;
  std::operator<<((basic_ostream *)std::cout,"Enter an integer: ");
  std::basic_istream<char,std::char_traits<char>>::operator>>
            ((basic_istream<char,std::char_traits<char>> *)std::cin,&local_c);
  constructFlag(local_c);
  return 0;
}
```
It takes in our integer and passes it to the constructFlag function. The decompiled form of this is:
```c

/* constructFlag(int) */

void constructFlag(int param_1)

{
  basic_ostream *pbVar1;
  basic_string<char,std::char_traits<char>,std::allocator<char>> local_128 [47];
  allocator local_f9;
  basic_string local_f8 [8];
  basic_string local_d8 [8];
  basic_string local_b8 [8];
  basic_string local_98 [8];
  basic_string local_78 [8];
  basic_string local_58 [8];
  basic_string local_38 [10];
  
  std::allocator<char>::allocator();
       byuctf{t35t_fl4g_pl3453_ign0r3}             /* try { // try from 001023d5 to 001023d9 has its CatchHandler @ 00102735 */
  std::__cxx11::basic_string<char,std::char_traits<char>,std::allocator<char>>::
  basic_string<std::allocator<char>>(local_128,"",&local_f9);
  std::allocator<char>::~allocator((allocator<char> *)&local_f9);
  if (param_1 == 0x121) {
                    /* try { // try from 0010240d to 00102535 has its CatchHandler @ 00102766 */
    std::__cxx11::basic_string<char,std::char_traits<char>,std::allocator<char>>::operator=
              (local_128,"ctf");
    std::operator+((char *)local_f8,(basic_string *)&DAT_0010300d);
    std::__cxx11::basic_string<char,std::char_traits<char>,std::allocator<char>>::operator=
              (local_128,local_f8);
    std::__cxx11::basic_string<char,std::char_traits<char>,std::allocator<char>>::~basic_string
              ((basic_string<char,std::char_traits<char>,std::allocator<char>> *)local_f8);
    std::operator+((basic_string.conflict *)local_d8,(char *)local_128);
    std::__cxx11::basic_string<char,std::char_traits<char>,std::allocator<char>>::operator=
              (local_128,local_d8);
    std::__cxx11::basic_string<char,std::char_traits<char>,std::allocator<char>>::~basic_string
              ((basic_string<char,std::char_traits<char>,std::allocator<char>> *)local_d8);
    std::__cxx11::basic_string<char,std::char_traits<char>,std::allocator<char>>::operator+=
              (local_128,"t3");
    std::__cxx11::basic_string<char,std::char_traits<char>,std::allocator<char>>::operator+=
              (local_128,'5');
    std::__cxx11::basic_string<char,std::char_traits<char>,std::allocator<char>>::operator+=
              (local_128,'t');
    std::__cxx11::basic_string<char,std::char_traits<char>,std::allocator<char>>::operator+=
              (local_128,'_');
    std::__cxx11::basic_string<char,std::char_traits<char>,std::allocator<char>>::operator+=
              (local_128,"fl");
    std::__cxx11::to_string((__cxx11 *)local_b8,4);
                    /* try { // try from 0010254a to 0010254e has its CatchHandler @ 00102752 */
    std::__cxx11::basic_string<char,std::char_traits<char>,std::allocator<char>>::operator+=
              (local_128,local_b8);
    std::__cxx11::basic_string<char,std::char_traits<char>,std::allocator<char>>::~basic_string
              ((basic_string<char,std::char_traits<char>,std::allocator<char>> *)local_b8);
                    /* try { // try from 00102572 to 00102723 has its CatchHandler @ 00102766 */
    std::__cxx11::basic_string<char,std::char_traits<char>,std::allocator<char>>::operator+=
              (local_128,"g");
    std::operator+((basic_string.conflict *)local_98,(char *)local_128);
    std::__cxx11::basic_string<char,std::char_traits<char>,std::allocator<char>>::operator=
              (local_128,local_98);
    std::__cxx11::basic_string<char,std::char_traits<char>,std::allocator<char>>::~basic_string
              ((basic_string<char,std::char_traits<char>,std::allocator<char>> *)local_98);
    std::operator+((basic_string.conflict *)local_78,(char *)local_128);
    std::__cxx11::basic_string<char,std::char_traits<char>,std::allocator<char>>::operator=
              (local_128,local_78);
    std::__cxx11::basic_string<char,std::char_traits<char>,std::allocator<char>>::~basic_string
              ((basic_string<char,std::char_traits<char>,std::allocator<char>> *)local_78);
    std::operator+((basic_string.conflict *)local_58,(char *)local_128);
    std::__cxx11::basic_string<char,std::char_traits<char>,std::allocator<char>>::operator=
              (local_128,local_58);
    std::__cxx11::basic_string<char,std::char_traits<char>,std::allocator<char>>::~basic_string
              ((basic_string<char,std::char_traits<char>,std::allocator<char>> *)local_58);
    std::operator+((basic_string.conflict *)local_38,(char *)local_128);
    std::__cxx11::basic_string<char,std::char_traits<char>,std::allocator<char>>::operator=
              (local_128,local_38);
    std::__cxx11::basic_string<char,std::char_traits<char>,std::allocator<char>>::~basic_string
              ((basic_string<char,std::char_traits<char>,std::allocator<char>> *)local_38);
    std::__cxx11::basic_string<char,std::char_traits<char>,std::allocator<char>>::operator+=
              (local_128,"n0");
    std::__cxx11::basic_string<char,std::char_traits<char>,std::allocator<char>>::operator+=
              (local_128,'r');
    std::__cxx11::basic_string<char,std::char_traits<char>,std::allocator<char>>::operator+=
              (local_128,"3");
    std::__cxx11::basic_string<char,std::char_traits<char>,std::allocator<char>>::operator+=
              (local_128,"}");
    pbVar1 = std::operator<<((basic_ostream *)std::cout,"Finished processing flag!");
    std::operator<<(pbVar1,"\n");
  }
  else {
    std::operator<<((basic_ostream *)std::cout,"Wrong number!");
  }
  std::__cxx11::basic_string<char,std::char_traits<char>,std::allocator<char>>::~basic_string
            (local_128);
  return;
  ```
A lot more going on. However, on the 23rd line, it compares the input to the function to `0x121.` This evaluates to 289.

If we enter 289 into our binary we get...
```
$ ./basic_rev
Enter an integer: 289
Finished processing flag!
```
Huh - still nothing. If I wasn't in such a rush I would have noticed the constructFlag function returns nothing. (If I wasn't in such a rush I would also see the flag is here in plaintext, just broken apart. Lessons learned.) However, we can see the memory values in gdb/gef. I set a breakpoint for the constructFlag function, ran the program, entered 289, and stepped through each instruction.
```
$ gdb basic_rev
GNU gdb (Ubuntu 9.2-0ubuntu1~20.04.1) 9.2
...
GEF for linux ready, type `gef' to start, `gef config' to configure
96 commands loaded for GDB 9.2 using Python engine 3.8
Reading symbols from basic_rev...
(No debugging symbols found in basic_rev)
gef➤  break *constructFlag(int) 
Breakpoint 1 at 0x2399
gef➤  run
Starting program: /home/ronin/ctfs/byuctf22/rev/basic-rev/basic_rev 
Enter an integer: 289
...
```
Eventually, we can see the flag being constructed in the pointers of the registry.

At `<constructFlag(int)+841>`:
```
[ Legend: Modified register | Code | Heap | Stack | String ]
- registers
$rax   : 0x00555555557030  →  "Finished processing flag!"
$rbx   : 0x00555555556f90  →  <__libc_csu_init+0> push r15
$rcx   : 0xe               
$rdx   : 0x1               
$rsp   : 0x007fffffffdb80  →  0x0000000000000121
$rbp   : 0x007fffffffdcb0  →  0x007fffffffdcd0  →  0x0000000000000000
$rsi   : 0x0055555555702e  →  0x6873696e6946007d ("}"?)
$rdi   : 0x0055555556c790  →  "byuctf{***********************}"
$rip   : 0x005555555566e2  →  <constructFlag(int)+841> mov rsi, rax
$r8    : 0x0               
$r9    : 0x1e              
$r10   : 0xfffffffffffff04a
$r11   : 0x007ffff7d96be0  →  0x0055555556c7c0  →  0x0000000000000000
$r12   : 0x005555555562b0  →  <_start+0> xor ebp, ebp
$r13   : 0x007fffffffddc0  →  0x0000000000000001
$r14   : 0x0               
$r15   : 0x0               
$eflags: [zero carry parity adjust sign trap INTERRUPT direction overflow resume virtualx86 identification]
$cs: 0x33 $ss: 0x2b $ds: 0x00 $es: 0x00 $fs: 0x00 $gs: 0x00 
...
gef➤
```

<details> 
    <summary>Flag</summary>
byuctf{t35t_fl4g_pl3453_ign0r3}
</details>