<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MailingTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    /**
     *
     */
    public function testBackendEndIndex()
    {

    }

    /**
     *
     */
    public function testMailingDestory()
    {

    }

    /**
     *
     */
    public function testNewsLetterDestroy()
    {

    }

    /**
     *
     */
    public function testNewsLetterCreateWithErrors()
    {

    }

    public function testNewsLetterInsertWithoutErrors()
    {

    }

    /**
     *
     */
    public function testMailingInsertWithError()
    {

    }

    /**
     *
     */
    public function testMailingInsertWithoutError()
    {

    }

    /**
     *
     */
    public function testMailingUpdateWithoutErrors()
    {
        $this->authentication();
    }

    /**
     *
     */
    public function testMailingUpdateWithErrors()
    {
        $this->authentication();
    }
}
