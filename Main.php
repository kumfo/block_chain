<?php
/**
 * Created by PhpStorm.
 * User: kumfo
 * Date: 2018/2/24
 * Time: 上午9:45
 */
class Main {
    public $blockChain = [];

    public function __construct()
    {
        $this->autoload();
    }
    public function autoload() {
        spl_autoload_register(function($class) {
            $path = dirname(__FILE__);
            $filePath = explode('\\',$class);
            $file = implode('/',$filePath).'.php';
            require_once $path.'/'.$file;
        });
    }
    public function testBlock() {
        /*$block1hash = new Block('This is the first block','0');
        $block2hash = new Block('This is the second block',$block1hash->hash);
        $block3hash = new Block('This is the third block',$block2hash->hash);
        $this->blockChain = [
            $block1hash,
            $block2hash,
            $block3hash
        ];
        var_dump(json_encode($this->blockChain));*/
        CatchChain::catchBlock();
    }
}

$main = new Main();
$main->testBlock();