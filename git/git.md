# git

#### (1).git的三大区域

```
#工作区域
working directory 		

#暂存区域
stage				

#git仓库
respository			
```

#### (2).安装后的全局配置

```
#配置全局作者，用于区别
git config --global user.name 'yourname' 	

#配置全局email
git config --global user.email 'youremail' 	

#配置全局是否有颜色
git config --global color.ui true		
```

#### (3).git的一般使用

```
#git初始化
git init 				

#添加文件至暂存区
git add .|fileName				

#添加暂存区文件至git仓库
git commit .|fileName -m 'modifying'	
    [-a]        将已追踪工作区域与暂存区域加入到git仓库
    [--amend]   将这次快照覆盖当前head所指快照		

#查看git状态
git status				
    [-s]    查看简略信息 
    [git仓库与暂存区文件的区别][暂存区域与工作区文件的区别]
    A:表示未添加(下级有上级没有);M:表示不相同(下级文件修改)
    D:表示已删除(上级有下级没有);?:表示未追踪(新添加的文件)
	R:表示已重命名;U:发生冲突(在合并与stash)

#查看git仓库历史快照
git log					
    [--online]      简要信息
    [--decorate]    查看head指向的分支
    [--all]         查看所有分支
	
#查看ID
git rev-parse HEAD~n			

#删除工作区域与暂存区的文件
git rm fileName				
    [--staged|--cached]      只删除暂存区文件

#将工作区域与暂存区文件file1重命名为file2，没有cached参数
git mv fileName1 fileName2
    [--staged|--cached]      只删除暂存区文件			
```


#### (4).git回滚(覆盖)

```
#git仓库回滚(原来的head依旧存在)
git reset HEAD~n|ID
    [--soft]    改变git仓库head所指的快照		
    [--mix]     改变git仓库head所指的快照,git仓库文件回滚至暂存区
    [--hard]    改变git仓库head所指的快照,git仓库文件回滚至工作区

#暂存区回滚
git checkout .|--fileName
```

#### (5).git比较

```
#比较工作区域与暂存区域
git diff [fileName]				

#比较暂存区域与git仓库
git diff --staged [fileName]       

#比较工作区域与git仓库
git diff ID|HEAD			

#比较两个历史快照的区别
git diff ID ID 				
```

#### (6).git分支管理

```
#列出所有分支
git branch				

#创建分支
git branch newBranch			

#切换分支
git checkout branchName			

#删除分支
git branch -d branchName		

#创建并切换分支
git checkout -b branchName		

#与当前分支合并,branchName还在
git merge branchName			
```

#### (7).git的stash

```
#将工作区压入栈，并将工作区恢复git仓库的head状态
git stash 				

#列出stash栈
git stash list				

#放出stash第一个栈
git stash pop				

#放出stash第n个栈
git stash apply stash@{n}		

#删除stash第n个栈
git stash drop stash@{n}		

#清空栈
git stash clear				
```

#### (8).gitignore

```	
1).gitignore配置文件用于配置不需要加入版本管理的文件

2).配置语法:
    以斜杠"/"开头表示目录
    以星号"*"通配多个字符
    以问号"?"通配单个字符
    以方括号"[]"包含单个字符的匹配列表
    以叹号"!"表示不忽略(跟踪)匹配到的文件或目录

3).此外,git 对于.ignore 配置文件是按行从上到下进行规则匹配的,意味着如果前面的规则匹配的范围更大,则后面
的规则将不会生效;
```

#### (9).github

```
(1).下载github的项目

    git clone https://github.com/wuaiqiu/Git.git

(2).上传github的项目
		
    ssh-keygen -t rsa -C "youremil(github)"
		
	copy the content of [id_rsa.pub] to the github [SSH keys]

	git remote add origin https://wuaiqiu@github.com/wuaiqiu/Git.git

	git push origin master	

(3).在安装vnc可能出错的解决办法

    (gnome-ssh-askpass:3530): Gtk-WARNING **: cannot open display
    unset SSH_ASKPASS	
```