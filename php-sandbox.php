<?php if ( ! defined( 'ABSPATH' ) ) exit;

/*
Plugin Name: PHPSandbox
*/

require __DIR__ . '/vendor/autoload.php';

function test($string){
    return 'Hello ' . $string;
}

add_action( 'admin_notices', 'test_init' );
function test_init(){
  $sandbox = new PHPSandbox\PHPSandbox;
  $sandbox->whitelist_func('test');
  try{
    $result = $sandbox->execute(function(){
        return test('world');
    });
  }catch( Exception $e ){
    $result = $e;
  }

  var_dump($result);  //Hello world
}
