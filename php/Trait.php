<?php
/*
 * Trait:公共部分的封装；无法实例化
 *
 * 1.优先级：父类的同名方法被trait所覆盖，trait同名方法被子类所覆盖
 *      父类>trait>子类
 *
 * 2.多个trait通过逗号分隔，在 use 声明列出多个 trait
 *
 * 3.冲突的解决
 *      use A, B {
 *          B::smallTalk insteadof A;
 *          A::bigTalk insteadof B;
 *          B::bigTalk as talk;
 *      }
 *
 * 4.修改方法的访问控制
 *      use HelloWorld {
 *          sayHello as protected;
 *      }
 *
 * 5.可以在trait中使用其他trait
 *
 * 6.trait可以使用抽象成员来强制class实现
 *
 * 7.trait可以定义的静态属性与方法，普通属性（子类不能定义相同的属性）
 * */
