<?php

use Behat\Behat\Context\Context;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Page\GuerrillaMailPage;
use Page\RegistrationPage;
use Page\ChangeYourPasswordPage;
use Page\HomePage;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context
{
    private $guerrillaMailPage;
    private $registrationPage;
    private $changeYourPasswordPage;
    private $homePage;
    private $randomString;
    private $currentDriver;

    /**
     * FeatureContext constructor.
     *
     * @param GuerrillaMailPage      $guerrillaMailPage       PageObject for GuerrillaMailPage.
     * @param RegistrationPage       $registrationPage        PageObject for RegistrationPage.
     * @param ChangeYourPasswordPage $changeYourPasswordPage  PageObject for ChangeYourPasswordPage.
     * @param HomePage               $homePage                PageObject for HomePage.
     */
    public function __construct(
        GuerrillaMailPage $guerrillaMailPage,
        RegistrationPage $registrationPage,
        ChangeYourPasswordPage $changeYourPasswordPage,
        HomePage $homePage
    )

    {
        $this->guerrillaMailPage = $guerrillaMailPage;
        $this->registrationPage = $registrationPage;
        $this->changeYourPasswordPage = $changeYourPasswordPage;
        $this->homePage = $homePage;
        $this->randomString = $this->generateRandomStringForEmail();
    }

    /**
     * @Given /^I register a temporary email address at Guerrilla Mail$/
     * @throws \Exception
     */
    public function iRegisterATemporaryEmailAddressAtGuerrillaMail()
    {
        $driver = $this->createDriver('https://www.guerrillamail.com/');
        $this->guerrillaMailPage->grabNewEmail($driver, $this->randomString);
    }

    /**
     * @Given /^I register a Salesforce Developer account$/
     * @throws \Exception
     */
    public function iRegisterASalesforceDeveloperAccount()
    {
        $driver = $this->createDriver('https://developer.salesforce.com/signup');
        $this->registrationPage->fillInFormDetails($driver, $this->randomString);
    }

    /**
     * @Given /^I click the link in my temporary email to confirm my developer account$/
     * @throws \Exception
     */
    public function iClickTheLinkInMyTemporaryEmailToConfirmMyDeveloperAccount()
    {
        $driver = $this->createDriver('https://www.guerrillamail.com/');
        $this->guerrillaMailPage->verifyEmail($driver, $this->randomString);
    }

    /**
     * @When /^I complete the registration process by setting a password$/
     * @throws \Exception
     */
    public function iCompleteTheRegistrationProcessBySettingAPassword()
    {
        $this->changeYourPasswordPage->createNewPassword($this->currentDriver);
    }

    /**
     * @Then /^I should be on the Salesforce Developer instance homepage$/
     * @throws \Exception
     */
    public function iShouldBeOnTheSalesforceDeveloperInstanceHomepage()
    {
        $this->homePage->verifyHomePage($this->currentDriver);
    }

    /**
     * Create new RemoteWebdriver.
     *
     * @param $baseURL
     * @return RemoteWebDriver
     */
    public function createDriver($baseURL)
    {
        $driver = RemoteWebDriver::create('http://localhost:4444/wd/hub', DesiredCapabilities::chrome());
        $driver->get($baseURL);
        $driver->manage()->timeouts()->implicitlyWait(20);
        $this->currentDriver = $driver;
        return $driver;
    }

    /**
     * Generate random string to use as an email address.
     */
    public static function  generateRandomStringForEmail()
    {
        // Generate random string for Email implementation.
        $randomString = bin2hex(openssl_random_pseudo_bytes(10));
        return $randomString;
    }

}