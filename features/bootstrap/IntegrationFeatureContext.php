<?php

use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

use Suhm\Entity\User;

/**
 * Behat context class.
 */
class IntegrationFeatureContext implements SnippetAcceptingContext
{
    use LaravelBdd\Behat\Laravel;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context object.
     * You can also pass arbitrary arguments to the context constructor through behat.yml.
     */
    public function __construct()
    {
        $this->prepareApplication(__DIR__.'/../../bootstrap/start.php');
    }

    /**
     * @Given I am registered with the credentials:
     */
    public function iAmRegisteredWithTheCredentials(TableNode $table)
    {
        $credentials = $table->getHash()[0];

        $userRepository = $this->app['Suhm\Storage\UserRepository'];

        $user = $userRepository->newInstance([
            'email' => $credentials['email'],
            'password' => Hash::make($credentials['password'])
        ]);

        $userRepository->persist($user);
    }

    /**
     * @When I attempt to authenticate myself with the credentials:
     */
    public function iAttemptToAuthenticateMyselfWithTheCredentials(TableNode $table)
    {
        $credentials = $table->getHash()[0];

        $this->authenticated = $this->app['auth']->attempt($credentials);
    }

    /**
     * @Then I should see that I am successfully authenticated
     */
    public function iShouldSeeThatIAmSuccessfullyAuthenticated()
    {
        if ( ! $this->authenticated) {
            throw new Exception("Expected to be authenticated but was not");

        }
    }

    /**
     * @Then I should see that I am not authenticated
     */
    public function iShouldSeeThatIAmNotAuthenticated()
    {
        if ($this->authenticated) {
            throw new Exception("Expected not to be authenticated but was");

        }
    }
}
