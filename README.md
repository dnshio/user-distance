Shortest path between two github users
========================

# Quickstart
1. Clone this repository
2. From project root, run `composer install`
3. Add the correct database configurations to `app/config/parameters.yml` 

    ```
    database_host: 127.0.0.1    
    database_port:     
    database_name:     
    database_user:     
    database_password:     
    ```
    
4. Run (from project root) `bin/console db:load_fixtures -e test` to load test data in to database
5. Run `bin/console server:run -e test` to start the built in server
6. Make a request to `http://127.0.0.1:8000/user/dnshio/distance/Seldaek` get a sample distance response

In order to run the test suite, simply run `phpunit` from the project root.

Tests that are of interest are located in `Tests\Dnshio\Domain\Github\HopCounterTest`

Notes
============
This app does not make any network calls to the github API. Please take a look at the data loaded on to the database 
after quickstart step 4 in order to understand what the existing connections are like. 

I planned to implement `Dnshio\Bridge\Github\Api` class which would have contained the code required to communicate with 
and deserialize data from github API. Unfortunately I ran out of time so I ask you to assume that this class would be finished 
in the final implementation. Switching between prod and test modes are done as per Symfony framework convention (by routing
through app.php for prod and app_test.php for test). Symfony DI container would then inject the correct data provider
based on the environment (test or prod). Take a look at `Dnshio\Bundle\GithubBundle\DependencyInjection\DnshioGithubExtension` 
to see how this is done.

