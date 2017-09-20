<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2017/4/26
 * Time: 16:58
 */
class IndexCtr extends Controller{

    function index(){
        echo "<h1>Welcome to use this framework!</h1>";
    }
    function test(){
        $a="a:b>c<d";
        $tmp=[$a];
        $de=[":",">","<"];
        $res=[];
        foreach($de as $d){
            foreach($tmp as $r){
                if(strpos($r,$d)===false){
                    continue;
                }
                $tmp=explode($d,$r);
                $res=array_merge($res,$tmp);
                var_dump($res);
            }
        }
        var_dump($res);
        //$Dd1=new Db();
        //$Dd1->get("user:class","ucid=cid",["uname","uage","cname"],["AND"=>["uname"=>1,"uage"=>10]]);
    }


}