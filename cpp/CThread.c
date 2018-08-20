#include <iostream>
#include <thread>
#include <chrono>
#include <mutex>
#include <condition_variable>
#include <atomic>
#include <future>

using namespace std;

/*
 * C++11线程操作:
 *   thread thread(fn,args):创建一个线程(新的线程所执行的代码;新的线程的参数)
 *	 thread::id get_id():获得线程自身的ID
 *	 void join():等待线程结束
 *	 void detach():分离一个线程
 *   void sleep_for():线程睡眠
 *   bool joinable():判断线程是否为分离线程
 * */
void deal1(){
	this_thread::sleep_for(chrono::seconds(5));
	printf("%lu: This is Thread1 stoping\n",this_thread::get_id());
}

void deal2(){
	printf("%lu: This is Thread2 stoping\n",this_thread::get_id());
}

int  main(){
	thread t1(deal1);
	thread t2(deal2);
	t1.join();
	t2.join();
	return 0;
}



/*
 * C++11互斥锁:
 *	 void lock():加互斥锁
 *	 void unlock():释放互斥锁
 *   lock_guard<mutex> lock_guard(mutex m):RAII型互斥锁
 *   unique_lock<mutex> unique_lock(mutex m):RAII型互斥锁,可以控制锁
 * */
mutex mtx;
int lock_var;

void deal1(){
	lock_guard<mutex> lock(mtx);
	for(int i=0;i<10;i++){ 
		lock_var++;
	}
}

void deal2(){
	lock_guard<mutex> lock(mtx);
	for(int i=0;i<10;i++){
		lock_var++;
	}
}

void deal3(){
	unique_lock<mutex> lock(mtx);
	lock.unlock();
	this_thread::sleep_for(chrono::seconds(5));
	lock.lock();
	cout<<"deal1"<<endl;
	lock_var++;
	lock.unlock();
}

void deal4(){
	unique_lock<mutex> lock(mtx);
	cout<<"deal2"<<endl;
	lock_var++;
}

int  main(){
	thread t1(deal1);
	thread t2(deal2);
	t1.join();
	t2.join();
	cout<<lock_var<<endl;
	return 0;
}



/*
 * C++11条件变量:
 *	void wait(unique_lock<mutex> lock):检查条件，判端是否阻塞
 *  void notify_one():唤醒一个阻塞的线程
 *	void notify_all():唤醒所有阻塞的线程
 * */
mutex m;
condition_variable cond_var;
int count = 0;

void deal1(){
	unique_lock<mutex> lock(m);
	printf("Thread1 get lock \n");
	if(count==0){
		printf("Thread1 is wating \n");
		cond_var.wait(lock);
		printf("Thread1 get lock again \n");
	}
	count--;
	printf("Thread1 unlock\n");
}

void deal2(){
	unique_lock<mutex> lock(m);
	printf("Thread2 get lock \n");
	if(count==0){
		printf("Thread2 is signal \n");
		cond_var.notify_one();
	}
	count++;
	printf("Thread2 unlock\n");
}

int  main(){
 	thread t1(deal1);
 	thread t2(deal2);
 	t1.join();
 	t2.join();
	return 0;
}



/*
 * C++11之atomic对象:(无锁实现同步)
 *  1.atomic_flag对象
 *  atomic_flag atomic_flag(ATOMIC_FLAG_INIT):初始化atomic_flag对象
 *  test_and_set():判断atomic_flag是否设置(同一时间内只能被一个线程设置)
 *  clear():清除atomic_flag
 *
 *  2.atomic对象
 *   atomic<T> atomic(T value):初始化atomic对象
 *   void store(T value,memory_order_relaxed):写入值
 *   T load(memory_order_relaxed):读取值
 * */
//1.atomic_flag对象
int lock_var;
atomic_flag locks = ATOMIC_FLAG_INIT;

void deal1(){
	while (locks.test_and_set());
	for(int i=0;i<10;i++){ 
		lock_var++;
	}
	locks.clear();
}

void deal2(){
	while (locks.test_and_set());
	for(int i=0;i<10;i++){
		lock_var++;
	}
	locks.clear();
}

int  main(){
 	thread t1(deal1);
 	thread t2(deal2);
 	t1.join();
 	t2.join();
 	cout<<lock_var<<endl;
	return 0;
}


//2.atomic对象
atomic<int> foo (0);

void deal1(int x){
  foo.store(x,memory_order_relaxed);
}

void deal2(){
   int x;
   do {
     x = foo.load(memory_order_relaxed);
   } while (x==0);
   cout << "foo: " << x << endl;
}

int  main(){
 	thread t1(deal1,2);
 	thread t2(deal2);
 	t1.join();
 	t2.join();
	return 0;
}



/*
 * C++11之future对象:
 *  T get():阻塞等待获取value
 *  share_future<T> share():返回share_future(复制future)对象
 *  void wait():阻塞等待value
 *
 *
 *  1.promise对象
 *  promise<T> promise():初始化promise对象(将值与future绑定起来)
 *  get_future():获取future对象
 *  set_value(T v):设置value,立即唤醒被阻塞的线程
 *  set_value_at_thread_exit(T v):设置value,等本线程执行完后唤醒被阻塞的线程
 *
 *  2.packaged_task对象
 *  packaged_task<ret(args)> packaged_task(fn):初始化packaged_task对象(将函数与future绑定起来)
 *  get_future():获取future对象
 *  reset():重置future对象
 *  operator(args):直接执行task
 *
 *  3.async函数
 *  future<T> async(fn):创建future对象(由系统决定)
 *  future<T> async(launch::deferred|async,fn):创建future对象(deferred:延迟启动线程)
 * */
//1.promise对象
void func (future<int>& f) {
  int x = f.get();
  cout << "value: " << x << endl;
}

int main ()
{
  promise<int> prom;
  future<int> fut = prom.get_future();
  thread t (func, ref(fut));
  prom.set_value (10);
  t.join();
  return 0;
}


//2.packaged_task对象
int func () {
  this_thread::sleep_for(chrono::seconds(5));
  return 9;
}

int main ()
{
  packaged_task<int()> task(func);
  thread t (ref(task));
  future<int> fut = task.get_future();
  cout<<fut.get()<<endl;
  t.join();
  task.reset();
  task();
  fut=task.get_future();
  cout<<fut.get()<<endl;
  return 0;
}


//3.async函数
int func () {
  this_thread::sleep_for(chrono::seconds(5));
  return 9;
}

int main ()
{
  future<int> fut = async(launch::deferred,func);
  cout<<fut.get()<<endl;
  return 0;
}
