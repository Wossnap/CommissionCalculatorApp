# Wossnap Refactor Commission App

Follow the following steps:

- run composer install
- run ```php src/App.php input.txt```
- if you run accross a 429 error you can add in .env file with the following 
  to mock the http request 

  ```USE_MOCKED_HTTP_CLIENT=true```

- to run the test you can run ```./bin/phpunit```

Thank You! :) 
