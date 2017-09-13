<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Expat</title>
</head>

    <body>
    
    <?php
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
    

        
        //重写开始标签方法
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
        //xml_error_string(errorcode) 函数获取 XML 解析器的错误描述。
        //xml_get_error_code($parser) 函数获取 XML 解析器错误代码。
        //xml_get_current_line_number($parser) 函数获取 XML 解析器的当前行号。
        
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

	?>
    </body>
</html>