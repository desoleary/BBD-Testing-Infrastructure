<?php

namespace Tests\Behaviours;

trait HasRequestBuilderBehaviourSteps
{

    /**
     * Adds a new request builder for each row and persist them into the database.
     * Should only be used as part of a background step.
     *
     * @Given /^an "([^"]*)" table with the following information:$/
     * @param string $type
     * @param array $rows
     */
    final public function anTableWithTheFollowingInformation(string $type, array $rows): void
    {
        $this->getTransactionRequest()->persistBackgroundModels($type, $rows);
    }

    /**
     * Add new request builder of $type but will not persist the model to the database.
     * NOTE: Should only be used as part of a scenario step.
     *
     * @Given /^I add the following "([^"]*)":$/
     * @param string $type
     * @param array $rows
     */
    final public function iAddTheFollowing(string $type, array $rows): void
    {
        $this->getTransactionRequest()->addScenarioModels($type, $rows);
    }

    /**
     * @When /^I fill in the following inputs for "([^"]*)":$/
     * @param string $reference
     * @param array $rows
     */
    final public function iFillInTheFollowingInputsFor(string $reference, array $rows): void
    {
        $this->getTransactionRequest()->fillInInputsFor($reference, $rows);
    }

}