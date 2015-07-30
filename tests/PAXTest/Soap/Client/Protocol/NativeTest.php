<?php
namespace PAXTest\Soap\Client\Protocol;

use PAX\Soap\Client\Protocol;
use PAX\Soap\Client\Transport;

class NativeTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Protocol\Native
     */
    private $protocol;

    /**
     * @var array
     */
    protected $protocolOptions = array(
        'uri'      => 'http://localhost/',
        'location' => 'http://localhost/'
    );

    protected function setUp()
    {
        $this->protocol = new Protocol\Native($this->protocolOptions);
    }

    protected function tearDown()
    {
        $this->protocol = null;
    }

    public function testTransportNative()
    {
        $transport = new Transport\Native($this->protocol->getOptions());
        $this->protocol->setTransport($transport);
        $this->assertSame($transport, $this->protocol->getTransport());
        $this->assertInstanceof('\PAX\Soap\Client\Protocol\Native\SoapClient', $this->protocol->getSoapClient());
        $this->assertInstanceof('\PAX\Soap\Client\Protocol\Native\SoapClient', $this->protocol->getTransport()->getSoapClient());
        $this->assertSame($this->protocol->getSoapClient(), $this->protocol->getTransport()->getSoapClient());
    }

    public function testTransportOther()
    {
        $transport = $this->getMockBuilder('\PAX\Soap\Client\Transport\AbstractTransport')
            ->disableOriginalConstructor()
            ->getMockForAbstractClass(array(null));
        $this->protocol->setTransport($transport);
        $this->assertSame($transport, $this->protocol->getTransport());
        $this->assertInstanceof('\PAX\Soap\Client\Protocol\Native\SoapClient', $this->protocol->getSoapClient(), 'lazy instance');
    }

    public function testSoapClient()
    {
        $this->protocol->setSoapClient(new \SoapClient(null, $this->protocolOptions));
        $this->assertInstanceof('\SoapClient', $this->protocol->getTransport()->getSoapClient());
        $this->assertSame($this->protocol->getSoapClient(), $this->protocol->getTransport()->getSoapClient());
    }
}
