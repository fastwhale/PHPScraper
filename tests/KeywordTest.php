<?php

namespace Fastwhale\PHPScraper\Tests;

class KeywordTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     */
    public function testKeywordExtraction()
    {
        $web = new \Fastwhale\PHPScraper\PHPScraper;

        // Navigate to the test page.
        // It contains 3 paragraphs from the English Wikipedia article for "lorem ipsum"
        $web->go('https://test-pages.phpscraper.de/content/keywords.html');

        // Check the keywords on this case...
        $keywords = $web->contentKeywords;

        // A selected list of keywords to expect
        $shouldKeywords = [
            '1960s',
            'added',
            'adopted lorem ipsum',
            'advertisements',
            'aldus employed',
            'corrupted version',
            'graphic',
            'improper latin',
            'introduced',
            'keyword extraction tests',
            'test',
            'microsoft word',
            'english wikipedia',
            'lorem ipsum',
            'lorem ipsum text',
        ];

        // Check if all are part of the output
        foreach ($shouldKeywords as $keyword) {
            $this->assertTrue(
                in_array($keyword, $keywords),
                sprintf('"%s" is missing', $keyword)
            );
        }
    }

    /**
     * @test
     */
    public function testKeywordExtractionWithScores()
    {
        $web = new \Fastwhale\PHPScraper\PHPScraper;

        // Navigate to the test page.
        // It contains 3 paragraphs from the English Wikipedia article for "lorem ipsum"
        $web->go('https://test-pages.phpscraper.de/content/keywords.html');

        // Check the keywords on this case...
        $keywords = $web->contentKeywordsWithScores;

        // A selected list of keywords to expect
        $shouldKeywords = [
            'added' => 1.0,
            'adopted lorem ipsum' => 11.0,
            'advertisements' => 1.0,
            'aldus employed' => 4.0,
            'corrupted version' => 4.0,
            'graphic' => 1.0,
            'improper latin' => 4.0,
            'introduced' => 1.0,
            'keyword extraction tests' => 9.0,
            'test' => 1.0,
            'microsoft word' => 5.3333333333333,
            'english wikipedia' => 4.0,
            'lorem ipsum' => 8.0,
            'lorem ipsum text' => 11.0,
        ];

        // Check if all are part of the output with the expected score
        foreach ($shouldKeywords as $keyword => $score) {
            // Has the same score
            $this->assertSame(
                round($keywords[$keyword], 8),
                round($score, 8),
                sprintf('Score for "%s" is incorrect', $keyword)
            );
        }
    }
}
