<?php
namespace lib;
class start {
	function __construct()
    {
		$m = "index";
		$c = "index";
		$a = "index";
		if(isset($_GET['m']) ){
			if(file_exists(APP_PATH.$_GET['m'])){
				$m = $_GET['m'];
			}else{
				$msg = "模块不存在";
			}
		}else{
			$msg = "模块不存在";
		}
		if(isset($_GET['c']) and  !empty($m)){
			if(file_exists(APP_PATH.$m.'/controller/'.$_GET['c'].'.php')){
				$c = $_GET['c'];
			}else{
				$msg = "控制器不存在";
			}
		}
		if(isset($_GET['a'])  and  !empty($m) and  !empty($c)){
			$a = $_GET['a'];
		}
		if(!file_exists(APP_PATH.$m.'/controller/'.$c.'.php')){
			if(!file_exists(APP_PATH)){
				mkdir(APP_PATH);
			}
			if(!file_exists(APP_PATH.$m)){
				mkdir(APP_PATH.$m);
			}
			if(!file_exists(APP_PATH.$m.'/controller/')){
				mkdir(APP_PATH.$m.'/controller/');
			}
			if(!file_exists(APP_PATH.$m.'/controller/'.$c.'.php')){
				file_put_contents(APP_PATH.$m.'/controller/'.$c.'.php',"<?php\r\nclass indexController {\r\n    public function index() {\r\n        echo '<div>框架已经加载成功！</div>'; \r\n    }\r\n}");
			}
		}
		require_once APP_PATH.$m.'/controller/'.$c.'.php';
		$c = $c."Controller";
		if(class_exists($c)){
			$class = new $c;
			if(method_exists($class,$a)){
				$class->$a();
			}
		}
    }
}