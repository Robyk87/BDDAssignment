Feature: Sign up for a Salesforce Developer Account

  Scenario: Register using a temporary email address

    Given I register a temporary email address at Guerrilla Mail

    And I register a Salesforce Developer account

    And I click the link in my temporary email to confirm my developer account

    When I complete the registration process by setting a password

    Then I should be on the Salesforce Developer instance homepage