<?php
defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Plugin\CMSPlugin;
use Joomla\CMS\Document\HtmlDocument;

final class PlgSystemRemove_powered_by_kunena_links extends CMSPlugin
{
    public function onAfterRender(): void
    {
        $app = Factory::getApplication();

        // Only for frontend
        if (!$app->isClient('site')) {
            return;
        }

        // Only for Kunena pages
        $input = $app->getInput();
        if ($input->getCmd('option') !== 'com_kunena') {
            return;
        }

        $doc = $app->getDocument();

        // Only for HTML documents
        if (!($doc instanceof HtmlDocument)) {
            return;
        }

        $body = $app->getBody();

        // Remove links matching specific patterns from the HTML
        $body = preg_replace('~<a[^>]+href="[^"]*credits\.html"[^>]*>.*?</a>~i', '', $body);
        $body = preg_replace('~<a[^>]+href="[^"]*kunena\.org"[^>]*>.*?</a>~i', '', $body);

        $app->setBody($body);
    }
}