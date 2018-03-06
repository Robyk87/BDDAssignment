<?php

namespace Page;

use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverExpectedCondition;

/**
 * Class HomePage for Salesforce.
 */
class HomePage extends BasePage
{
    /**
     * verifyHomePage
     *
     * @param $driver
     * @throws \Exception
     */
    public function verifyHomePage(RemoteWebDriver $driver)
    {
        // Changes focus to current tab
        $this->focusWindow($driver);

        // Explicit wait for page title to load.
        $driver->wait()->until(WebDriverExpectedCondition::titleIs('Home | Salesforce'));

        // Sleep to keep page open longer.
        sleep(10);

        //Close Webdriver.
        $driver->quit();
    }
}