<?php
use PHPUnit\Framework\TestCase;

require_once $basePath . "/Model/HomeModel.php";
require_once $basePath . "/Core/Database.php";

class ReportModelTest extends TestCase
{
    public function testInsertReport()
    {
        // Mocking the database object or the database access layer
        $dbMock = $this->getMockBuilder(Database::class)
                       ->getMock();

        // Creating an instance of HomeModel to test the method
        $instance = new HomeModel(); 

        // Using reflection to set the private $db property
        $reflection = new ReflectionClass($instance);
        $dbProperty = $reflection->getProperty('db');
        $dbProperty->setAccessible(true);
        $dbProperty->setValue($instance, $dbMock); // Setting the mocked database object

        // Setting up test data
        $reportedListingID = 1;
        $reportedUserID = 2;
        $reporterUserID = 3;

        // Expecting a call to the database to insert a report
        $dbMock->expects($this->once())
               ->method('query')
               ->with(
                   $this->equalTo("INSERT INTO reports (reportedListingID, reportedUserID, reporterUserID, reportMessage, creationDate) VALUES (?, ?, ?, ?, ?)"),
                   $this->equalTo([$reportedListingID, $reportedUserID, $reporterUserID, 'YourReportMessage', date("Y-m-d H:i:s")])
               )
               ->willReturn(true); // Assuming a successful insertion

        // Setting the reportMessage field in ReportModel
        $instance->reportMessage = 'YourReportMessage';

        // Calling the method to be tested
        $result = $instance->insertReport($reportedListingID, $reportedUserID, $reporterUserID);

        // Assertions
        $this->assertTrue($result);
    }

    public function testFetchReport()
    {
        // Mocking the database object or the database access layer
        $dbMock = $this->getMockBuilder(Database::class)
                       ->getMock();

        // Creating an instance of HomeModel to test the method
        $instance = new HomeModel(); 

        // Using reflection to set the private $db property
        $reflection = new ReflectionClass($instance);
        $dbProperty = $reflection->getProperty('db');
        $dbProperty->setAccessible(true);
        $dbProperty->setValue($instance, $dbMock); // Setting the mocked database object

        // Setting up test data
        $reportedListingID = 1;
        $reporterUserID = 3;

        // Mocking the expected result from the database query
        $expectedResult = [
            'id' => 1,
            //Other fields needed
        ];

        // Expecting a call to the database to fetch a report
        $dbMock->expects($this->once())
               ->method('query')
               ->with(
                   $this->equalTo("SELECT * FROM reports WHERE reportedListingID = ? AND reporterUserID = ?"),
                   $this->equalTo([$reportedListingID, $reporterUserID])
               )
               ->willReturn($expectedResult); // Mocking the fetched report

        // Calling the method to be tested
        $result = $instance->fetchReport($reportedListingID, $reporterUserID);

        // Assertions
        $this->assertEquals($expectedResult, $result);
    }

    public function testFetchListingReports()
    {
        // Mocking the database object or the database access layer
        $dbMock = $this->getMockBuilder(Database::class)
                       ->getMock();

        // Creating an instance of HomeModel to test the method
        $instance = new HomeModel(); 

        // Using reflection to set the private $db property
        $reflection = new ReflectionClass($instance);
        $dbProperty = $reflection->getProperty('db');
        $dbProperty->setAccessible(true);
        $dbProperty->setValue($instance, $dbMock); // Setting the mocked database object

        // Setting up test data
        $listingID = 1;

        // Mocking the expected result from the database query
        $expectedResult = [
            ['id' => 1], // Example report data
            ['reportedListingID' => 2], // Additional report data
            // Add other fields
        ];

        // Expecting a call to the database to fetch listing reports
        $dbMock->expects($this->once())
               ->method('query')
               ->with(
                   $this->equalTo("SELECT * FROM reports WHERE reportedListingID = ?"),
                   $this->equalTo([$listingID])
               )
               ->willReturn($expectedResult); // Mocking the fetched listing reports

        // Calling the method to be tested
        $result = $instance->fetchListingReports($listingID);

        // Assertions
        $this->assertEquals($expectedResult, $result);
    }

    public function testDeleteReport()
    {
        // Mocking the database object or the database access layer
        $dbMock = $this->getMockBuilder(Database::class)
                       ->getMock();

        // Creating an instance of HomeModel to test the method
        $instance = new HomeModel();

        // Using reflection to set the private $db property
        $reflection = new ReflectionClass($instance);
        $dbProperty = $reflection->getProperty('db');
        $dbProperty->setAccessible(true);
        $dbProperty->setValue($instance, $dbMock); // Setting the mocked database object

        // Setting up test data
        $reportID = 1;

        // Expecting a call to the database to delete a report
        $dbMock->expects($this->once())
               ->method('query')
               ->with(
                   $this->equalTo("DELETE FROM reports WHERE id = ?"),
                   $this->equalTo([$reportID])
               )
               ->willReturn(true); // Assuming a successful deletion

        // Calling the method to be tested
        $result = $instance->deleteReport($reportID);

        // Assertions
        $this->assertTrue($result);
    }
}
