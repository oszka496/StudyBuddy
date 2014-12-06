<?php
require_once dirname(__FILE__).'/../inc/functions.php';

class APIUserTest extends PHPUnit_Framework_TestCase
{
    private $student;

    public function setUp()
    {
        // FIXTURES
        $this->student = array(
            "email"     => "tester@phpunit.xxx",
            "password"  => "ganymede.IO",
            "firstName" => "Ganymede",
            "lastName"  => "Jupiterson",
            "userType"  =>  User::$USERTYPE_STUDENT
        );
        
        if (!extension_loaded('mysqli')) {
            $this->markTestSkipped(
                'The MySQLi extension is not available.'
            );
        }
    }

    public function test_shouldRegisterNewStudent()
    {
        $result = User::register($this->student['email'], $this->student['password'], $this->student['password'],
            $this->student['firstName'], $this->student['lastName'], $this->student['userType']);

        $this->assertEquals($result, User::$REGISTER_SUCCESS);
    }
    
    public function test_shouldLoginAsStudent()
    {
        global $mysqli;
        $result = User::login($this->student['email'], $this->student['password']);

        $this->assertEquals($result, User::$LOGIN_SUCCESS);

        $userdata = User::getUser();
        $this->assertEquals($userdata, User::$USERTYPE_STUDENT);
    }

    public function deleteUser()
    {
        $result = User::deleteUser($this->student['email']);
        $this->assertEquals($result, User::$DELETE_SUCCESS);
    }
}
