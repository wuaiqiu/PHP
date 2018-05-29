 # TCP

 #### 一.TCP的连接建立

a).Client向Server发出连接请求报文，其首部SYN=1，seq=J，Client进入SYN-SENT状态

b).Server收到连接请求报文，如果同意连接，就发送确认报文。其首部ACK=1，ack = J+1，SYN=1，seq = K，Server进入SYN-REVD状态

c).Client收到确认报文后，还要向Server发出确认报文，其首部ACK=1，ack=K+1，SYN=1，seq=J+1，Client进入ESTABLISHED状态

d).Server收到确认报文后，Server进入ESTABLISHED状态

![](./img/7.png)

<br>

#### 二.TCP的连接释放

a).Client向Server发出连接释放报文，并停止发送数据。其首部FIN=1，seq=u，Client进入FIN_WAIT1状态

b).Server收到连接释放报文后，如果同意释放，就发送确认报文，其首部ACK=1，ack = u+1，seq=v，Server进入CLOSE-WAIT状态

c).Client收到确认报文后，进入FIN_WAIT2状态

d).Server向Client发出连接释放报文，并停止发送数据，其首部FIN=1，seq=w，ACK=1，ack=u+1，Server进入LAST-ACK状态

e).Client收到连接释放报文后，发送确认报文，其报文首部ACK=1，ack=w+1，seq=u+1，Client进入TIME-WAIT状态

f).Server收到确认报文后，进入CLOSED状态，Client等到2MSL后进入CLOSED状态

![](./img/8.png)
