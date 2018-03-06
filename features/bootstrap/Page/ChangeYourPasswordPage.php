<?php
namespace Page;

use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverExpectedCondition;
use Facebook\WebDriver\WebDriverBy;

/**
 * Class ChangeYourPasswordPage ClassObject for Change Your Password Page.
 */
class ChangeYourPasswordPage extends BasePage
{
    /**
     * Verify email from Sales Force
     *
     * @param $driver
     * @throws \Exception
     */
    public function createNewPassword(RemoteWebDriver $driver)
    {
        // Focus on current tab.
        $this->focusWindow($driver);
        //Explicit wait for page to load.
        $driver->wait()->until(WebDriverExpectedCondition::titleIs('Change Your Password | Salesforce'));

        // Fill in form to create password.
        $driver->findElement(WebDriverBy::id('newpassword'))->click()->sendKeys("PassWordsAreFun99");
        $driver->findElement(WebDriverBy::id('confirmpassword'))->click()->sendKeys("PassWordsAreFun99");
        $driver->findElement(WebDriverBy::id('answer'))->click()
            ->sendKeys('Detroit');
        $driver->findElement(WebDriverBy::id('password-button'))->click();
    }
}