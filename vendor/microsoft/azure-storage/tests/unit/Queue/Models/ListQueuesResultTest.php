<?php

/**
 * LICENSE: The MIT License (the "License")
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 * https://github.com/azure/azure-storage-php/LICENSE
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * 
 * PHP version 5
 *
 * @category  Microsoft
 * @package   MicrosoftAzure\Storage\Tests\Unit\Queue\Models
 * @author    Azure Storage PHP SDK <dmsh@microsoft.com>
 * @copyright 2016 Microsoft Corporation
 * @license   https://github.com/azure/azure-storage-php/LICENSE
 * @link      https://github.com/azure/azure-storage-php
 */

namespace MicrosoftAzure\Storage\Tests\Unit\Queue\Models;
use MicrosoftAzure\Storage\Queue\Models\ListQueuesResult;
use MicrosoftAzure\Storage\Tests\Framework\TestResources;

/**
 * Unit tests for class ListQueuesResult
 *
 * @category  Microsoft
 * @package   MicrosoftAzure\Storage\Tests\Unit\Queue\Models
 * @author    Azure Storage PHP SDK <dmsh@microsoft.com>
 * @copyright 2016 Microsoft Corporation
 * @license   https://github.com/azure/azure-storage-php/LICENSE
 * @version   Release: 0.11.0
 * @link      https://github.com/azure/azure-storage-php
 */
class ListQueuesResultTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers MicrosoftAzure\Storage\Queue\Models\ListQueuesResult::create 
     */
    public function testCreateWithEmpty()
    {
        // Setup
        $sample = TestResources::listQueuesEmpty();
        
        // Test
        $actual = ListQueuesResult::create($sample);
        
        // Assert
        $this->assertCount(0, $actual->getQueues());
        $this->assertTrue(empty($sample['NextMarker']));
    }
    
    /**
     * @covers MicrosoftAzure\Storage\Queue\Models\ListQueuesResult::create 
     */
    public function testCreateWithOneEntry()
    {
        // Setup
        $sample = TestResources::listQueuesOneEntry();
        
        // Test
        $actual = ListQueuesResult::create($sample);
        
        // Assert
        $queues = $actual->getQueues();
        $this->assertCount(1, $queues);
        $this->assertEquals($sample['Queues']['Queue']['Name'], $queues[0]->getName());
        $this->assertEquals($sample['@attributes']['ServiceEndpoint'] . $sample['Queues']['Queue']['Name'], $queues[0]->getUrl());
        $this->assertEquals($sample['Marker'], $actual->getMarker());
        $this->assertEquals($sample['MaxResults'], $actual->getMaxResults());
        $this->assertEquals($sample['NextMarker'], $actual->getNextMarker());
    }
    
    /**
     * @covers MicrosoftAzure\Storage\Queue\Models\ListQueuesResult::create 
     */
    public function testCreateWithMultipleEntries()
    {
        // Setup
        $sample = TestResources::listQueuesMultipleEntries();
        
        // Test
        $actual = ListQueuesResult::create($sample);
        
        // Assert
        $queues = $actual->getQueues();
        $this->assertCount(2, $queues);
        $this->assertEquals($sample['Queues']['Queue'][0]['Name'], $queues[0]->getName());
        $this->assertEquals($sample['@attributes']['ServiceEndpoint'] . $sample['Queues']['Queue'][0]['Name'], $queues[0]->getUrl());
        $this->assertEquals($sample['Queues']['Queue'][1]['Name'], $queues[1]->getName());
        $this->assertEquals($sample['@attributes']['ServiceEndpoint'] . $sample['Queues']['Queue'][1]['Name'], $queues[1]->getUrl());
        $this->assertEquals($sample['MaxResults'], $actual->getMaxResults());
        $this->assertEquals($sample['NextMarker'], $actual->getNextMarker());
        
        return $actual;
    }
    
    /**
     * @covers MicrosoftAzure\Storage\Queue\Models\ListQueuesResult::getQueues
     * @depends testCreateWithMultipleEntries
     */
    public function testGetQueues($result)
    {
        // Test
        $actual = $result->getQueues();
        
        // Assert
        $this->assertCount(2, $actual);
    }
    
    /**
     * @covers MicrosoftAzure\Storage\Queue\Models\ListQueuesResult::setQueues
     * @depends testCreateWithMultipleEntries
     */
    public function testSetQueues($result)
    {
        // Setup
        $sample = new ListQueuesResult();
        $expected = $result->getQueues();
        
        // Test
        $sample->setQueues($expected);
        
        // Assert
        $this->assertEquals($expected, $sample->getQueues());
        $expected[0]->setName('test');
        $this->assertNotEquals($expected, $sample->getQueues());
    }
    
    /**
     * @covers MicrosoftAzure\Storage\Queue\Models\ListQueuesResult::setPrefix
     */
    public function testSetPrefix()
    {
        // Setup
        $result = new ListQueuesResult();
        $expected = 'myprefix';
        
        // Test
        $result->setPrefix($expected);
        
        // Assert
        $this->assertEquals($expected, $result->getPrefix());
    }
    
    /**
     * @covers MicrosoftAzure\Storage\Queue\Models\ListQueuesResult::getPrefix
     */
    public function testGetPrefix()
    {
        // Setup
        $result = new ListQueuesResult();
        $expected = 'myprefix';
        $result->setPrefix($expected);
        
        // Test
        $actual = $result->getPrefix();
        
        // Assert
        $this->assertEquals($expected, $actual);
    }
    
    /**
     * @covers MicrosoftAzure\Storage\Queue\Models\ListQueuesResult::setNextMarker
     */
    public function testSetNextMarker()
    {
        // Setup
        $result = new ListQueuesResult();
        $expected = 'mymarker';
        
        // Test
        $result->setNextMarker($expected);
        
        // Assert
        $this->assertEquals($expected, $result->getNextMarker());
    }
    
    /**
     * @covers MicrosoftAzure\Storage\Queue\Models\ListQueuesResult::getNextMarker
     */
    public function testGetNextMarker()
    {
        // Setup
        $result = new ListQueuesResult();
        $expected = 'mymarker';
        $result->setNextMarker($expected);
        
        // Test
        $actual = $result->getNextMarker();
        
        // Assert
        $this->assertEquals($expected, $actual);
    }
    
    /**
     * @covers MicrosoftAzure\Storage\Queue\Models\ListQueuesResult::setMarker
     */
    public function testSetMarker()
    {
        // Setup
        $result = new ListQueuesResult();
        $expected = 'mymarker';
        
        // Test
        $result->setMarker($expected);
        
        // Assert
        $this->assertEquals($expected, $result->getMarker());
    }
    
    /**
     * @covers MicrosoftAzure\Storage\Queue\Models\ListQueuesResult::getMarker
     */
    public function testGetMarker()
    {
        // Setup
        $result = new ListQueuesResult();
        $expected = 'mymarker';
        $result->setMarker($expected);
        
        // Test
        $actual = $result->getMarker();
        
        // Assert
        $this->assertEquals($expected, $actual);
    }
    
    /**
     * @covers MicrosoftAzure\Storage\Queue\Models\ListQueuesResult::setMaxResults
     */
    public function testSetMaxResults()
    {
        // Setup
        $result = new ListQueuesResult();
        $expected = '3';
        
        // Test
        $result->setMaxResults($expected);
        
        // Assert
        $this->assertEquals($expected, $result->getMaxResults());
    }
    
    /**
     * @covers MicrosoftAzure\Storage\Queue\Models\ListQueuesResult::getMaxResults
     */
    public function testGetMaxResults()
    {
        // Setup
        $result = new ListQueuesResult();
        $expected = '3';
        $result->setMaxResults($expected);
        
        // Test
        $actual = $result->getMaxResults();
        
        // Assert
        $this->assertEquals($expected, $actual);
    }
    
    /**
     * @covers MicrosoftAzure\Storage\Queue\Models\ListQueuesResult::setAccountName
     */
    public function testSetAccountName()
    {
        // Setup
        $result = new ListQueuesResult();
        $expected = 'name';
        
        // Test
        $result->setAccountName($expected);
        
        // Assert
        $this->assertEquals($expected, $result->getAccountName());
    }
    
    /**
     * @covers MicrosoftAzure\Storage\Queue\Models\ListQueuesResult::getAccountName
     */
    public function testGetAccountName()
    {
        // Setup
        $result = new ListQueuesResult();
        $expected = 'name';
        $result->setAccountName($expected);
        
        // Test
        $actual = $result->getAccountName();
        
        // Assert
        $this->assertEquals($expected, $actual);
    }
}