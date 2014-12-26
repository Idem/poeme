<?php
require_once './functions.php';

class FunctionTest extends PHPUnit_Framework_TestCase
{
	/**
    * @dataProvider fileList
    */
	public function testIsPicture($file, $result){
		$this->assertEquals(is_picture($file), $result);
	}

	public function fileList()
    {
        return array(
			array('toto.jpg', true),
			array('toto.png', true),
			array('toto.PNG', true),
			array('toto.PnG', true),
			array('toto.bmp', true),
			array('to.to.jpg', true),
			array('to.to.php', false),
			array('toto.php', false)
        );
    }

}
