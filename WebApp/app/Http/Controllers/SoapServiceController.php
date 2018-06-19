<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SoapServiceController extends Controller
{
    protected $soapWrapper;

    /**
     * SoapController constructor.
     *
     * @param SoapWrapper $soapWrapper
     */
    public function __construct(SoapWrapper $soapWrapper)
    {
        $this->soapWrapper = $soapWrapper;
    }

    /**
     * Use the SoapWrapper
     */
    public function show()
    {
        $this->soapWrapper->add('Currency', function ($service) {
            $service
                ->wsdl()                 // The WSDL url
                ->trace(true)            // Optional: (parameter: true/false)
                ->header()               // Optional: (parameters: $namespace,$name,$data,$mustunderstand,$actor)
                ->customHeader()         // Optional: (parameters: $customerHeader) Use this to add a custom SoapHeader or extended class
                ->cookie()               // Optional: (parameters: $name,$value)
                ->location()             // Optional: (parameter: $location)
                ->certificate()          // Optional: (parameter: $certLocation)
                ->cache(WSDL_CACHE_NONE) // Optional: Set the WSDL cache

                // Optional: Set some extra options
                ->options([
                    'login' => 'username',
                    'password' => 'password'
                ])

                // Optional: Classmap
                ->classmap([
                    GetConversionAmount::class,
                    GetConversionAmountResponse::class,
                ]);
        });

        // Without classmap
        $response = $this->soapWrapper->call('Currency.GetConversionAmount', [
            'CurrencyFrom' => 'USD',
            'CurrencyTo'   => 'EUR',
            'RateDate'     => '2014-06-05',
            'Amount'       => '1000',
        ]);

        var_dump($response);

        // With classmap
        $response = $this->soapWrapper->call('Currency.GetConversionAmount', [
            new GetConversionAmount('USD', 'EUR', '2014-06-05', '1000')
        ]);

        var_dump($response);
        exit;
    }
}
