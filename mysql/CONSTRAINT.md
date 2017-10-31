# constraint
		
**一.主键：非空，唯一**

创建时
```
CREATE TABLE student(
	name char(10),
	id  int PRIMARY KEY
);

CREATE TABLE student(
	name char(10),
	id int ,
	CONSTRAINT pkName PRIMARY KEY (id)
);
```

创建后	
	
```
ALTER TABLE student ADD PRIMARY KEY(id);
	
ALTER TABLE student ADD CONSTRAINT pkName PRIMARY KEY (id);
	
ALTER TABLE student DROP PRIMARY KEY;

```	
	
<br/>

**二.主键自增长**

创建时

```
CREATE TABLE student(
	id int PRIMARY KEY AUTO_INCREMENT,
	name char(20)
);
```	

创建后

```
ALTER TABLE student CHANGE id id int AUTO_INCREMENT;
	
ALTER TABLE student CHANGE id id int;

```

<br/>

**三.非空**

创建时

```
CREATE TABLE student(
	id int NOT NULL,
	name char(10)
);
```

<br/>

**四.唯一**

创建时

```
CREATE TABLE student(
	id int,
	name char(10) UNIQUE
);

CREATE TABLE student(
	id int,
	name char(10),
	CONSTRAINT unionName UNIQUE (id,name)
);
```

创建后

```
ALTER TABLE Persons ADD UNIQUE (P_Id);

ALTER TABLE Persons ADD CONSTRAINT unionName UNIQUE (P_Id,LastName);

ALTER TABLE Persons DROP INDEX unionName;
```

<br/>

**五.外键**(1.外键必须为另一表的主键;2.外键可以重复;3.外键可以为空;4.一张表可以有多个外键)

创建时

```
CREATE TABLE student(
	id int ,
	CONSTRAINT fk FOREIGN KEY (id) REFERENCES teacher(id)
);
```

创建后

```
ALTER TABLE student ADD CONSTRAINT fk FOREIGN KEY(id) REFERENCES teacher(id);
	
ALTER TABLE student DROP FOREIGN KEY fk;
```	

<br/>

**六. CHECK 约束**

CHECK 约束用于限制列中的值的范围。

创建时

```
CREATE TABLE Persons(
	P_Id int NOT NULL,
	LastName varchar(255) NOT NULL,
	CONSTRAINT chk_Person CHECK (P_Id>0)
);
```

创建后

```
ALTER TABLE Persons ADD CHECK (P_Id>0);

ALTER TABLE Persons  ADD CONSTRAINT chk_Person CHECK (P_Id>0);

ALTER TABLE Persons DROP CHECK chk_Person;
```

<br/>

**七.DEFAULT 约束**
	
DEFAULT 约束用于向列中插入默认值。	

创建时

```
CREATE TABLE Persons(
	P_Id int NOT NULL,
	LastName varchar(255) NOT NULL,
	City varchar(255) DEFAULT 'Sandnes'
);
```

创建后

```
ALTER TABLE Persons ALTER City SET DEFAULT 'SANDNES';

ALTER TABLE Persons  ALTER City DROP DEFAULT;
```