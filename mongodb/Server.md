# Server

**一.备份与恢复**

```
#备份test数据库至当前目录下(dump目录)
mongodump -h localhost:27017 -d test  -o .

#恢复test数据库(drop为删除存在的newTest)
mongorestore -h localhost:27017 -d newTest --drop  dump/test
```