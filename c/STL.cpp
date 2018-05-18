#include <iostream>
#include <vector>
#include <list>
#include <map>
using namespace std;

/*
 *容器<vector>,<deque>,<list>,<set>,<multset>,<map>,<multimap>
 *		a.序列式容器:每个元素都有固定位置,取决于插入时机和地点，和元素值无关
 *			Vector：栈结构，可以随机存取元素（用索引直接存取），数组尾部添加或移除元素非常快速。但是在中部或头部安插元素比较费时；
 *			Deque：双端列队，可以随机存取元素（用索引直接存取），数组头部和尾部添加或移除元素都非常快速。但是在中部或头部安插元素比较费时；
 *			List：双向链表，不提供随机存取（按顺序走到需存取的元素，O(n)），在任何位置上执行插入或删除动作都非常迅速，内部只需调整一下指针；
 *		b.关联式容器:元素位置取决于特定的排序准则，和插入顺序无关
 *			Set:内部的元素依据其值自动排序，Set内的相同数值的元素只能出现一次，
 *			Multiset:内可包含多个数值相同的元素，内部由二叉树实现，便于查找；
 *			Map:Map的元素是成对的键值/实值，内部的元素依据其值自动排序，Map内的相同数值的元素只能出现一次
 *			Multimap:内可包含多个数值相同的元素，内部由二叉树实现，便于查找；
 * */

void verctorDemo(){
	vector<int> arr; //声明
	arr.push_back(2); //进栈
	arr.pop_back();//出栈
	arr.insert(arr.begin()+3,5); //插入元素
	arr.erase(arr.begin()); //删除某个元素
	arr.erase(arr.begin(),arr.end()-1); //删除某个区间的元素
	arr.clear(); //清空所有元素
	arr.size();	//元素的个数
	arr.empty(); //元素是否为空
	arr.begin(); //返回iterator类型
	arr.end(); //范湖iterator类型
	arr.front();//返回int类型
	arr.back();//返回int类型
	for(vector<int>::iterator it=arr.begin();it!=arr.end();it++) //迭代
		    cout<<*it<<endl;
}

void listDemo(){
	list<int> arr;
	arr.push_back(10);  //末尾添加值
	arr.pop_back();  //删除末尾值
	arr.insert(arr.begin(),3);   //从指定位置插入3
	arr.erase(arr.begin(),arr.end());  //删除元素
	arr.clear(); //清空值
	arr.size();  //含有元素个数
	arr.empty();    //判断为空
	arr.rbegin(); //返回第一个元素的前向指针
	arr.begin();  //返回首值的迭代器
	arr.end();  //返回尾值的迭代器
	arr.front();   //返回第一个元素的引用
	arr.back();    //返回最后一个元素的引用
	arr.reverse();  //反转
	arr.sort();  //排序
	arr.unique(); //删除相邻重复元素
	arr.remove(2); //删除指定的值的元素
	for(list<int>::iterator it = arr.begin();it != arr.end();it++){
	       cout<<*it;
	}
}

void mapDemo(){
	 map<int,string> map1;
	 map1[3] = "Saniya";//添加元素
	 map1.insert(map<int,string>::value_type(2,"Diyabi"));//插入元素
	 map1.erase(3);                         //根据key删除value
	 map1.size();                       //元素个数
	 map1.empty();                       //判断空
	 map1.clear();                      //清空所有元素
	 for(map<int,string>::iterator iter = map1.begin();iter!=map1.end();iter++){
		       int key = iter->first;
		       string value = iter->second;
	}
}