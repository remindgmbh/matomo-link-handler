<?php

declare(strict_types=1);

namespace Remind\MatomoLinkHandler\Tests\Unit\LinkHandler;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use Remind\MatomoLinkHandler\LinkHandler\LinkHandling;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;

#[CoversClass(LinkHandling::class)]
class LinkHandlingTest extends UnitTestCase
{
    private LinkHandling $subject;

    protected function setUp(): void
    {
        parent::setUp();
        $this->subject = new LinkHandling();
    }

    #[Test]
    public function testAsStringBuildsExpectedMatomoUrn(): void
    {
        $actual = $this->subject->asString(['action' => 'download']);

        self::assertSame('t3://matomo?action=download', $actual);
    }

    #[Test]
    public function testResolveHandlerDataReturnsProvidedAction(): void
    {
        $actual = $this->subject->resolveHandlerData(['action' => 'optout']);

        self::assertSame(['action' => 'optout'], $actual);
    }

    #[Test]
    public function testResolveHandlerDataFallsBackToEmptyAction(): void
    {
        $actual = $this->subject->resolveHandlerData([]);

        self::assertSame(['action' => ''], $actual);
    }
}
