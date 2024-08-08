## Unofficial Netbird pfSense package and FreeBSD Port

Clone https://github.com/pfsense/FreeBSD-ports/tree/devel

Copy the folders under /net in this repo to the /net folder in your ports

```
cd net/netbird
make makesum
make package
```
same for pfsense package

## Installing on pfSense

pkg add -f netbird-0.28.3-whatever.pkg

sysrc netbird_enable=YES

service netbird start

netbird up -m https://netbirdhost -k netbirdkey -interface-name tun12

create new interface, assign to tun12

find netbird ip with netbird status

set static IP to your netbird ip /24

create a gateway, also use your netbird ip

create firewall rules allow all ipv4 protocols on new interface

add service netbird start as an shellcmd

add netbird up as a shellcmd

to install pfsense netbird UI install package https://repo.nhdit.com/netbird-pfsense//pfSense-pkg-netbird-0.0.2_30-amdv2.pkg or the arm one, either way. Then netbird will show under vpn menu. This is not complete, but works for basic needs.
