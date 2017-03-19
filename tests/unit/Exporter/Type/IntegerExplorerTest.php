<?php

namespace Exporter\Type;

use Dephpug\Exporter\Type\IntegerExporter;

class IntegerExplorerTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
    public function testPrintValueWithAnInteger()
    {
        $message = <<<'EOL'
<?xml version="1.0" encoding="iso-8859-1"?>
<response><property name="$i" type="int"><![CDATA[1]]></property></response>
EOL;
        $xml = simplexml_load_string($message);
        $integerExporter = new IntegerExporter();
        $response = $integerExporter->getExportedVar($xml);
        $this->assertEquals('1', $response);
    }
}
