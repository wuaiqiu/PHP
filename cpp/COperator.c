#include <iostream>
using namespace std;

/*
 * 运算符重载
 *		=,[],(),->   	 必须在类内
 *		输出流，输入流	 必须在类外
 * */

class Person{
public:
	int age;
	//类内运算符重载(一元)
	int operator-(Person &a){
		return (-a.age);
	}
	//类内运算符重载(二元)
	int operator+(Person &b){
		return (this->age+b.age);
	}
	//类内运算符(=)
	int operator=(Person &b){
		this->age=b.age;
		return this->age;
	}
};

//类外运算符重载(一元)
int operator-(Person &a){
	return (-a.age);
}

//类外运算符重载(二元)
int operator+(Person &a,Person &b){
	return (a.age+b.age);
}

//类外IO重载
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