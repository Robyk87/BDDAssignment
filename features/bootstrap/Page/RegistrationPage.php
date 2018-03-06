<?php

namespace Page;

use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverExpectedCondition;
use Facebook\WebDriver\WebDriverBy;

/**
 * Class RegistrationPage PageObject for RegistrationPage.
 */
class RegistrationPage extends BasePage
{
    /**
     * Fill in Form Details on RegistrationPage.
     *
     * @param $driver
     * @param string $email_address
     * @return string
     * @throws \Exception
     */
    public function fillInFormDetails(RemoteWebDriver $driver, $email_address)
    {

       // Explicit wait for Salesforce website to load.
       $driver->wait()->until(WebDriverExpectedCondition::titleIs('Salesforce Developers'));

        // Fill-in Form Data.
       $driver->findElement(WebDriverBy::id('first_name'))->click()->sendKeys('Jack');
       $driver->findElement(WebDriverBy::id('last_name'))->click()->sendKeys('Black');
       $driver->findElement(WebDriverBy::id('email'))->click()->sendKeys($email_address . '@sharklasers.com');
       $driver->findElement(WebDriverBy::id('company'))->click()->sendKeys('The Good Company');
       $driver->findElement(WebDriverBy::id('postal_code'))->click()->sendKeys('48449');
       $driver->findElement(WebDriverBy::id('username'))->click()->sendKeys($email_address . '@sharklasers.com');
       sleep(3);
       $driver->findElement(WebDriverBy::name('eula'))->click();

       // Long sleep for user to select captcha
       sleep(30);
       $driver->findElement(WebDriverBy::id('submit_btn'))->click();

       // Wait for Success window to load.
       $driver->wait()->until(WebDriverExpectedCondition::urlIs('https://developer.salesforce.com/signup/success'));
       sleep(5);

       $driver->quit();
    }
}


