# plupload


```
<script src="https://cdn.bootcss.com/plupload/2.2.1/plupload.full.min.js"></script>

<p>
    <button id="browse" class="btn btn-primary">选择文件</button>
    <button id="start_upload" class="btn btn-danger">开始上传</button>
</p>

<ul class="list"></ul>


#实例化一个plupload上传对象
var uploader = new plupload.Uploader({
      #触发文件选择对话框的按钮，为那个元素id
      browse_button : 'browse',
      #服务器端的上传页面地址
      url : 'upload.php',
      #swf文件，当需要使用swf方式进行上传时需要配置该参数
      flash_swf_url : 'js/Moxie.swf',
      #silverlight文件，当需要使用silverlight方式进行上传时需要配置该参数
      silverlight_xap_url : 'js/Moxie.xap' ,
      #文件过滤
      filters: {
         mime_types : [ //只允许上传图片文件和rar压缩文件
            { title : "图片文件", extensions : "jpg,gif,png,bmp" },
            { title : "RAR压缩文件", extensions : "zip" }
         ],
         max_file_size : '100kb', //最大只能上传100kb的文件
         prevent_duplicates : true //不允许队列中存在重复文件
      },
      #压缩文件
      resize: {
          width: 100,//指定压缩后图片的宽度
          height: 100,//指定压缩后图片的高度
          crop: true,//是否裁剪图片
          preserve_headers: false//是否保留图片的元数据
     }
    });

    #在实例对象上调用init()方法进行初始化
    uploader.init();

    #绑定文件添加进队列事件
    uploader.bind('FilesAdded',function(uploader,files){
        for(var i = 0, len = files.length; i<len; i++){
            var file_name = files[i].name; //文件名
            #构造html来更新UI
            var html = '<li id="file-' + files[i].id +'"><p class="file-name">' + file_name + '</p><div class="progress"><div class="progress-bar"></div></div></li>';
            $(html).appendTo('.list');
            #预览图片
            （function(i){
				previewImage(files[i],function(imgsrc){
					$('#file-'+files[i].id).append('<img src="'+ imgsrc +'" />');
				})
		    }(i)）;
        }
    });

    #绑定文件上传进度事件
    uploader.bind('UploadProgress',function(uploader,file){
        $('#file-'+file.id+' .progress-bar').css('width',file.percent + '%');//控制进度条
    });

    #当队列中的某一个文件正要开始上传前触发
    uploader.bind('BeforeUpload',function (uploader,file) {
       #设置某个特定的配置参数,option为参数名称，value为要设置的参数值。
       uploader.setOption({
           multipart_params:{
                 'OSSAccessKeyId':'LTAI2yDRh37ay7Hi',
                 'policy':'eyJleHBpcmF0aW9uIjoiMjAxOC0wMS0wMVQxMjowMDowMC4wMDBaIiwiY29uZGl0aW9ucyI6W1siY29udGVudC1sZW5ndGgtcmFuZ2UiLDAsMTA0ODU3NjAwXV19',
                 'Signature':'307mAmKmpl/Y2owgM8djs0j62AI=',
                 'key':file.name,
           }
       });
    });
    #上传按钮
    $('#start_upload').click(function(){
        uploader.start(); //开始上传
    });

    #预览图片
    function previewImage(file,callback){//file为plupload事件监听函数参数中的file对象,callback为预览图片准备完成的回调函数
		if(!file || !/image\//.test(file.type)) return; //确保文件是图片
		if(file.type=='image/gif'){//gif使用FileReader进行预览,因为mOxie.Image只支持jpg和png
			var fr = new mOxie.FileReader();
			fr.onload = function(){
				callback(fr.result);
				fr.destroy();
				fr = null;
			}
			fr.readAsDataURL(file.getSource());
		}else{
			var preloader = new mOxie.Image();
			preloader.onload = function() {
				preloader.downsize( 300, 300 );//先压缩一下要预览的图片,宽300，高300
				var imgsrc = preloader.type=='image/jpeg' ? preloader.getAsDataURL('image/jpeg',80) : preloader.getAsDataURL(); //得到图片src,实质为一个base64编码的数据
				callback && callback(imgsrc); //callback传入的参数为预览图片的url
				preloader.destroy();
				preloader = null;
			};
			preloader.load( file.getSource() );
		}
	}

    #错误判断
    uploader.bind('Error',function(uploader,error){
        console.log(error.code);
    });


#上传服务器
move_uploaded_file($_FILES["file"]["tmp_name"], "file/" . $_FILES["file"]["name"]);


#直传阿里云OSS
$arr=["expiration"=>"2018-01-01T12:00:00.000Z",
      "conditions"=>[
          ["content-length-range", 0, 104857600]
      ]
];
var_dump(base64_encode(json_encode($arr)));
var_dump(base64_encode(hash_hmac('sha1', base64_encode(json_encode($arr)), 'KoX0mrcyQW6afLeXjC4GtY6VXmC8hQ', true)));
```