<?php

namespace Fastwhale\PHPScraper\Tests;

class MetaAuthorTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     */
    public function testMissingAuthor()
    {
        $web = new \Fastwhale\PHPScraper\PHPScraper;

        // Navigate to the test page.
        $web->go('https://test-pages.phpscraper.de/meta/meta/missing.html');

        // Check the author as not given (null)
        $this->assertNull($web->author);
    }

    /**
     * @test
     */
    public function testWithHTMLEntity()
    {
        $web = new \Fastwhale\PHPScraper\PHPScraper;

        // Navigate to the test page.
        $web->go('https://test-pages.phpscraper.de/meta/html-entities.html');

        // Check the author
        $this->assertSame(
            'Cat & Mouse',
            $web->author
        );
    }

    /**
     * @test
     */
    public function testLoremIpsum()
    {
        $web = new \Fastwhale\PHPScraper\PHPScraper;

        // Navigate to the test page.
        $web->go('https://test-pages.phpscraper.de/meta/lorem-ipsum.html');

        // Check the author
        $this->assertSame(
            'Lorem ipsum',
            $web->author
        );
    }

    /**
     * @test
     */
    public function testGermanUmlaute()
    {
        $web = new \Fastwhale\PHPScraper\PHPScraper;

        // Navigate to the test page.
        $web->go('https://test-pages.phpscraper.de/meta/german-umlaute.html');

        // Check the author
        $this->assertSame(
            'Müller',
            $web->author
        );
    }

    /**
     * @test
     */
    public function testChineseCharacters()
    {
        $web = new \Fastwhale\PHPScraper\PHPScraper;

        // Navigate to the test page.
        $web->go('https://test-pages.phpscraper.de/meta/chinese-characters.html');

        // Check the author
        $this->assertSame(
            '貓',
            $web->author
        );
    }
}
