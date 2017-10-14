<?php
//--------------------------SimpleXml------------------------------------------------//

/*
 * 基于树的解析器
 * 
 * 
 *     simplexml_load_file(file):把XML文档载入对象中，返回SimpleXmlElement对象
 *     $xml->children():返回指定节点的所有子节点
 *     $xml->asXML():以字符串的形式显示xml文档
 *     $child->getName():获取XML元素的名称
 *     $child->attributes():获取XML元素的所有属性
 *     $child->addAttribute(name,value):给 XML 元素添加一个属性
 *     $child->addChild(name,value):给 XML 节点添加一个子节点
 *  
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


//-----------------------------DOM 解析器---------------------------------------//
  /*
   * 基于树的解析器
   *    
   *    方法：
   *    new DOMDocument():实例化DOMDocument对象
   *    $xml->load(path):导入指定位置的XML文档
   *    $xml->getElementsByTagName(name):返回指定名字的元素集合
   *    $xml->createElement(name):创建一个元素节点并返回
   *    $child->appendChild(child):为当前节点添加一个新的子节点,放在最后的子节点后
   *    $xml->removeChild(child):从子结点列表中删除指定的子节点
   *    $xml->save(path):把XML文件存到指定path
   *    $xml->saveXML():以字符串的形式显示xml文档
   *    $child->setAttribute(name,value):给 XML 元素添加一个属性
   *    
   *    
   *    
   *    属性：
   *    $xml->documentElement：返回文档的根元素
   *    $child->childNodes：指定节点的子节点列表
   *    $child->nodeValue:返回节点的文本
   *    $child->nodeType:返回节点的类型
   *    $child->nodeName:返回节点的名字
   *    $child->Attributes:返回节点的属性列表
   *    
   * */
        
     
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
        
//---------------------------Expat--------------------------------------//

    /*
     * 基于事件的解析器
     * 
     * 1.创建XML解析器
     *      xml_parser_create()：创建XML解析器，返回parser
     *      xml_set_element_handler($parser,start,end):规定在 XML 文档中元素的起始和终止调用的函数
     *      xml_set_character_data_handler($parser,handler):为 XML 解析器建立字符数据处理器
     * 
     * 2.解析XML
     *      xml_get_error_code($parser)：函数获取 XML 解析器错误代码。返回errorcode对象
     *      xml_error_string($errorcode)：函数获取 XML 解析器的错误描述。  
     *      xml_get_current_line_number($parser)：函数获取 XML 解析器的当前行号。
     *      xml_parse($parser,$xml,$end)：解析 XML 文档,$end是否为文档结尾
     * 
     * 3.释放XML解析器
     *      xml_parser_free($parser):释放 XML 解析器
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

        $parser=xml_parser_create();
        xml_set_element_handler($parser,"start","stop");
        xml_set_character_data_handler($parser,"char");
        $fp=fopen("note.xml","r");
         while ($data=fread($fp)){
            xml_parse($parser,$data,feof($fp))  or  die (xml_error_string(xml_get_error_code($parser)));
        }
        xml_parser_free($parser);
        

        /*
         -- Note --
        To: Tove
        From: Jani
        Heading: Reminder
        Message: Don't forget me this weekend!
        */

?>