<?php

namespace Fastwhale\PHPScraper\Tests;

class MetaContentTypeTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     */
    public function testMissingContentType()
    {
        $web = new \Fastwhale\PHPScraper\PHPScraper;

        // Navigate to the test page.
        $web->go('https://test-pages.phpscraper.de/meta/missing.html');

        // Check the contentType as not given (null)
        $this->assertNull($web->contentType);
    }

    /**
     * @test
     */
    public function testWithContentType()
    {
        $web = new \Fastwhale\PHPScraper\PHPScraper;

        // Navigate to the test page.
        $web->go('https://test-pages.phpscraper.de/meta/lorem-ipsum.html');

        // Check the contentType
        $this->assertSame(
            'text/html; charset=utf-8',
            $web->contentType
        );
    }
}
