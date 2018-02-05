<?php
/*
 * 视图模型
 * */

class AppsViewModel extends ViewModel{
    public $viewFields = array(
        'Apps'=>array('id','url'),
        'Webs'=>array('name','url'=>'wurl','_on'=>'Apps.id=Webs.id')
    );
}
#SELECT Apps.id AS id,Apps.url AS url,Webs.name AS name,Webs.url AS wurl FROM apps Apps JOIN webs Webs ON Apps.id=Webs.id


class AppsViewModel extends ViewModel{
    public $viewFields = array(
        'Apps'=>array('id','url','_type'=>'RIGHT'),
        'Webs'=>array('name','url'=>'wurl','_on'=>'Apps.id=Webs.id')
    );
}
#SELECT Apps.id AS id,Apps.url AS url,Webs.name AS name,Webs.url AS wurl FROM apps Apps RIGHT JOIN webs Webs ON Apps.id=Webs.id


class AppsViewModel extends ViewModel{
    public $viewFields = array(
        'Apps'=>array('id','url')
    );
}
#SELECT Apps.id AS id,Apps.url AS url FROM apps Apps
?>