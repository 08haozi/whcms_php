<?php
/**
 * 获取分页代码
 * @param int $page 当前显示第几页
 * @param int $pageNum 每页显示数目
 * @param int $count 数据总数
 * @param string $pageLink 链接
 */
function getPage($page,$pageNum,$count,$pageLink){
    if($count<1||$page<1){
        echo '没有数据';
        return;
    }
    $pageCount=ceil($count/$pageNum);//总页数
    if($page>$pageCount){
        echo '没有数据';
        return;
    }
    
    $begin=($page-2<=0)?1:($page-2);
    
    $sb='<li><a href="'.$pageLink.'/page/1"><<</a></li>';
    $sb.=($page<2)?'<li class="disabled"><a href="#"><</a></li>'
        :'<li><a href="'.$pageLink.'/'.($page-1).'"><</a></li>';
    $i=0;
    while($begin<=$pageCount&&$i<5){
        $sb.=($begin==$page)?'<li class="active">':'<li>';
        $sb.='<a href="'.$pageLink.'/page/'.$begin.'">'.$begin.'</a></li>';
        $begin++;
        $i++;
    }
    $sb.=($page>=$pageCount)?'<li class="disabled"><a href="#">></a></li>'
        :'<li><a href="'.$pageLink.'/page/'.($page+1).'">></a></li>';
    $sb.='<li><a href="'.$pageLink.'/page/'.$pageCount.'">>></a></li>';
    echo $sb;
}