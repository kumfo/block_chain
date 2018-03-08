<?php
/**
 * Created by PhpStorm.
 * User: kumfo
 * Date: 2018/2/24
 * Time: 上午9:50
 */

class Block
{
    public $hash;
    public $previousHash;
    private $data;
    private $timeStamp;
    private $nonce;

    public function __construct($data,$previousHash)
    {
        $this->data = $data;
        $this->previousHash = $previousHash;
        $this->timeStamp = Time::getMsectime();
        $this->hash = $this->calculateHash();
    }

    /**
     * 计算hash值
     * @return string
     */
    public function calculateHash() {
        $calculatedHash = StringUtil::applySha256(
            $this->previousHash .
            $this->timeStamp.
            $this->nonce.
            $this->data
        );
        return $calculatedHash;
    }

    /**
     * 挖矿
     * @param integer $difficulty 难度
     */
    public function mineBlock($difficulty) {
        $target = str_repeat('0',$difficulty);
        while(mb_substr($this->hash,0,$difficulty) !== $target) {
            $this->nonce ++;
            $this->hash = $this->calculateHash();
        }

        echo "Block已挖到: " . $this->hash ."\n";
    }
}