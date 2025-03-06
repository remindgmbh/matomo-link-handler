<?php

declare(strict_types=1);

namespace Remind\MatomoLinkHandler\LinkHandler;

use Psr\Http\Message\ServerRequestInterface;
use TYPO3\CMS\Backend\Controller\AbstractLinkBrowserController;
use TYPO3\CMS\Backend\LinkHandler\LinkHandlerInterface;
use TYPO3\CMS\Core\Page\PageRenderer;
use TYPO3\CMS\Core\View\ViewInterface;

class LinkHandler implements LinkHandlerInterface
{
    /**
     * @var mixed[]
     */
    protected array $linkAttributes = ['title'];

    /**
     * @var mixed[]
     */
    protected array $linkParts = [];

    protected ViewInterface $view;

    /**
     * @var mixed[]
     */
    protected array $configuration;

    public function __construct(
        private readonly PageRenderer $pageRenderer
    ) {
    }

    /**
     * @phpcsSuppress SlevomatCodingStandard.Functions.UnusedParameter
     * @phpcsSuppress SlevomatCodingStandard.TypeHints.ParameterTypeHint
     * @param mixed[] $configuration
     */
    public function initialize(AbstractLinkBrowserController $linkBrowser, $identifier, array $configuration): void
    {
        $this->configuration = $configuration;
    }

    /**
     * @param mixed[] $linkParts
     */
    public function canHandleLink(array $linkParts): bool
    {
        if (
            !isset($linkParts['type']) ||
            $linkParts['type'] !== 'matomo'
        ) {
            return false;
        }
        $this->linkParts = $linkParts['url'] ?? [];
        return true;
    }

    public function formatCurrentUrl(): string
    {
        return 't3://matomo?action=' . ($this->linkParts['action'] ?? '');
    }

    /**
     * @phpcsSuppress SlevomatCodingStandard.Functions.UnusedParameter
     */
    public function render(ServerRequestInterface $request): string
    {
        $this->pageRenderer->loadJavaScriptModule('@remind/matomo-link-handler/link_handler.js');
        $this->view->assign('linkParts', $this->linkParts);
        $this->view->assign('action', $this->linkParts['action'] ?? '');

        return $this->view->render('LinkBrowser/Matomo');
    }

    /**
     * @return mixed[]
     */
    public function getBodyTagAttributes(): array
    {
        return [];
    }

    /**
     * @return mixed[]
     */
    public function getLinkAttributes(): array
    {
        return $this->linkAttributes;
    }

    /**
     * @param mixed[] $fieldDefinitions
     * @return mixed[]
     */
    public function modifyLinkAttributes(array $fieldDefinitions): array
    {
        return $fieldDefinitions;
    }

    public function isUpdateSupported(): bool
    {
        return false;
    }

    public function setView(ViewInterface $view): void
    {
        $this->view = $view;
    }
}
