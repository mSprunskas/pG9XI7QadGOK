<?php

use PHPUnit\Framework\TestCase;
use SpaceX\App\Application;

class ApplicationValidationTest extends TestCase
{
    private Application $application;

    public function setUp() : void
    {
        $this->application = new Application();
    }

    /**
     * @param array $input
     * @param Exception $expectedException
     *
     * @dataProvider dataProviderForFaultyInputTestCase
     */
    public function testFaultyInput(array $input, Exception $expectedException)
    {
        $this->expectExceptionObject($expectedException);
        $this->application->run($input);
    }

    public function dataProviderForFaultyInputTestCase(): array
    {
        return [
            'case empty parameters' => [
                [
                ],
                new RuntimeException('Currency is argument required'),
            ],
            'case only first argv is available' => [
                [
                    '/path/to/script'
                ],
                new RuntimeException('Currency is argument required'),
            ],
            'case unsupported classic currency' => [
                [
                    '/path/to/script',
                    'LTL'
                ],
                new RuntimeException('Currency LTL is not supported'),
            ],
            'case unsupported crypto currency' => [
                [
                    '/path/to/script',
                    'EUR',
                    'AAA'
                ],
                new RuntimeException('Crypto currency AAA is not supported'),
            ],
        ];
    }
}
