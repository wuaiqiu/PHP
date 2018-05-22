#include <iostream>
using namespace std;

/*
 * 运算符重载
 *
 * 	 1.输入/输出运算符重载:习惯上人们是使用"cin>>"和"cout<<"的，使用友元函数来重载运算符，
 * 如果使用成员函数来重载会出现"d1<<cout"，这种不自然的代码
 *	 2.=,[],(),->:必须在成员函数
 * */

class Person{
public:
	int age;
	int arr[3]={1,2,3};
	//一元运算符重载
	int operator-(){
		return -(this->age);
	}
	//二元运算符重载
	int operator+(Person &b){
	   return (this->age+b.age);
	}
	//关系运算符重载
	int operator>(Person &b){
	   return (this->age-b.age);
	}
	//输入/输出运算符重载
	friend ostream& operator<<(ostream& out,Person &a);
	friend istream& operator<<(istream& in,Person &a);
	//++运算符重载(后缀与前缀)
	int operator++(){
	   return (this->age+1);
	}
	int operator++(int){
		return (this->age+1);
	}
	//赋值运算符重载
	int operator=(Person &b){
		this->age=b.age;
		return this->age;
	}
	//函数调用运算符 () 重载
	void operator()(){
		cout<<"Person[age:"<<this->age<<"]"<<endl;
	}
	//下标运算符 [] 重载
	int operator[](int index){
		return this->arr[index];
	}
};

ostream& operator<<(ostream& out,Person &a){
	out<<a.age<<endl;
	return out;
}

istream& operator>>(istream& in,Person &a){
	in>>a.age;
	if(in.fail()){
		cout<<"fail"<<endl;
	}
	return in;
}