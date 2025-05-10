<?php

use PHPUnit\Framework\TestCase;

//HomeModel contains MessageModel and UserModel traits

require_once $basePath . "/Model/HomeModel.php";
require_once $basePath . "/Core/Database.php";

class MessagesMenuModelTest extends TestCase
{
   public function testInsertMessage()
    {
        // Mocking the database object or the database access layer
        $dbMock = $this->getMockBuilder(Database::class)->getMock();

        // Creating an instance of HomeModel to test the trait method
        $instance = new HomeModel(); // Instantiate your class

        // Using reflection to set the private $db property
        $reflection = new ReflectionClass($instance);
        $dbProperty = $reflection->getProperty('db');
        $dbProperty->setAccessible(true);
        $dbProperty->setValue($instance, $dbMock); // Setting the mocked database object

        // Setting up test data
        $senderID = 1;
        $receiverID = 2;
        $message = 'Test message';

        // Expecting a call to the database with the provided data
        $dbMock->expects($this->once())
               ->method('query')
               ->with(
                   $this->equalTo("INSERT INTO messages (senderID, receiverID, message) VALUES (?, ?, ?)"),
                   $this->equalTo([$senderID, $receiverID, $message])
               )
               ->willReturn(true); // Assuming a successful insertion

        // Calling the method to be tested from the trait
        $result = $instance->insertMessage($senderID, $receiverID, $message);

        // Assertions
        $this->assertTrue($result);
    }

    public function testFetchMessages()
    {
        // Mocking the database object or the database access layer
        $dbMock = $this->getMockBuilder(Database::class)
                       ->getMock();

        // Creating an instance of HomeModel to test the method
        $instance = new HomeModel(); // Instantiate your class

        // Using reflection to set the private $db property
        $reflection = new ReflectionClass($instance);
        $dbProperty = $reflection->getProperty('db');
        $dbProperty->setAccessible(true);
        $dbProperty->setValue($instance, $dbMock); // Setting the mocked database object

        // Setting up test data
        $userId = 1; // Assuming a user ID for fetching messages

        // Expecting a call to the database to fetch messages
        $dbMock->expects($this->once())
               ->method('query')
               ->with(
                   $this->equalTo("SELECT * FROM messages WHERE senderID = ? OR receiverID = ?"),
                   $this->equalTo([$userId, $userId])
               )
               ->willReturn([]); // Assuming an empty array as fetched messages

        // Calling the method to be tested
        $result = $instance->fetchMessages($userId);

        // Assertions
        $this->assertIsArray($result);
        $this->assertCount(0, $result); // Assuming no messages are fetched
    }

    public function testFetchChattedUsers()
    {
        // Mocking the database object or the database access layer
        $dbMock = $this->getMockBuilder(Database::class)
                       ->getMock();

        // Creating an instance of HomeModel to test the method
        $instance = new HomeModel(); // Instantiate your class

        // Using reflection to set the private $db property
        $reflection = new ReflectionClass($instance);
        $dbProperty = $reflection->getProperty('db');
        $dbProperty->setAccessible(true);
        $dbProperty->setValue($instance, $dbMock); // Setting the mocked database object

        // Setting up test data
        $userId = 1; // Assuming a user ID for fetching chatted users

        // Expecting a call to the database to fetch chatted users
        $dbMock->expects($this->once())
               ->method('query')
               ->with(
                   $this->equalTo("SELECT DISTINCT CASE WHEN senderID = ? THEN receiverID ELSE senderID END AS otherUserID FROM messages WHERE senderID = ? OR receiverID = ?"),
                   $this->equalTo([$userId, $userId, $userId])
               )
               ->willReturn([]); // Assuming an empty array as fetched users

        // Calling the method to be tested
        $result = $instance->fetchChattedUsers($userId);

        // Assertions
        $this->assertIsArray($result);
        $this->assertCount(0, $result); // Assuming no chatted users are fetched
    }
}
