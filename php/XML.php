<?php

//--------------------------SimpleXml------------------------------------------------//

     /*
      * 1.加载并解析xml
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
         * 2.遍历
         *  getName() 函数返回 XML 元素的名称。
         *  children() 函数查找指定节点的所有子节点。
         * */
        $xml=simplexml_load_file("note.xml");
        foreach($xml->children() as $child){
            echo $child->getName() . ": " . $child . "<br>";
        }
        
        /*
            to: Tove
            from: Jani
            heading: Reminder
            body: Don't forget me this weekend!
        */	


//---------------------------Expat--------------------------------------//


	 /*
         * 
         *  1. 有两种基本的 XML 解析器类型：
         *       a.基于树的解析器：这种解析器把 XML 文档转换为树型结构。它分析整篇文档，并提
         *       供了对树中元素的访问，例如文档对象模型 (DOM)。
         *       b.基于事件的解析器：将 XML 文档视为一系列的事件。当某个具体的事件发生时，
         *       解析器会调用函数来处理。
         *  
         *  2.Expat 解析器是基于事件的解析器。
         * */
    

        
        //重写开始标签方法,注意获取$element_name为大写；$element_attrs为标签属性数组
        function start($parser,$element_name,$element_attrs){
            
            switch($element_name){
                case "NOTE":
                    echo "-- Note --<br>";
                    break;
                case "TO":
                    echo "To: ";
                    break;
                case "FROM":
                    echo "From: ";
                    break;
                case "HEADING":
                    echo "Heading: ";
                    break;
                case "BODY":
                    echo "Message: ";
                }
        }
 
           
    
         //重写结束标签方法
        function stop($parser,$element_name){
                echo "<br>";
        }
    
    
         //重写文本内容方法
         function char($parser,$data){
                echo $data;
        }
        
        
        
        
        //初始化parser解析器
        $parser=xml_parser_create();
    
        //定义标签方法
        xml_set_element_handler($parser,"start","stop");
    
        //定义内容方法
        xml_set_character_data_handler($parser,"char");
    
        //打开文件
        $fp=fopen("note.xml","r");
    
        //解析xml
        //fread( resource $handle , int $length )读取数据 
	//feof($handle):是否为文档结尾
        //xml_error_string(errorcode) 函数获取 XML 解析器的错误描述。
        //xml_get_error_code($parser) 函数获取 XML 解析器错误代码。
        //xml_get_current_line_number($parser) 函数获取 XML 解析器的当前行号。
        //xml_parse($parser,$xml,$end)解析 XML 文档,$end是否为文档结尾
        while ($data=fread($fp,4096)){
            xml_parse($parser,$data,feof($fp)) or
            die (xml_error_string(
                    xml_get_error_code($parser)
                )
            );
        }
    

        //释放parser
        xml_parser_free($parser);
        

        /*
         -- Note --
        To: Tove
        From: Jani
        Heading: Reminder
        Message: Don't forget me this weekend!
        */


//-----------------------------DOM 解析器---------------------------------------//

	//加载和输出 XML 字符串
        
        $xmlDoc = new DOMDocument();        //实例化
        $xmlDoc->load("note.xml");          //加载xml文件
        echo $xmlDoc->saveXML();    //输出xml字符串
    
        #Tove Jani Reminder Don't forget me this weekend!
       
        
        
        
        //遍历 XML
        $xmlDoc = new DOMDocument();
        $xmlDoc->load("note.xml");
        
        $x = $xmlDoc->documentElement;	//获取html元素
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