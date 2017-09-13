<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>文件上传</title>
</head>

    <body>
    <form action="" method="post" enctype="multipart/form-data">
	<label for="file">文件名：</label>
	<input type="file" name="file" id="file"><br>
	<input type="submit" name="submit" value="提交">
	</form>
    	
    <?php
    
    if ($_FILES["file"]["error"] > 0)
    {
        echo "错误：" . $_FILES["file"]["error"] . "<br>";//由文件上传导致的错误代码
    }
    else
    {
        echo "上传文件名: " . $_FILES["file"]["name"] . "<br>";//上传文件的名称
        echo "文件类型: " . $_FILES["file"]["type"] . "<br>";//上传文件的类型
        echo "文件大小: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";//上传文件的大小，以字节计
        echo "文件临时存储的位置: " . $_FILES["file"]["tmp_name"];//存储在服务器的文件的临时位置
        
       
           
        if (file_exists("./" . $_FILES["file"]["name"]))   //判断文件是否存在
        {
            echo "<br/>".$_FILES["file"]["name"] . " 文件已经存在。 ";
        }
        else
        {
            // 如果 不存在该文件则将文件上传
            move_uploaded_file($_FILES["file"]["tmp_name"], "./" . $_FILES["file"]["name"]);
            echo "<br/>文件存储在: " . "./" . $_FILES["file"]["name"];
        }
        
        
    }
    ?>
    </body>
</html>
