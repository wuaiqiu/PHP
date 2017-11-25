<?php
/*
 * 建立连接
 *      $redis = new Redis();
 *      $redis->connect('127.0.0.1',6379,1);//短链接，本地host，端口为6379，超过1秒放弃链接
 *      $redis->open('127.0.0.1',6379,1);//短链接(同上)
 *      $redis->close();//释放资源
 *
 *
 * String类型方法
 *       $redis->set(key,value);
 *       $redis->mset(array);
 *       $redis->setnx(key,value);
 *       $redis->setex(key,10,value);
 *       $redis->get(key);
 *       $redis->mget(array);
 *       $redis->getset(key,new_value);
 *       $redis->strlen(key);
 *       $redis->append(key,string);
 *       $redis->incr(key);
 *       $redis->incrby(key,num);
 *       $redis->decr(key);
 *       $redis->decrby(key,num);
 *       $redis->getrange(key,start,end);
 *       $redis->setrange(key,start,replace_value);
 *       
 * 
 * Hash类型
 *      $redis->hset(key,field,value);
 *      $redis->hget(key,field);
 *      $redis->hmset(key,array);
 *      $redis->hmget(key,array);
 *      $redis->hgetall(key);
 *      $redis->hkeys(key);
 *      $redis->hvals(key);
 *      $redis->hdel(key,field1,...);
 *      $redis->hexists(key,field);
 *      $redis->hincrby(key,field,num);
 *      $redis->hlen(key);
 *    
 *      
 * List类型
 *      $redis->lpush(key,value);
 *      $redis->rpush(key,value);
 *      $redis->lInsert(key, Redis::AFTER, value, new_value);
 *      $redis->lpop(key);
 *      $redis->rpop(key);
 *      $redis->lrem(key,value,0);
 *      $redis->ltrim(key,start,end);
 *      $redis->lset(key,index,new_value);
 *      $redis->lindex(key,index);
 *      $redis->lrange(key,0,-1);
 *      $redis->llen(key);
 *      
 *      
 * Set类型
 *      $redis->sadd(key,value1,...);
 *      $redis->srem(key,value1...);
 *      $redis->smembers(key);
 *      $redis->sismember(key,member);
 *      $redis->spop(key);
 *      $redis->srandmember(key);
 *      $redis->sinter(key1,key2...);
 *      $redis->sunion(key1,key2...);
 *      $redis->sdiff(key1,key2...);
 *      $redis->scard(key);
 *      
 *      
 * ZSet类型
 *      $redis->zAdd(key,score1,member1,scoreN,memberN);
 *      $redis->zrange(key,start_index,end_index,true|false);
 *      $redis->zrevrange(key,start_index,end_index);
 *      $redis->zrangebyscore(key,min_score,max_score);
 *      $redis->zrank(key,member);
 *      $redis->zrevrank(key,member);
 *      $redis->zcard(key);
 *      $redis->zcount(key,mix_score,max_score);
 *      $redis->zrem(key,value1...);
 *      $redis->zremrangebyrank(key,start_index,end_index);
 *      $redis->zremrangebyscore(key,min_score,max_score);
 *
 * 
 * Key
 *      $redis->ttl(key);
 *      $redis->persist(key);
 *      $redis->expire(key,10);
 *      $redis->move(key,15);
 *      $redis->keys("*");
 *      $redis->del(key...);
 *    
 * 
 * Server
 *      $redis->dbSize();
 *      $redis->flushAll();
 *      $redis->flushDB();
 *      $redis->select(0);
 * 
 * 
 * Affair
 *      $redis->watch(key...);
 *      $redis->unwatch(key...);
 *      $redis->multi(Redis::MULTI);
 *      $redis->exec();
 * */