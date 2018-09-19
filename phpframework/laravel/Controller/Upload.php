<?php
/*
 * 文件上传
 *
 * $file=$request->file('photo'):获取文件
 * $bool=$request->hasFile('photo')：判断文件在请求中是否存在
 * $file->isValid():验证文件是否上传成功
 * $file->path()：上传文件绝对路径
 * $file->extension():判断文件扩展名
 * $path=$file->store('files','local'):保存文件,并指定disks（filesystems.php）
 * $path=$file->storeAs('files', 'filename.jpg','local')：保存文件,并指定名称,并指定disks（filesystems.php）
 * 
 * 
 * 文件下载
 * response()->file($pathToFile)：显示文件，不需要下载
 * response()->download($pathToFile):下载文件
 * */