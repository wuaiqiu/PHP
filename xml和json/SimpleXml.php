<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>SimpleXml</title>
</head>

    <body>
    
    <?php
    
    
    
      /*
      * 加载并解析xml
      * */
    
        $xml=simplexml_load_file("note.xml");
        print_r($xml);
        
       /*
        SimpleXMLElement Object ( 
                [to] => Tove 
                [from] => Jani 
                [heading] => Reminder 
                [body] => Don't forget me this weekend! 
         )
	   */
        
        
        
        
        /*
         *  遍历
         *  getName() 函数返回 XML 元素的名称。
         *  children() 函数查找指定节点的所有子节点。
         * */
        
        foreach($xml->children() as $child){
            echo $child->getName() . ": " . $child . "<br>";
        }
        
        /*
            to: Tove
            from: Jani
            heading: Reminder
            body: Don't forget me this weekend!
        */
        
	?>
    </body>
</html>