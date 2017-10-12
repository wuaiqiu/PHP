<?php
/*
 * 建立连接
 *      $redis = new Redis();
 *      $redis->connect('127.0.0.1',6379,1);//短链接，本地host，端口为6379，超过1秒放弃链接
 *      $redis->open('127.0.0.1',6379,1);//短链接(同上)
 *      $redis->pconnect('127.0.0.1',6379,1);//长链接，本地host，端口为6379，超过1秒放弃链接
 *      $redis->popen('127.0.0.1',6379,1);//长链接(同上)
 *      $redis->close();//释放资源
 *
 *
 * String类型方法
 *       $redis->set('key',1);
 *       $redis->mset($arr);
 *       $redis->setnx('key','value');
 *       $redis->get('key');
 *       $redis->mget($arr);
 *       $redis->delete($key_str,$key2,$key3);
 *       $redis->getset('old_key','new_value');
 *       $redis->strlen('key');
 *       $redis->append('key','string');
 *       $redis->incr('key');
 *       $redis->incrby('key',$num);
 *       $redis->decr('key');
 *       $redis->decrby('key',$num);
 *       $redis->setex('key',10,'value');
 * 
 * 
 * Hash类型
 *      $redis->hset('key','field','value');
 *      $redis->hget('key','field');
 *      $redis->hmset('key',$arr);
 *      $redis->hmget('key',$arr2);
 *      $redis->hgetall('key');
 *      $redis->hkeys('key');
 *      $redis->hvals('key');
 *      $redis->hdel('key',$arr2);
 *      $redis->hexists('key','field');
 *      $redis->hincrby('key','field',$int_num);
 *      $redis->hlen('key');
 *    
 *      
 * List类型
 *      $redis->lpush('key','value');
 *      $redis->rpush('key','value');
 *      $redis->lInsert('key', Redis::AFTER, 'value', 'new_value');
 *      $redis->lpushx('key','value');
 *      $redis->rpushx('key','value');
 *      $redis->lpop('key');
 *      $redis->rpop('key');
 *      $redis->lrem('key','value',0);
 *      $redis->ltrim('key',start,end);
 *      $redis->lset('key',index,'new_v');
 *      $redis->lindex('key',index);
 *      $redis->lrange('key',0,-1);
 *      $redis->llen('key');
 *      
 *      
 * Set类型
 *      $redis->sadd('key','value1','value2','valuen');
 *      $redis->srem('key','value1','value2','valuen');
 *      $redis->smembers('key');
 *      $redis->sismember('key','member');
 *      $redis->spop('key');
 *      $redis->srandmember('key');
 *      $redis->sinter('key1','key2','keyn');
 *      $redis->sunion('key1','key2','keyn');
 *      $redis->sdiff('key1','key2','keyn');
 *      $redis->scard('key');
 *      $redis->sMove('key1', 'key2', 'member');
 *      
 *      
 * ZSet类型
 *      $redis->zAdd('key',$score1,$member1,$scoreN,$memberN);
 *      $redis->zrem('key','member1','membern');
 *      $redis->zscore('key','member');
 *      $redis->zrange('key',$start,$stop);
 *      $redis->zrevrange('key',$start,$stop);
 *      $redis->zrangebyscore('key',$min,$max[,$config]);
 *      $redis->zrevrangebyscore('key',$max,$min[,$config]);
 *      $redis->zrank('key','member');
 *      $redis->zrevrank('key','member');
 *      $redis->ZINTERSTORE();
 *      $redis->ZUNIONSTORE();
 *      $redis->zcard('key');
 *      $redis->zcount('key',0,-1);
 * 
 * 
 * Key
 *      $redis->ttl('key');
 *      $redis->persist('key');
 *      $redis->expire('key',10);
 *      $redis->move('key',15);
 *    
 * 
 * Server
 *      $redis->dbSize();
 *      $redis->flushAll();
 *      $redis->flushDB();
 *      $redis->info();
 *      $redis->select(0);
 *      $redis->ping();
 * 
 * 
 * Affair
 *      $redis->watch('key','keyn');
 *      $redis->unwatch('key','keyn');
 *      $redis->multi(Redis::MULTI);
 *      $redis->exec();
 * */