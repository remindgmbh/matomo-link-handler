<?php

namespace Remind\MatomoLinkHandler\LinkHandler;

use Psr\Http\Message\ServerRequestInterface;
use TYPO3\CMS\Backend\Controller\AbstractLinkBrowserController;
use TYPO3\CMS\Backend\LinkHandler\LinkHandlerInterface;
use TYPO3\CMS\Core\Page\PageRenderer;
use TYPO3\CMS\Core\View\ViewInterface;

class LinkHandler implements LinkHandlerInterface
{
    protected array $linkAttributes = ['title'];

    protected array $linkParts = [];

    protected ViewInterface $view;

    protected array $configuration;

    public function __construct(
        private readonly PageRenderer $pageRenderer
    ) {
    }

    public function initialize(AbstractLinkBrowserController $linkBrowser, $identifier, array $configuration)
    {
        $this->configuration = $configuration;
    }

    public function canHandleLink(array $linkParts): bool
    {
        if (!isset($linkParts['type']) || $linkParts['type'] !== 'matomo') {
            return false;
        }
        $this->linkParts = $linkParts['url'] ?? [];
        return true;
    }

    public function formatCurrentUrl(): string
    {
        return 't3://matomo?action=' . $this->linkParts['action'] ?? '';
    }

    public function render(ServerRequestInterface $request): string
    {
        $this->pageRenderer->loadJavaScriptModule('@remind/matomo-link-handler/link_handler.js');
        $this->view->assign('linkParts', $this->linkParts);
        $this->view->assign('action', $this->linkParts['action'] ?? '');

        return $this->view->render('LinkBrowser/Matomo');
    }

    public function getBodyTagAttributes(): array
    {
        return [];
    }

    public function getLinkAttributes()
    {
        return $this->linkAttributes;
    }

    public function modifyLinkAttributes(array $fieldDefinitions)
    {
        return $fieldDefinitions;
    }

    public function isUpdateSupported()
    {
        return false;
    }

    public function setView(ViewInterface $view): void
    {
        $this->view = $view;
    }
}
