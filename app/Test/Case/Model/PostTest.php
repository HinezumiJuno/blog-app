<?php
App::uses('Post', 'Model');
App::uses('Fabricate', 'Fabricate.lib');

/**
 * Post Test Case
 */
class PostTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.post'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Post = ClassRegistry::init('Post');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Post);

		parent::tearDown();
	}
 /**
  * @dataProvider exampleValidationErrors
  */
 public function testバリデーションエラー($colmun, $value, $message){
	 $post = Fabricate::build('Post', [$colmun => $value]);
	 $this->assertFalse($post->validates());
	 $this->assertEquals([$message], $this->Post->validationErrors[$colmun]);
 }

 public function exampleValidationErrors(){
	return[
		 ['title', '', 'タイトルは必須入力です'],
		 ['title', str_pad('', 256, "a"), 'タイトルは255文字以内で入力してください'],
	 ];
 }

}
