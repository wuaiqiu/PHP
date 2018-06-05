# PHP代码的编译

**1.PHP代码的编译**

>PHP的解析过程任务就是将PHP代码转化为zend_op_array，代码里的所有信息都保存在zend_op_array中，然后将zend_op_array交给zend引擎执行，opcode就是内核具体执行的命令，比如赋值、加减操作、函数调用等，每一条opcode都对应一个处理handle，这些handler是提前定义好的C函数。

![](./img/13.png)

<br>

**2.PHP代码->抽象语法树(AST)**

```
PHP使用re2c、bison完成这个阶段的工作:
    re2c: 词法分析器，将输入分割为一个个有意义的词块，称为token
    bison: 语法分析器，确定词法分析器分割出的token是如何彼此关联的
```

![](./img/14.png)

```
词法、语法解析过程

1.yyparse(zendparse)调用yylex(zendlex)，当读取到一个合法的token时，返回值为token类型
2.yylex调用lex_scan读取合法的token值
3.yyparse将token类型与token值构造抽象语法树,最后将根节点保存到CG的ast中
```

<br>

**3.AST节点结构**

```
typedef struct _zend_ast   zend_ast;

enum _zend_ast_kind {
	ZEND_AST_ZVAL,
	ZEND_AST_STMT_LIST,
	ZEND_AST_VAR,
    ZEND_AST_ECHO,
	ZEND_AST_ASSIGN,
  ....
};

//普通节点类型
struct _zend_ast {
    zend_ast_kind kind;  //节点类型
    zend_ast_attr attr;  //节点附加属性
    uint32_t lineno;    //行号
    zend_ast *child[1];  //子节点数组
};

//普通节点类型，但有子节点的个数
typedef struct _zend_ast_list {
    zend_ast_kind kind; //节点类型
    zend_ast_attr attr; //节点附加属性
    uint32_t lineno; //行号
    uint32_t children; //子节点数量
    zend_ast *child[1];//子节点数组
} zend_ast_list;
```

```
实例:
$a = 123;
$b = "hi~";

echo $a,$b;
```

![](./img/15.png)

<br>

**4.zend_op_array**

>PHP主脚本会生成一个zend_op_array，每个function也会编译为独立的zend_op_array，所以从二进制程序的角度看zend_op_array包含着当前作用域下的所有堆栈信息，函数调用实际就是不同zend_op_array间的切换

![](./img/16.png)

```
//opcode指令数组
typedef struct _zend_op_array zend_op_array;
struct _zend_op_array {
    uint32_t last; //opcode数组大小
    zend_op *opcodes; //opcode指令数组
    uint32_t T;//临时变量数(op_type为IS_TMP_VAR、IS_VAR)
    int last_literal;  //字面量数量
    zval *literals; //字面量数组
    int last_var; //变量数(op_type为IS_CV)
    zend_string **vars; //变量名数组
    HashTable *static_variables;//静态变量符号表
    int  cache_size; //运行时缓存数组大小
    void **run_time_cache; //运行时缓存
};
```

```
//opcode指令结构
typedef struct _zend_op zend_op;
struct _zend_op {
    const void *handler; //指令执行handler
    znode_op op1;   //操作数1
    znode_op op2;   //操作数2
    znode_op result; //返回值
    uint32_t extended_value;
    uint32_t lineno; //行号
    zend_uchar opcode;  //opcode指令号
    zend_uchar op1_type; //操作数1类型
    zend_uchar op2_type; //操作数2类型
    zend_uchar result_type; //返回值类型
};


//操作数结构
typedef union _znode_op {
    uint32_t      constant;
    uint32_t      var;
    uint32_t      num;
    uint32_t      opline_num;
    uint32_t      jmp_offset;
} znode_op;

//操作数类型
#define IS_CONST    (1<<0)  //1:字面量，编译时就可确定且不会改变的值，比如:$a = "hello~"，其中字符串"hello~"就是常量
#define IS_TMP_VAR  (1<<1)  //2:临时变量，比如：$a = "hello~" . time()，其中"hello~" . time()的值类型就是IS_TMP_VAR
#define IS_VAR      (1<<2)  //4:PHP变量是没有显式的在PHP脚本中定义的，不是直接在代码通过$var_name定义的。这个类型最常见的例子是PHP函数的返回值
#define IS_UNUSED   (1<<3)  //8:表示操作数没有用
#define IS_CV       (1<<4)  //16:PHP脚本变量，即脚本里通过$var_name定义的变量，这些变量是编译阶段确定的
#define EXT_TYPE_UNUSED (1<<5) //32:用于return返回值，没有被接受
```

<br>

**5.handler处理函数**

>handler为每条opcode对应的C语言编写的处理过程,opcode的处理过程有三种不同的提供形式：CALL、SWITCH、GOTO，默认方式为CALL

```
CALL:把每种opcode负责的工作封装成不同的function，然后执行器循环调用执行
SWITCH:把所有的处理方式写到一个switch下，然后通过case不同的opcode执行具体的操作
GOTO:把所有opcode的处理方式通过C语言里面的label标签区分开，然后执行器执行的时候goto到相应的位置处理
```

>确定handler:opcode的数值各不相同，同时可以根据两个zend_op的类型设置不同的处理handler，因此每个opcode指令最多有25个对应的处理handler，所有的handler按照opcode数值的顺序定义在一个大数组中:zend_opcode_handlers，每25个为同一个opcode，共有173组

```
static const int zend_vm_decode[] = {
            _UNUSED_CODE, /* 0              */
            _CONST_CODE,  /* 1 = IS_CONST   */
            _TMP_CODE,    /* 2 = IS_TMP_VAR */
            _UNUSED_CODE, /* 3              */
            _VAR_CODE,    /* 4 = IS_VAR     */
            _UNUSED_CODE, /* 5              */
            _UNUSED_CODE, /* 6              */
            _UNUSED_CODE, /* 7              */
            _UNUSED_CODE, /* 8 = IS_UNUSED  */
            _UNUSED_CODE, /* 9              */
            _UNUSED_CODE, /* 10             */
            _UNUSED_CODE, /* 11             */
            _UNUSED_CODE, /* 12             */
            _UNUSED_CODE, /* 13             */
            _UNUSED_CODE, /* 14             */
            _UNUSED_CODE, /* 15             */
            _CV_CODE      /* 16 = IS_CV     */
};
handler=zend_opcode_handlers[opcode * 25 + zend_vm_decode[op->op1_type] * 5 + zend_vm_decode[op->op2_type]];
```

<br>

**6.抽象语法树->Opcodes**

```
void zend_compile_top_stmt(zend_ast *ast){
    ....
    if (ast->kind == ZEND_AST_STMT_LIST) { //第一次进来一定是这种类型
        zend_ast_list *list = zend_ast_get_list(ast);
        uint32_t i;
        for (i = 0; i < list->children; ++i) {
            zend_compile_top_stmt(list->child[i]);//list各child语句相互独立，递归编译
        }
        return;
    }
    //各语句编译入口
    zend_compile_stmt(ast);
    ....
}

void zend_compile_stmt(zend_ast *ast){
    CG(zend_lineno) = ast->lineno;
    switch (ast->kind) {
        case ZEND_AST_ECHO:
            zend_compile_echo(ast);
            break;
	           ...
        default:
        {
            znode result;
            zend_compile_expr(&result, ast);
            zend_do_free(&result);
        }
    }
    ...
}

1.zend_compile_top_stmt接收语法树，首先判断节点类型是否为ZEND_AST_STMT_LIST(表示当前节点下
有多个独立的节点),若是则进行递归
2.当递归结束后，调用zend_compile_stmt进行编译成zend_op_array
```

```
实例:
$a = 123;
$b = "hi~";

echo $a,$b;
```

```
//给变量编号(96是根据zend_execute_data大小计算得出)
#define ZEND_CALL_FRAME_SLOT \
    ((int)((ZEND_MM_ALIGNED_SIZE(sizeof(zend_execute_data)) + ZEND_MM_ALIGNED_SIZE(sizeof(zval)) - 1) / ZEND_MM_ALIGNED_SIZE(sizeof(zval))))

#define ZEND_CALL_VAR_NUM(call, n) \
    (((zval*)(call)) + (ZEND_CALL_FRAME_SLOT + ((int)(n))))

static int lookup_cv(zend_op_array *op_array, zend_string* name){
    int i = 0;
    //遍历op_array.vars检查此变量是否已存在
    while (i < op_array->last_var) {
        if (ZSTR_VAL(op_array->vars[i])==ZSTR_VAL(name)) {
            return (int)(zend_intptr_t)ZEND_CALL_VAR_NUM(NULL, i);////返回的是96 + i*sizeof(zval)
        }
        i++;
    }

    //这是一个新变量
    i = op_array->last_var;
    op_array->last_var++;
    op_array->vars[i] = zend_new_interned_string(name);
    return (int)(zend_intptr_t)ZEND_CALL_VAR_NUM(NULL, i); //返回的是96 + i*sizeof(zval)
}
```

>注意：这里变量的编号从0、1、2、3...依次递增的，但是实际使用中并不是直接用的这个下标，而是转化成了内存偏移量offset，这个是ZEND_CALL_VAR_NUM宏处理的，所以变量偏移量实际是96、112、128...递增的

![](./img/17.png)

```
pass_two()主要有两个重要操作：

1.将IS_CONST、IS_VAR、IS_TMP_VAR类型的操作数、返回值转化为内存偏移量，其中IS_CONST(zend_op_array->literals)类型起始值为0，然后
按照编号依次递增sizeof(zval)，而IS_VAR、IS_TMP_VAR(zend_op_array->vars)唯一的不同时它的初始值接着IS_CV
2.另外一个重要操作就是设置各指令的处理handler
```

![](./img/18.png)
