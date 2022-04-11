<?php

class UserTest extends \PHPUnit\Framework\TestCase
{
    protected $user;

    public function setUp(): void
    {
        $this->user = new \App\Models\User;
    }

    public function test_That_We_Can_Get_The_FirstName()
    {
        $this->user->setFirstName('Billy');

        $this->assertEquals($this->user->getFirstName(), 'Billy');
    }

    public function test_That_We_Can_Get_The_LastName()
    {

        $this->user->setLastName('Garrett');

        $this->assertEquals($this->user->getLastName(), 'Garrett');
    }

    public function test_full_name_is_returned()
    {
        $this->user->setFirstName('Billy');
        $this->user->setLastName('Garrett');

        $this->assertEquals($this->user->getFullName(), 'Billy Garrett');
    }

    public function test_first_name_and_last_name_trimmed()
    {

        $this->user->setFirstName('Billy    ');
        $this->user->setLastName('    Garrett      ');

        $this->assertEquals($this->user->getFullName(), 'Billy Garrett');
    }

    public function test_set_email_address()
    {
        $this->user->setEmail('Billy@gmail.com');
        $this->assertEquals($this->user->getEmail(), 'Billy@gmail.com');
    }

    public function test_email_variable_contain_correct_values()
    {
        $this->user->setFirstName('Billy');
        $this->user->setLastName('Garrett');
        $this->user->setEmail('Billy@gmail.com');

        $emailVariable = $this->user->getEmailVariables();

        $this->assertArrayHasKey('full_name', $emailVariable);
        $this->assertArrayHasKey('email', $emailVariable);

        $this->assertEquals($emailVariable['full_name'], 'Billy Garrett');
        $this->assertEquals($emailVariable['email'], 'Billy@gmail.com');
    }
}
