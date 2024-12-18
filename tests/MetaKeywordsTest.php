<?php

namespace Fastwhale\PHPScraper\Tests;

class MetaKeywordsTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     */
    public function testMissingKeywords()
    {
        $web = new \Fastwhale\PHPScraper\PHPScraper;

        // Go to the test page
        $web->go('https://test-pages.phpscraper.de/meta/missing.html');

        // null if there aren't any keywords set.
        $this->assertNull($web->keywordString);

        // Empty array if there aren't any keywords set.
        $this->assertTrue(is_iterable($web->keywords));
        $this->assertTrue(empty($web->keywords));
    }

    /**
     * @test
     */
    public function testNoSpaces()
    {
        $web = new \Fastwhale\PHPScraper\PHPScraper;

        // Navigate to the test page.
        $web->go('https://test-pages.phpscraper.de/meta/keywords/parse-no-spaces.html');

        // Check the keywords on this case...
        $this->assertSame('one,two,three', $web->keywordString);
        $this->assertSame(['one', 'two', 'three'], $web->keywords);
    }

    /**
     * @test
     */
    public function testSpaces()
    {
        $web = new \Fastwhale\PHPScraper\PHPScraper;

        // Navigate to the test page.
        $web->go('https://test-pages.phpscraper.de/meta/keywords/parse-spaces.html');

        // Check the keywords on this case...
        $this->assertSame('one, two, three', $web->keywordString);
        $this->assertSame(['one', 'two', 'three'], $web->keywords);
    }

    /**
     * @test
     */
    public function testIrregularSpaces()
    {
        $web = new \Fastwhale\PHPScraper\PHPScraper;

        // Navigate to the test page.
        $web->go('https://test-pages.phpscraper.de/meta/keywords/parse-irregular-spaces.html');

        // Check the keywords on this case...
        $this->assertSame('one, two,   three', $web->keywordString);
        $this->assertSame(['one', 'two', 'three'], $web->keywords);
    }

    /**
     * @test
     */
    public function testWithHTMLEntity()
    {
        $web = new \Fastwhale\PHPScraper\PHPScraper;

        // Navigate to the test page.
        $web->go('https://test-pages.phpscraper.de/meta/html-entities.html');

        // Check the keywords
        $this->assertSame(['Cat & Mouse', 'Mouse & Cat'], $web->keywords);
    }

    /**
     * @test
     */
    public function testLoremIpsum()
    {
        $web = new \Fastwhale\PHPScraper\PHPScraper;

        // Navigate to the test page.
        $web->go('https://test-pages.phpscraper.de/meta/lorem-ipsum.html');

        // Check the keywords
        $this->assertSame(['Lorem', 'ipsum', 'dolor'], $web->keywords);
    }

    /**
     * @test
     */
    public function testGermanUmlaute()
    {
        $web = new \Fastwhale\PHPScraper\PHPScraper;

        // Navigate to the test page.
        $web->go('https://test-pages.phpscraper.de/meta/german-umlaute.html');

        // Check the keywords
        $this->assertSame(['keywords', 'schlüsselwörter'], $web->keywords);
    }

    /**
     * @test
     */
    public function testChineseCharacters()
    {
        $web = new \Fastwhale\PHPScraper\PHPScraper;

        // Navigate to the test page.
        $web->go('https://test-pages.phpscraper.de/meta/chinese-characters.html');

        // Check the keywords
        $this->assertSame(['加油', '貓'], $web->keywords);
    }
}
