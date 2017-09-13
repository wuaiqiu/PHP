<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Dom</title>
</head>

    <body>
    
    <?php
        /*
         * DOM 解析器是基于树的解析器。
         * */
    
        //加载和输出 XML 字符串
        
        $xmlDoc = new DOMDocument();        //实例化
        $xmlDoc->load("note.xml");          //加载xml文件
        echo $xmlDoc->saveXML();    //输出xml字符串
    
        #Tove Jani Reminder Don't forget me this weekend!
        echo "<br/>";
        
        
        
        //遍历 XML
        $xmlDoc = new DOMDocument();
        $xmlDoc->load("note.xml");
        
        $x = $xmlDoc->documentElement;
        foreach ($x->childNodes AS $item){
            echo $item->nodeName . " = " . $item->nodeValue . "<br/>";
        }
        
        /*
        to = Tove
        from = Jani
        heading = Reminder
        body = Don't forget me this weekend!
        */  
	?>
    </body>
</html>