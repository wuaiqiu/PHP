<?php
//-------------------------------------操作文件-------------------------------//
/*
 *  file_get_contents(path):把整个文件读入一个字符串中
 *  file_put_contents(path,data):把一个字符串写入文件中
 *  file_exists(path):检查文件或目录是否存在
 *  copy(sourcePath,destinationPath):拷贝文件
 *  dirname(path)：返回路径中的目录部分
 *  filesize(path):返回文件的大小
 *  mkdir(path):创建目录
 *  rmdir(path):删除空目录
 *  unlink(path）:删除文件
 * */



//-------------------------------------读取文件--------------------------------//
 	
	    /*
         * 1.打开文件，返回file对象
         *  fopen("fileName","mode")
         *      
         *      模式	描述
         *      r	只读。在文件的开头开始。
         *      r+	读/写。在文件的开头开始。
         *      w	只写。打开并清空文件的内容；如果文件不存在，则创建新文件。
         *      w+	读/写。打开并清空文件的内容；如果文件不存在，则创建新文件。
         *      a	追加。打开并向文件末尾进行写操作，如果文件不存在，则创建新文件。
         *      a+	读/追加。通过向文件末尾写内容，来保持文件内容。
         * 
         * 2.读取文件
         *   is_readable($file)	判断文件是否可读。	
         *   feof($file):当读完文件返回true
         *   fgets($file):逐行读取
         *   fgetc($file)：逐个字符读取
         *   
         * 3.关闭文件
         *   fclose($file)
         */
    
           
           $file=fopen("welcome.txt","r");
            
           if($file){     
                while(!feof($file)){
                    echo fgets($file). "<br>";
                }
            }else{
                echo "文件打开失败";
            }
  
            fclose($file);


//------------------------------------写入文件--------------------------------//

            /*
             * 1.写入文件
             *     is_writable($file):判断文件是否可写。
             *     fwrite($file,data):写入文件
             *     fflush($file):将缓冲内容输出到文件。
             *     
             * */
            
	 
         $file=fopen("welcome.txt","a");
         
         if($file){
              $string="this is file";
             fwrite($file, $string);
         }else{
             echo "文件打开失败";
         }

         fclose($file);


//-----------------------------上传文件----------------------------------------//
/*
 * move_uploaded_file($file,newPath):函数将上传的文件移动到新位置
 *  
 * */
         
/*
 * $_FILES数组：可以从客户计算机向远程服务器上传文件
 *  array(1) {
 *          ["file"]=>array(5) {
 *                  ["name"]=>string(11) "welcome.txt"
 *                  ["type"]=>string(10) "text/plain"
 *                  ["tmp_name"]=>string(14) "/tmp/php3TN6DB"
 *                  ["error"]=>int(0)
 *                  ["size"]=>int(3)
 *                  }
 *           }
 * */
	


    if ($_FILES["file"]["error"] > 0){
        echo "错误：" . $_FILES["file"]["error"] . "<br>";		//由文件上传导致的错误代码
    }else{
        echo "上传文件名: " . $_FILES["file"]["name"] . "<br>"; 		//上传文件的名称
        echo "文件类型: " . $_FILES["file"]["type"] . "<br>";		//上传文件的类型
        echo "文件大小: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";//上传文件的大小，以字节计
        echo "文件临时存储的位置: " . $_FILES["file"]["tmp_name"];		//存储在服务器的文件的临时位置
        
       
           
     if (file_exists("./" . $_FILES["file"]["name"])){ 
            echo "<br/>".$_FILES["file"]["name"] . " 文件已经存在。 ";
     }else{
            move_uploaded_file($_FILES["file"]["tmp_name"], "./" . $_FILES["file"]["name"]);
            echo "<br/>文件存储在: " . "./" . $_FILES["file"]["name"];
        }
    }


//-----------------------------下载文件---------------------------------------//

    /*
     * readlink(linkpath):返回绝对路径
     * readfile(filename):输出一个文件
     * */
    
	function downfile(){
    		$filename=realpath("./welcome.txt");
    		header( "Content-type:  application/form-data");
    		header( "Content-Disposition:  attachment;  filename= welcome.txt");
    		readfile($filename);
	}
	downfile();


//-----------------------------加载文件----------------------------------------//
	
	/*
	 * 加载文件:
	 * 1.include , require , include_once , require_once
	 * 2.使用方式:
	 *          include "文件路径";
	 *          include("文件路径");
	 * 3.require与include的区别:
	 *      require:加载文件失败时,报错并停止执行后面的代码
	 *      include:加载文件失败时,报错并继续执行后面的代码
	 *
	 * 4.include与include_once
	 *       include_once:在include的基础上进行载入文件重复性检查
	 *
	 * 5.相对路径：在被include的文件中又有include，注意相对位置，以入口文件为相对点
	 * 
	 * 6.非确定路径:不是以"."或"/"开头的路径，首先会在include_path系统库中查找所需类文件，
	 * 没找到则以相对路径查看
	 * */    

	
//--------------------------------加载类文件--------------------------------//
	
	/*
   	 * 一.自动加载类 __autoload($className)
   	 *   当某行代码需要某个类的时候，php会自动按需加载某个类
   	 *   注意需要加载的类文件名与类名相同
   	 * */
   	
   	function __autoload($className){
   	    require_once "./{$className}.php";
   	}
   	
   	//当new出一个对象时,会自动加载相应的类
   	$obj = new LoadClass();
   	



	/*
   	  * 二.自定义加载类
   	  *     自动加载类只能满足个人开发加载文件
   	  *     自定义加载类可以满足团队开发（每个人有自己的加载类）
   	  *     自定义加载类会按顺序依次查找，直到找到
   	  *     
   	  *  定义形式
   	  *     spl_autoload_register("函数1"); //声明"函数1"为加载类
   	  *     spl_autoload_register("函数2"); //声明"函数2"为加载类
   	  *     ....
   	  *     
   	  *     function 函数1($className){
   	  *         //与__autoload($className)作用相同
   	  *     }
   	  *     
   	  *     function 函数2($className){
   	  *         //与__autoload($className)作用相同
   	  *     }
   	  *     
   	  *     ....
   	  * */
   	
   	    spl_autoload_register("loadFun");
   	    spl_autoload_register("loadFun2");
   	    
   	    function loadFun($className){
   	        echo "<br/>准备在loadFun中加载文件";
   	        $file="./class/{$className}.php";
   	        if(file_exists($file)){
   	               require_once $file;
   	        }
   	    }
   	    
   	    function loadFun2($className){
   	        echo "<br/>准备在loadFun2中加载文件";
   	        $file="./{$className}.php";
   	        if(file_exists($file)){
   	            require_once $file;
   	        }
   	    }
   	    
   	    
   	    $obj = new LoadClass();
   	    $obj->move();
   	    
   	 /* 
   	    准备在loadFun中加载文件
   	    准备在loadFun2中加载文件
   	    这是LoadClass的move方法
   	 */


//--------------------------Output Control------------------------//

/*
 *  Output Control
 *
 *  1.bool ob_start():打开输出缓冲.当输出缓冲激活后,脚本将不会输出内容
 * (除http标头外),相反需要输出的内容被存储在内部缓冲区中
 *  2.string ob_get_contents():只是得到输出缓冲区的内容,但不清除它
 *  3.int ob_get_length():此函数将返回输出缓中冲区内容的长度
 *  4.int ob_get_level():返回输出缓冲机制的嵌套级别
 *  5.array ob_get_status(true):得到所有输出缓冲区的状态
 *  6.void ob_flush():输出并清除缓冲区中的内容
 *  7.string ob_get_flush():以字符串形式返回内容,并关闭输出缓冲区
 *  8.void ob_clean():清空输出缓冲区
 *  9.bool ob_end_clean():清空缓冲区并关闭输出缓冲
 * */


//Level 0
ob_start();
echo "Hello ";

//Level 1
ob_start();
echo "Hello World".ob_get_level();
$out2 = ob_get_contents();
ob_end_clean();

//Back to level 0
echo "Galaxy".ob_get_level();
$out1 = ob_get_contents();
ob_end_clean();

//Just output
var_dump($out1, $out2);
?>
