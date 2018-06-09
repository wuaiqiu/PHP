<?php

/*
 * 哈希一致性算法:
 *  1.将value映射到一个32位的key值，即是0~2^32-1次方的数值空间----环
 *  2.将需要缓存的对象通过hash转成数值空间的某个点
 *  3.将cache服务器做n个虚拟节点，虚拟节点的key可以通过ip+序列或主机名+序列，通过同样的hash算法映射到数值空间上
 *  4.将key<=nodeKey的值放在node上
 * */

class ConsistentHashing{

    //每台主机的虚拟节点数
    protected $replicate = 0;
    //每台主机的虚拟节点数组
    protected $nodes = [];
    //虚拟节点在数值空间上的位置
    public $cachePosition = [];

    public function __construct($replicate = 3){
        $this->replicate = $replicate;
    }

    //hash算法
    public static function hash($key){
        return (int)sprintf("%u", crc32($key));
    }

    //添加虚拟节点
    public function addNode($node){
        if (strlen($node) < 1) {
            return false;
        }
        for ($i = 1; $i <= $this->replicate; $i++) {
            $positionKey = self::hash($node . $i);
            $this->nodes[$node][] = $positionKey;
            $this->cachePosition[$positionKey] = $node;
        }
        return true;
    }

    //删除虚拟节点
    public function delNode($node){
        if (strlen($node) < 1) {
            return false;
        }
        $failedPosition = $this->nodes[$node];
        unset($this->nodes[$node]);
        foreach ($failedPosition as $item) {
            unset($this->cachePosition[$item]);
        }
        return true;
    }


    //查找key所在的主机
    public function lookUp($key){
        if (strlen($key) < 1) {
            return false;
        }
        $key = self::hash($key);
        ksort($this->cachePosition);
        foreach ($this->cachePosition as $position => $node) {
            if ($key <= $position) {
                return $node;
            }
        }
        return current($this->cachePosition);
    }
}


//记录每个主机的命中次数
$hits = [
    "192.168.1.1" => 0,
    "192.168.1.2" => 0,
    "192.168.1.3" => 0,
];
$server = new ConsistentHashing(1000);
$server->addNode("192.168.1.1");
$server->addNode("192.168.1.2");
$server->addNode("192.168.1.3");
for ($i = 0; $i < 100000; $i++) {
    $hits[$server->lookUp((string)(rand(0, 9999) . time()))] += 1;
}
print_r($hits);