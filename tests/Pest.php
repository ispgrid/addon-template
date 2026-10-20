<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/*
| The tests run inside an ISPGrid checkout, with its TestCase, factories and database. From the checkout:
|   ISPGRID_ADDONS=on php vendor/bin/pest --test-directory=vendor/acme/hello/tests vendor/acme/hello/tests
| An add-on with its own database (outside RefreshDatabase's transaction) empties its tables in a beforeEach here.
*/
pest()->extend(TestCase::class)
    ->use(RefreshDatabase::class)
    ->in(__DIR__);
