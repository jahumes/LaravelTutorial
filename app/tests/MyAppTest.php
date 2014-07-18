<?php
class MyAppTest extends TestCase {

  /**
   * Testing the MyApp route
   *
   * @return void
   */
  public function testMyAppRoute()
  {
    $response = $this->call('GET', 'myapp');
    $this->assertResponseOk();
    $this->assertEquals('This is my app', $response->getContent());
  }
}