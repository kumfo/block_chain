<?php
/**
 * Created by PhpStorm.
 * User: kumfo
 * Date: 2018/3/6
 * Time: 下午5:07
 */

/**
 * Class CatchChain
 */
class CatchChain
{
    public static $blockChain = [];
    public static $difficulty = 5;

    public static function catchBlock() {
        self::addBlock(new Block('This is the first block','0'));
        self::addBlock(new Block('second block',self::getPrevBlockChain()));
        self::addBlock(new Block('second block',self::getPrevBlockChain()));
        self::isChainValid();
    }
    /**
     * @param Block $newBlock
     */
    public static function addBlock($newBlock) {
        $newBlock->mineBlock(self::$difficulty);
        self::$blockChain[] = $newBlock;
    }

    /**
     * 验证hash链是否完整
     * 它会遍历链中每个块，然后对比hash值。
     * 这个方法做的事情就是检查hash变量的值是否等于计算出来的hash值以及上一个块的hash是否等于previousHash变量的值。
     * @return bool
     */
    public static function isChainValid() {
        $currentBlock = []; // Block
		$previousBlock = []; // Block
        $hashTarget = str_repeat('0',self::$difficulty);

        $chainLength = count(self::$blockChain);
        for ($i = 1; $i<$chainLength; $i++) {
            $currentBlock = self::$blockChain[$i];
            $previousBlock = self::$blockChain[$i-1];
            //
            if($currentBlock->hash  !== $currentBlock->calculateHash()) {
                echo '当前hash不相等';
                return false;
            }
            if($previousBlock->hash  !== $previousBlock->calculateHash()) {
                echo '上一个hash不相等';
                return false;
            }
            if(mb_substr($currentBlock->hash,0,self::$difficulty) != $hashTarget) {
                echo '此区块开采失败'.$currentBlock->hash;
                return false;
            }
        }
		return true;
	}

    /**
     * @return string
     */
	public static function getPrevBlockChain() {
        $chainLength = count(self::$blockChain);
        return self::$blockChain[$chainLength - 1]->hash;
    }
}