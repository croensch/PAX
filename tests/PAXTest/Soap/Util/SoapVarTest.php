<?php
namespace PAXTest\Soap\Util;

use PAX\Soap\Util\SoapVar;

class SoapVarTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests SoapVar::wrapCDATA()
     */
    public function testwrapCDATA()
    {
        $soapVar = SoapVar::wrapCDATA('<empty/>', 'xml');

        $this->assertSame(XSD_ANYXML, $soapVar->enc_type);
        $this->assertSame('<xml><![CDATA[<empty/>]]></xml>', $soapVar->enc_value);

        $soapVarNS = SoapVar::wrapCDATA('<empty/>', 'xml', 'http://x/');
        $this->assertSame('<xml xmlns="http://x/"><![CDATA[<empty/>]]></xml>', $soapVarNS->enc_value);

        $soapVarNS = SoapVar::wrapCDATA('<empty/>', 'x:xml', 'http://x/');
        $this->assertSame('<x:xml xmlns:x="http://x/"><![CDATA[<empty/>]]></x:xml>', $soapVarNS->enc_value);
    }
}
