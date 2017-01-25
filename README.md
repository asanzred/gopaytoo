# asanzred/gopaytoo

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Total Downloads][ico-downloads]][link-downloads]

## Install

Via Composer

``` bash
$ composer require asanzred/gopaytoo
```

Add ServiceProvider in your `app.php` config file.

```php
// config/app.php
'providers' => [
    ...
    Asanzred\Gopaytoo\GopaytooServiceProvider::class,
]
```

and instead on aliases

```php
// config/app.php
'aliases' => [
    ...
    'Paytoo'           => Asanzred\Gopaytoo\Facade::class,
]
```

## Configuration

Publish the config by running:

``` bash
    php artisan config:publish asanzred/gopaytoo
```

## Usage

You can find an GopaytooController.php and routes.php with test routes and calls

``` php
use Paytoo;
use Asanzred\Gopaytoo\Libraries\MerchantApiResponse;
use Asanzred\Gopaytoo\Libraries\PaytooAccountType;
use Asanzred\Gopaytoo\Libraries\PaytooCreditCardType;
use Asanzred\Gopaytoo\Libraries\PaytooDocumentType;
use Asanzred\Gopaytoo\Libraries\PaytooPaymentRequestType;
use Asanzred\Gopaytoo\Libraries\PaytooRequestDocumentType;
use Asanzred\Gopaytoo\Libraries\PaytooRequestSearchCriterias;
use Asanzred\Gopaytoo\Libraries\PaytooRequestType;
use Asanzred\Gopaytoo\Libraries\PaytooTransactionType;

...

public function test()
    {
        $a = new PaytooAccountType();
        $b = new PaytooCreditCardType();

        $CreditCard= new PaytooCreditCardType ();
        $CreditCard->cc_type = "VISA";
        // mandatory
        $CreditCard->cc_holder_name = "DEMO USER";
        // mandatory
        $CreditCard->cc_number = "4444333322221111";
        // mandatory
        $CreditCard->cc_cvv = "123";
        // mandatory
        $CreditCard->cc_month = "12";
        // mandatory
        $CreditCard->cc_year = "14";
        // mandatory
        $Customer= new PaytooAccountType ();
        $Customer->email = "demo@paytoo.com ";
        // mandatory
        $Customer->firstname = "Demo";
        // mandatory
        $Customer->lastname = "User";
        // mandatory
        $Customer->address = "200 SW 1st Avenue";
        $Customer->city = "Fort Lauderdale";
        $Customer->zipcode = "33301";
        $Customer->state = "FL";
        $Customer->country = "US";
        $amount= 16.00;
        // mandatory
        $currency= 'USD';
        // mandatory
        //echo "Processing Credit Card Sale<br>";
        $ref_id= rand(1000, 9999);
        // mandatory
        $description= "Order #".$ref_id." with Paytoo Merchant";
        $addinfo= "";

        $response = Paytoo::CreditCardSingleTransaction($CreditCard, $Customer, $amount, $currency, $ref_id, $description);

        if($response && $response->status == 'OK') {
            
            // Do your stuff
            return $response;

        }else{
            \Log::error($response->status . " -". $response->msg);
        }
        
    }


```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.

## Security

If you discover any security related issues, please email asanzred@gmail.com instead of using the issue tracker.

## Credits

- [Alberto Sanz Redondo][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/asanzred/gopaytoo.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/asanzred/gopaytoo.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/asanzred/gopaytoo
[link-downloads]: https://packagist.org/packages/asanzred/gopaytoo
[link-author]: https://github.com/asanzred
[link-contributors]: ../../contributors

