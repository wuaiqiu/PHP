# Start

1.编译安装

```
git clone https://github.com/swoole/PHP-X.git
cd PHP-X
cmake .
make -j 4
sudo make install
sudo ldconfig
```

2.新建工程(test.cpp)

```
#include <phpx.h>
using namespace std;
using namespace php;

//扩展编写
```

3.编译扩展

```
PHP_INCLUDE = `php-config --includes`
PHP_LIBS = `php-config --libs`
PHP_LDFLAGS = `php-config --ldflags`
PHP_INCLUDE_DIR = `php-config --include-dir`
PHP_EXTENSION_DIR = `php-config --extension-dir`

test.so: test.cpp
    c++ -DHAVE_CONFIG_H -g -o test.so -O0 -fPIC -shared test.cc -std=c++11 ${PHP_INCLUDE} -I${PHP_INCLUDE_DIR} -lphpx
install: test.so
    cp test.so ${PHP_EXTENSION_DIR}/
clean:
    rm *.so
```