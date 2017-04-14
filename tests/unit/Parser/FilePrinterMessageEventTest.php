<?php
namespace Parser;

use Dephpug\Parser\FilePrinterMessageEvent;

class FilePrinterMessageEventTest extends \Codeception\Test\Unit
{
    protected function _before()
    {
        $this->filePrinterMessageEvent = new FilePrinterMessageEvent();
    }

    public function testMatchFileAndLineNumber()
    {
        $xml = <<<'EOL'
<?xml version="1.0" encoding="iso-8859-1"?>
<response xmlns="urn:debugger_protocol_v1" xmlns:xdebug="http://xdebug.org/dbgp/xdebug" command="step_over" transaction_id="1" status="break" reason="ok">
 <xdebug:message filename="file:///path/of/project/index.php" lineno="34">
 </xdebug:message>
</response>
EOL;

        $matched = $this->filePrinterMessageEvent->match($xml);
        $lineNumber = $this->filePrinterMessageEvent->fileNumber;
        $filename = $this->filePrinterMessageEvent->fileName;

        $this->assertTrue($matched);
        $this->assertEquals('/path/of/project/index.php', $filename);
        $this->assertEquals(34, $lineNumber);
    }

    public function testUnmatchingFilePrinter()
    {
        $xml = <<<'EOL'
<?xml version="1.0" encoding="iso-8859-1"?>
<response xmlns="urn:debugger_protocol_v1" xmlns:xdebug="http://xdebug.org/dbgp/xdebug" command="property_get" transaction_id="1" status="break" reason="ok">
 <error code="300">
  <message>
   <![CDATA[can not get property]]>
  </message>
 </error>
</response>
EOL;

        $matched = $this->filePrinterMessageEvent->match($xml);
        $this->assertTrue(!$matched);
    }
}