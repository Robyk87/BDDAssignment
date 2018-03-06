<?php

namespace Page;

use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverExpectedCondition;
use Facebook\WebDriver\WebDriverBy;

/**
 * Class GuerrillaMailPage PageObject for GuerrillaMail.
 */
class GuerrillaMailPage extends BasePage
{
    /**
     * Grab New Email from GuerrillaMail.
     * @param string $email_address.
     * @param $driver
     * @throws \Exception
     */
    public function grabNewEmail(RemoteWebDriver $driver, $email_address)
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

        // Closes Window.
        $driver->quit();
    }

    /**
     * Verify email from Sales Force
     *
     * @param $driver
     * @param string $email_address
     * @throws \Exception
     */
    public function verifyEmail(RemoteWebDriver $driver, $email_address)
    {
        $driver->wait()->until(WebDriverExpectedCondition::titleContains('Guerrilla Mail'));

        // Log into email created earlier.
        sleep(2);
        $driver->findElement(WebDriverBy::id('forget_button'))->click();
        sleep(3);
        $driver->findElement(WebDriverBy::cssSelector("[title='Click to Edit'] input[type='text']"))
            ->sendKeys($email_address);
        sleep(5);
        $driver->findElement(WebDriverBy::cssSelector('button.small.save.button'))->click();
        sleep(5);

        // Explicit wait for email to populate before selecting.
        $element = $driver->findElement(WebDriverBy::cssSelector('td.td2'));
        $driver->wait(60, 1000)->until(
            WebDriverExpectedCondition::visibilityOf($element))->click();

        // Click on Verify Account.
        $driver->findElement(WebDriverBy::partialLinkText('Verify Account'))->click();
        sleep(5);
    }
}