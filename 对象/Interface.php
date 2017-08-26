<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>接口</title>
</head>

    <body>
     <?php
     /*
      * 接口：只有接口抽象方法与接口常量
      *     interface 接口名{
      *         接口常量;
      *         接口抽象方法;
      *     }
      *     
      * 1.接口常量访问 
      *       接口名 :: 接口常量
      *   
      *  2.接口抽象方法不需要abstract修饰，不需要访问控制符的修饰
      * */
     interface Player{
         function stop();
         function start();
     }
     
     interface USBset{
         const width=2;
         const height=3;
         function datein();
     }
     
     
     class MP3 implements Player,USBset{
         function stop(){
             echo "<br/>重写stop方法";
         }
         
         function start() {
             echo "<br/>重写start方法";
         }
         
         function datein() {
             echo "<br/>width => ".USBset::width;
             echo "<br/>height => ".USBset::height;
             echo "<br/>重写datein方法";
         }
         
         
     }
     
     $obj = new MP3();
     $obj->start();    
     $obj->datein();
     $obj->stop();
     
     /* 
     重写start方法
     width => 2
     height => 3
     重写datein方法
     重写stop方法
      */
    ?>
    </body>
</html>