# BM(Boyer-Moore算法)


BM算法是一种字符串匹配算法，最坏情况下的时间复杂度为O(N)，在实践中比KMP算法的实际效率高。

### 分析

1.首先文本串与模式串头部对齐，从尾部开始比较。'S'与'E'不匹配，则称'S'为坏字符。

```
HEAD IS A SIMPLE EXAMPLE
EXAMPLE
```

2.坏字符规则:模式串移动位数=坏字符位置-坏字符在模式串中最右出现的位置(不存在为-1)。如'S'坏字符不在模式串中，则移动位置=6-(-1)=7。'P'坏字符不在模式串中，则移动位置=6-4=2。

```
HEAD IS A SIMPLE EXAMPLE
       EXAMPLE
```

```
HEAD IS A SIMPLE EXAMPLE
         EXAMPLE
```

3.依次从尾部比较，得到'E','LE','PLE','MPLE'匹配，称为好后缀。

4.好后缀规则:模式串移动位数=好后缀位置-好后缀在模式串其余部分中最右出现的位置(不存在为-1)。如'E'好后缀在模式串其余部分中，则移动位置=6-0=6。

```
HEAD IS A SIMPLE EXAMPLE
               EXAMPLE
```

```
HEAD IS A SIMPLE EXAMPLE
                 EXAMPLE
```

5.注意当坏字符规则与好后缀规则同时存在时，模式串移动位置=max(坏字符规则，好后缀规则)；