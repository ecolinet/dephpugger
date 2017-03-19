<?php
namespace Exporter\Type;

use Dephpug\Exporter\Type\NullExporter;

class NullExporterTest extends \Codeception\Test\Unit
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
    // tests
    public function testPrintValueWithAnInteger()
    {
        $message = <<<EOL
<?xml version="1.0" encoding="iso-8859-1"?>
<response><property name="\$i" type="null"></property></response>
EOL;
        $xml = simplexml_load_string($message);
        $nullExporter = new NullExporter();
        $response = $nullExporter->getExportedVar($xml);
        $this->assertEquals('null', $response);
    }
}