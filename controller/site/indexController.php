<?php
if(!defined(FREE_NET)) exit();

class IndexController extends Controller{

	public function __construct(){
		print_r("index construct"); echo "<br/>";
	}
	
	public function defaultAction(){
		print_r("defaultAction");
	}
}