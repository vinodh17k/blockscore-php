<?php

namespace BlockScore;

class PersonTest extends TestCase
{
    public function testUrl()
    {
        $this->assertSame(Person::classUrl(), '/people');
    }
    
    public function testInstanceUrl()
    {
        $person = self::createTestPerson();
        $this->assertSame($person->instanceUrl(), "/people/{$person->id}");
    }
    
    public function testClassType()
    {
        $person = self::createTestPerson();
        $this->assertTrue($person instanceof Person);
        $this->assertTrue($person instanceof Object);
    }
    
    public function testListAllPeople()
    {
        $person = self::createTestPerson();
        sleep(2);
        $people = Person::all();
        $first_person = $people[0];
        foreach (self::$test_person as $key => $value) {
            $this->assertSame($first_person->$key, $value);
        }
    }
    
    public function testRetrievePerson()
    {
        $person = self::createTestPerson();
        $retrieved_person = Person::retrieve($person->id);
        foreach (self::$test_person as $key => $value) {
            $this->assertSame($retrieved_person->$key, $value);
        }
    }
    
    public function testCreatePerson()
    {
        $person = self::createTestPerson();
        foreach (self::$test_person as $key => $value) {
            $this->assertSame($person->$key, $value);
        }
    }

    public function testOptionsForAllPeople()
    {
        $options = array('count' => 5);
        self::createTestPerson();
        self::createTestPerson();
        self::createTestPerson();
        self::createTestPerson();
        self::createTestPerson();
        self::createTestPerson();
        sleep(2);
        $people = Person::all($options);
        $this->assertSame(5, count($people));
    }
}