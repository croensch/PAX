<?php
namespace PAXTest\Soap\Client\Transport;

use PAX\Soap\Client\Protocol;
use PAX\Soap\Client\Transport;

class NativeTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Transport\Native
     */
    private $transport;
    
    protected $transportOptions = array(
        'uri'      => 'http://localhost/',
        'location' => 'http://localhost/'
    );

    protected function setUp()
    {
        $this->transport = new Transport\Native($this->transportOptions);
    }

    protected function tearDown()
    {
        $this->transport = null;
    }

    public function testSoapClient()
    {
        $this->assertInstanceof('\SoapClient', $this->transport->getSoapClient());

        $soapClient = new Protocol\Native\SoapClient(null, $this->transportOptions);
        $this->transport->setSoapClient($soapClient);
        $this->assertSame($soapClient, $this->transport->getSoapClient());
    }
}
