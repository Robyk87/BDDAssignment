<?php

namespace Page;

use Facebook\WebDriver\WebDriverExpectedCondition;
use Facebook\WebDriver\WebDriverBy;
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

    /**
     * Set Up Email from GuerrillaMail.
     * @param string $email_address.
     * @param $driver
     * @throws \Exception
     */
    public function setUpEmail(RemoteWebDriver $driver, $email_address)
    {
        // Explicit wait for page to load.
        $driver->wait()->until(WebDriverExpectedCondition::titleContains('Guerrilla Mail'));

        // Creates new Email.
        sleep(2);
        $driver->findElement(WebDriverBy::id('forget_button'))->click();
        sleep(3);
        $driver->findElement(WebDriverBy::cssSelector("[title='Click to Edit'] input[type='text']"))
            ->sendKeys($email_address);
        sleep(5);
        $driver->findElement(WebDriverBy::cssSelector('button.small.save.button'))->click();
        sleep(5);
    }
}