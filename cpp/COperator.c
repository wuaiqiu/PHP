#include <iostream>
using namespace std;

/*
 * 运算符重载
 *
 *  1).不能重载的运算符有 . 和 .* 和 ?: 和 :: 和 sizeof
 *  2).只能为成员函数的运算符有 () 和 [] 和 -> 和 =
 *  3).只能为友元函数的运算符有 >> 和 <<
 * */

class Person{
public:
    int age;
    int arr[3]={1,2,3};
    explicit Person(int age):age(age){}
    //一元运算符重载(-obj)
    int operator-(){
        return -(this->age);
    }
    //二元运算符重载(obj+obj)
    int operator+(const Person &b){
        return (this->age+b.age);
    }
    //关系运算符重载(obj>obj)
    int operator>(const Person &b){
        return (this->age>b.age);
    }
    //++运算符重载(前缀++obj与后缀obj++[引入一个虚参数int])
    int operator++(){
        return (++this->age);
    }
    int operator++(int){
        return (this->age++);
    }
    //赋值运算符重载(obj=b)
    Person& operator=(const Person &b){
        this->age=b.age;
        return *this;
    }
    //函数调用运算符()重载(obj())
    void operator()(){
        cout<<"Person[age:"<<this->age<<"]"<<endl;
    }
    //下标运算符[]重载(obj[1])
    int operator[](int index){
        return this->arr[index];
    }
    //输入/输出运算符重载(out<<p,cin>>p)
    friend ostream& operator<<(ostream& out,Person &a);
    friend istream& operator>>(istream& in,Person &a);
};

ostream& operator<<(ostream& out,Person &a){
    out<<a.age;
    return out;
}

istream& operator>>(istream& in,Person &a){
    in>>a.age;
    if(in.fail()){
        cout<<"fail"<<endl;
    }
    return in;
}