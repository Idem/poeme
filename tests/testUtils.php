<?php
require_once './utils.php';

class FunctionTest extends PHPUnit_Framework_TestCase
{
	/**
    * @dataProvider fileList
    */
	public function testIsPicture($file, $result){
		$this->assertEquals(is_picture($file), $result);
	}

    public function testConfigLoader() {
        $this->assertArrayHasKey("config", $GLOBALS);
        $this->assertEquals(array("verse1", "verse2", "verse3", "verse4", "verse5"),
                            array_keys($GLOBALS["config"]));
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
        $this->assertEquals(array("img_1.gif", "img_2.jpeg"),
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
