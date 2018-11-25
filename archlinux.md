# ArchLinux安装


### 1.制作引导优盘

```
dd if=archlinux.iso of=/dev/sdb bs=4M status=progress && sync
```

### 2.连接WiFi

```
wifi-menu
```

### 3.对磁盘分区

```
parted /dev/nvme0n1
rm 1
rm 2
rm 3
print
mkpart ESP fat32 1MiB 513MiB
set 1 boot on
mkpart primary ext4 513MiB 200GiB
mkpart primary ext4 200GiB 100%
print
quit
```

### 4.格式化分区

```
mkfs.fat -F32 /dev/nvme0n1p1
mkfs.ext4 /dev/nvme0n1p2
mkfs.ext4 /dev/nvme0n1p3
```

### 5.挂载

```
mount /dev/nvme0n1p2 /mnt
mkdir -p /mnt/{boot,home}
mount /dev/nvme0n1p1 /mnt/boot
mount /dev/nvme0n1p3 /mnt/home
```

### 6.安装基础包

```
vim /etc/pacman.d/mirrorlist 设置ustc,163源
pacstrap -i /mnt base base-devel
```

### 7.生成fstab

```
genfstab -U /mnt >> /mnt/etc/fstab
```

### 8.更换目录改变镜像源

```
arch-chroot /mnt /bin/bash
pacman -S vim
vim /etc/pacman.conf 
设置multilib
设置archlinuxcn
Server = http://mirrors.163.com/archlinux-cn/$arch

pacman -Syu
pacman -S archlinuxcn-keyring yaourt bash-completion axel
vim /etc/makepkg.conf
file(http/https)::/usr/bin/axel -n 10 -a -o %o %u
```

### 9.设置区域和时区

```
vim /etc/locale.gen 去除en_US.UTF-8 zh_CN.UTF-8
locale-gen 
vim /etc/locale.conf 设置LANG=zh_CN.UTF-8
tzselect 
rm /etc/localtime
ln -s /usr/share/zoneinfo/Asia/Shanghai /etc/localtime
hwclock --systohc --utc
```

### 10.设置host

```
vim /etc/hostname 设置ArchLinux
vim /etc/hosts
127.0.0.1 localhost ArchLinux
::1 localhost ArchLinux
0.0.0.0 account.jetbrains.com
104.16.248.1 doub.io
111.230.82.224 store.steampowered.com
111.230.82.224 steamcommunity.com
```

### 11.安装引导程序

```
pacman -S intel-ucode
bootctl install
vim /boot/loader/entries/arch.conf
title   Arch Linux
linux   /vmlinuz-linux
initrd /intel-ucode.img
initrd  /initramfs-linux.img
options root=/dev/nvme0n1p2 rootfstype=ext4 rw pcie_aspm=off acpi_rev_override=1

vim /boot/loader/loader.conf
timeout 3
default arch

vim /etc/modprobe.d/modprobe.conf
blacklist  iTCO_wdt
```

### 12.添加用户

```
useradd -m -G wheel -g users -s /bin/bash minshengwu
passwd minshengwu
pacman -S sudo
visudo 添加minshengwu ALL=(ALL) ALL
```

### 13.安装图形界面

```
pacman -S xorg nvidia xf86-video-intel mesa lib32-virtualgl   lib32-nvidia-utils lib32-primus bumblebee bbswitch primus
gpasswd -a minshengwu bumblebee
systemctl enable bumblebeed.service
pacman -S gnome gnome-tweaks gdm wqy-zenhei wqy-microhei
systemctl enable gdm.service
systemctl enable NetworkManager.service
systemctl enable bluetooth.service
```

### 14.重启

```
exit
umount -R /mnt
reboot
```

### 15.触摸板

```
sudo pacman -S libinput-gestures
sudo gpasswd -a minshengwu input
libinput-gestures-setup autostart
sudo vim /etc/libinput-gestures.conf
gesture swipe up 3 _internal ws_up
gesture swipe down 3 _internal ws_down
gesture swipe left 3 xdotool key super+Left
gesture swipe right 3 xdotool key super+Right
gesture pinch in 2 xdotool key super+Down
gesture pinch out 2 xdotool key super+Up
```

### 16.其他应用

```
yaourt -S aur/ttf-consolas-with-yahei
sudo pacman -S papirus-icon-theme arc-gtk-theme gnome-shell-extension-dash-to-dock gnome-shell-extension-gsconnect
sudo pacman -S google-chrome firefox firefox-i18-zh-cn
sudo pacman -S wps-office  ttf-wps-fonts
sudo pacman -S netease-cloud-music
sudo pacman -S shadowsocks-qt5
sudo pacman -S steam steam-native-runtime primusrun %command%
sudo pacman -S clion clion-cmake clion-gdb clion-jre valgrind
sudo pacman -S virtualbox virtualbox-host-modules-arch virtualbox-guest-iso virtualbox-ext-oracle
sudo gpasswd -a minshengwu vboxusers
sudo pacman -S nginx apache-tools
sudo systemctl enable nginx
sudo systemctl start nginx
sudo pacman -S fcitx-sogoupinyin fcitx-im  fcitx-configtool
vim /etc/environment
GTK_IM_MODULE=fcitx
QT_IM_MODULE=fcitx
XMODIFIERS="@im=fcitx"

vim .bashrc
PS1="\[\e[37;40m\][\[\e[32;40m\]\u\[\e[37;40m\]@\h \[\e[36;40m\]\w\[\e[0m\]]\\$ "
```