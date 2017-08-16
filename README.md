# secure-api
Repository for the "[Building a Secure API](https://websec.io/tagged/secureapi)" series on [Websec.io](https://websec.io)

## To use this project

1. Clone the repository:

```
git clone git@github.com:psecio/secure-api.git
```

2. Change over to the `public/` directory
3. Use the built-in PHP web server to handle requests

```
php -S localhost:8000
```

Then go to `http://localhost:8000` in a browser to view the result.

## Test client

The file `test-client.php` contains an example of the HTTP client making a request to the API key with the flow created in the tutorial series. You'll need to install Guzzle to have it work correctly. Install it via Composer with:

```
composer require guzzlehttp/guzzle
```

Then you can run it with: `php test-client.php`. If all goes well you should get the "validation success" message back from the last call to the API.

## The Series

- [Part 1](https://websec.io/2017/04/14/Build-Secure-API-Part1.html)
- [Part 2](https://websec.io/2017/04/14/Build-Secure-API-Part2.html)
- [Part 3](https://websec.io/2017/04/14/Build-Secure-API-Part3.html)
- [Part 4](https://websec.io/2017/06/21/Build-Secure-API-Part4.html)
- [Part 5](https://websec.io/2017/08/16/Build-Secure-API-Part3.html)
