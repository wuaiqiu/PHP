# Execl函数

>1.execl

定义|说明
--|--
表头文件|unistd.h
定义函数|int execl(const char\* path,const char\* arg,....)
函数说明|execl用来执行参数path字符串所代表的文件路径，接下来的参数代表执行该文件时传递过去的argv[0]、argv[1]……，最后一个参数必须用空指针(NULL)作结束
返回值|如果执行成功则函数不会返回，执行失败则直接返回-1，失败原因存于errno中
范例|execl("/bin/ls","ls","-al","/etc/passwd",NULL)

>2.execlp（从PATH环境变量中查找文件并执行）

定义|说明
--|--
表头文件|unistd.h
定义函数|int execlp(const char\* file,const char\* arg,……)
函数说明|execlp会从PATH环境变量所指的目录中查找符合参数file的文件名，找到后便执行该文件，然后将第二个以后的参数当做该文件的argv[0]、argv[1]……，最后一个参数必须用空指针(NULL)作结束
返回值|如果执行成功则函数不会返回，执行失败则直接返回-1，失败原因存于errno中
范例|execlp("ls","ls","-al","/etc/passwd",NULL)

>3.execv(执行文件)

定义|说明
--|--
表头文件|unistd.h
定义函数|int execv(const char\* path, char\* const argv[])
函数说明|execv用来执行参数path字符串所代表的文件路径，与execl不同的地方在于execve只需两个参数，第二个参数利用数组指针来传递给执行文件
返回值|如果执行成功则函数不会返回，执行失败则直接返回-1，失败原因存于errno中
范例|char\* argv[]={"ls","-al","/etc/passwd",NULL};<br>execv("/bin/ls",argv);

>4.execve(执行文件)

定义|说明
--|--
表头文件|unistd.h
定义函数|int execve(const char\* filename,char\* const argv[],char\* const envp[])
函数说明|execve用来执行参数filename字符串所代表的文件路径，第二个参数系利用数组指针来传递给执行文件，最后一个参数则为传递给执行文件的新环境变量数组
返回值|如果执行成功则函数不会返回，执行失败则直接返回-1，失败原因存于errno中
范例|char\* argv[]={"ls","-al","/etc/passwd",NULL};<br>char\* envp[]={"PATH=/bin",NULL};<br>execve("/bin/ls",argv,envp);

>5.execvp(执行文件)

定义|说明
--|--
表头文件|unistd.h
定义函数|int execvp(const char\* file ,char\* const argv[])
函数说明|execvp会从PATH环境变量所指的目录中查找符合参数file的文件名，找到后便执行该文件，然后将第二个参数argv传给该欲执行的文件
返回值|如果执行成功则函数不会返回，执行失败则直接返回-1，失败原因存于errno中
范例|char\* argv[]={"ls","-al","/etc/passwd",NULL};<br>execvp("ls",argv);
