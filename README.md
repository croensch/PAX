PAX - PHP Applications for XML
==============================

What is it?
-----------

A collection of Tools to work with XML technology in PHP.

 - PAX\Dom implements the W3C DOM API, with some extension for encoding/decoding data via XML Schema.
 - PAX\Soap implements a SOAP Client/Server and some utilities.
 - PAX\Xml implements parsers/writers(?) for XML Schema and WSDL.

What it is not?
---------------

 - PAX\Dom does extend PHPs DOM API but most things in this library should accept working with native classes e.g. \DOMDocument as well as \PAX\Dom\Document. So it's not invasive.
 - PAX\Soap does NOT extend PHPs SoapClient/SoapServer. So it is not usable as a drop-in replacement, but if you use PAX you won't need much else.

How is it licensed.
-------------------
No License, yet. Probably will be Simplified BSD.