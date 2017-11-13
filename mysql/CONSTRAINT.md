# CONSTRAINT
		
**一.主键：非空，唯一**

创建时
```
CREATE TABLE student(
	name char(10),
	id  int PRIMARY KEY | AUTO_INCREMENT	#列级约束
);

CREATE TABLE student(
	name char(10),
	id int ,
	CONSTRAINT pkName PRIMARY KEY (id)  #表级约束
);
```

创建后	
	
```
ALTER TABLE student ADD PRIMARY KEY(id);
	
ALTER TABLE student ADD CONSTRAINT pkName PRIMARY KEY (id);
	
ALTER TABLE student DROP PRIMARY KEY;
```	
	
<br/>

**二.非空**

创建时

```
CREATE TABLE student(
	id int NOT NULL,
	name char(10)
);
```

<br/>

**三.唯一**

创建时

```
CREATE TABLE student(
	id int,
	name char(10) UNIQUE	#列级约束
);

CREATE TABLE student(
	id int,
	name char(10),
	CONSTRAINT unionName UNIQUE (id,name) #表级约束
);
```

创建后

```
ALTER TABLE Persons ADD UNIQUE (P_Id);

ALTER TABLE Persons ADD CONSTRAINT unionName UNIQUE (P_Id,LastName);

ALTER TABLE Persons DROP index unionName;
```

<br/>

**四.外键**(1.外键必须为另一表的主键;2.外键可以重复;3.外键可以为空;4.一张表可以有多个外键)

创建时

```
CREATE TABLE student(
	id int ,
	CONSTRAINT fk FOREIGN KEY (id) REFERENCES teacher(id) #表级约束
	CONSTRAINT fk FOREIGN KEY (id) REFERENCES teacher(id) ON DELETE | UPDATE CASCADE,
	#当删除或更新teacher表的id，相应的删除或更新student的id
	CONSTRAINT fk FOREIGN KEY (id) REFERENCES teacher(id) ON DELETE | UPDATE SET NULL,
	#当删除或更新teacher表的id,相应的设置student表的id为null
	CONSTRAINT fk FOREIGN KEY (id) REFERENCES teacher(id) ON DELETE | UPDATE NO ACTION,
	#拒绝teacher表删除或更新id
);
```

创建后

```
ALTER TABLE student ADD CONSTRAINT fk FOREIGN KEY(id) REFERENCES teacher(id);
	
ALTER TABLE student DROP FOREIGN KEY fk;
```	

<br/>

**五. CHECK 约束**

CHECK 约束用于限制列中的值的范围。

创建时

```
CREATE TABLE Persons(
	P_Id int NOT NULL,
	LastName varchar(255) NOT NULL,
	CONSTRAINT chk_Person CHECK (P_Id>0)	#表级约束
);
```

创建后

```
ALTER TABLE Persons ADD CHECK (P_Id>0);

ALTER TABLE Persons  ADD CONSTRAINT chk_Person CHECK (P_Id>0);

ALTER TABLE Persons DROP CHECK chk_Person;
```

<br/>

**六.DEFAULT 约束**
	
DEFAULT 约束用于向列中插入默认值。	

创建时

```
CREATE TABLE Persons(
	P_Id int NOT NULL,
	LastName varchar(255) NOT NULL,
	City varchar(255) DEFAULT 'Sandnes'  #列级约束
);
```

创建后

```
ALTER TABLE Persons ALTER City SET DEFAULT 'SANDNES';

ALTER TABLE Persons  ALTER City DROP DEFAULT;
```
