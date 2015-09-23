<?php
require_once './utils.php';

class FunctionTest extends PHPUnit_Framework_TestCase
{
	/**
    * @dataProvider fileList
    */
	public function testIsPicture($file, $result){
	  $check = is_picture($file);
		$this->assertEquals($check, $result);
	}

    public function testConfigLoader() {
        $this->assertArrayHasKey("config", $GLOBALS);
        $expected = array("verse1", "verse2", "verse3", "verse4", "verse5");
        $config = array_keys($GLOBALS["config"]);
        $this->assertEquals($expected, $config);
    }

    /**
    * @expectedException InvalidArgumentException
    * @expectedExceptionMessage Unknown img list:NonExisting
    * @depends testConfigLoader
    */
    public function testNonExistingImgList() {
        get_config("NonExisting", "anykey");
    }

    /**
    * @depends testConfigLoader
    */
    public function testImgList() {
        $sorted_list = get_img_list("verse1");
        sort($sorted_list);
        $expected = array("img_1.gif", "img_2.jpeg");
        $this->assertEquals($expected,
                            $sorted_list);
    }

    /**
    * @depends testImgList
    */
    public function testImg() {
        $this->assertEquals("./tests/verse4/img_1.gif",
                            get_img("verse4", array("debug"=>true)));
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
