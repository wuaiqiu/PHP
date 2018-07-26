# Array

>Array类型是ZendVM底层zend_array和HashTable的封装.


1.数字索引数组

```
Array arr;
arr.append(1234);
arr.append(1234.56);
arr.append(false);
arr.append("hello world");
```

2.关联索引数组

```
Array arr;
arr.set("key1", 1234);
arr.set("key2", 1234.56);
arr.set("key3", "hello world");
arr.set("key4", true);
```

3.遍历数组

```
#遍历数字索引数组
for(int i = 0; i < array.count(); i++)
{
    php::echo("key=%d, value=%s.\n", i, array[i].toCString());
}


#通用迭代器
for(auto i = array.begin(); i != array.end(); i++)
{
    php::echo("key=%d, value=%s.\n", i.key().toCString(), i.value().toCString());
}
```

4.其他方法

```
#合并数组
Array arr1;
Array arr2;
arr2.append(123);
arr2.append("hello world");
arr2.append(123.05);
arr1.merge(arr2);

#数组排序
arr1.sort();
```