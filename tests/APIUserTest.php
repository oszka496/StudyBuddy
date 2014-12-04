<?php
include dirname(__FILE__).'/../inc/functions.php';

class APIUserTest extends PHPUnit_Framework_TestCase
{
    private $student;

    public static function setUpBeforeClass()
    {
        // FIXTURES
        $student = array(
            "email"     => "tester@phpunit.xxx",
            "password"  => "ganymede.IO",
            "firstName" => "Ganymede",
            "lastName"  => "Jupiterson",
            "userType"  =>  User::$USERTYPE_STUDENT
        );
    }

    public function test_shouldRegisterNewStudent()
    {
        $result = User::register($student['email'], $student['password'], $student['password'],
            $student['firstName'], $student['lastName'], $student['userType']);

        $this->assertEquals($result, User::$REGISTER_SUCCESS);
    }

    /**
     *  @depends test_shouldRegisterNewStudent()   
     */
    public function test_shouldLoginAsStudent()
    {
        $result = User::login($student['login'], $student['password']);

        $this->assertEquals($result, User::$LOGIN_SUCCESS);

        $userdata = User::getUser();
        $this->assertEquals($userdata, User::$USERTYPE_STUDENT);
    }

    /**
     * @depends test_shouldLoginAsStudent()
    */
    public static function deleteUser()
    {
        $result = User::deleteUser($student['email']);
        $this->assertEquals($result, User::$DELETE_SUCCESS);
    }
}
