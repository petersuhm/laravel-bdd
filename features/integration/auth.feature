Feature: Authenticating a user
  In order to access restricted content
  As a user
  I need to be able to authenticate myself

  Scenario: Authenticating a user with valid credentials
    Given I am registered with the credentials:
      | email           | password |
      | foo@example.com | foob@r   |
    When I attempt to authenticate myself with the credentials:
      | email           | password |
      | foo@example.com | foob@r   |
    Then I should see that I am successfully authenticated

  Scenario: Authenticating a user with invalid credentials
    Given I am registered with the credentials:
      | email           | password |
      | foo@example.com | foob@r   |
    When I attempt to authenticate myself with the credentials:
      | email           | password |
      | foo@example.com | foobar   |
    Then I should see that I am not authenticated
