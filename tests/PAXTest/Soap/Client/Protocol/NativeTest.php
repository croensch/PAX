<?php
namespace PAXTest\Soap\Client\Protocol;

use PAX\Soap\Client\Protocol;

class NativeTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Protocol\Native
     */
    private $client;
    
    protected $clientOptions = array(
        'uri'      => 'http://localhost/',
        'location' => 'http://localhost/'
    );

    protected function setUp()
    {
        $this->client = new Protocol\Native($this->clientOptions);
    }

    protected function tearDown()
    {
        $this->client = null;
    }

    public function testGetSoapClient()
    {
        $this->assertInstanceof('\PAX\Soap\Client\Protocol\Native\SoapClient', $this->client->getSoapClient());
    }

    public function testGetTransportGetSoapClient()
    {
        $this->assertInstanceof('\PAX\Soap\Client\Protocol\Native\SoapClient', $this->client->getTransport()->getSoapClient());
        $this->assertSame($this->client->getSoapClient(), $this->client->getTransport()->getSoapClient());
    }

    public function testSetSoapClientGetTransportGetSoapClient()
    {
        $this->client->setSoapClient(new \SoapClient(null, $this->clientOptions));
        $this->assertInstanceof('\SoapClient', $this->client->getTransport()->getSoapClient());
        $this->assertSame($this->client->getSoapClient(), $this->client->getTransport()->getSoapClient());
    }
}