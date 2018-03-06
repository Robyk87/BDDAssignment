<?php

namespace Page;

use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use SensioLabs\Behat\PageObjectExtension\PageObject\Page;

/**
 * Class BasePage for functions used amongst other PageObjects.
 */
class BasePage extends Page
{
    /**
     * Sets Webdriver attention to most recent window/tab.
     * @param $driver
     * @throws \Exception
     */
    public function focusWindow(RemoteWebDriver $driver)
    {
        $handles = $driver->getWindowHandles();
        $driver->switchTo()->window(end($handles));
    }
}