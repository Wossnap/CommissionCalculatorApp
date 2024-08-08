<?php

namespace Wossnap\CommissionTask\Utils;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;

class HttpClientUtils
{
    public static function getMockedClient(): Client
    {
        $header = [
            'Content-Type' => 'application/json; charset=utf-8'
        ];

        $rateResponse = new Response(200, $header, '{
           "result":"success",
           "provider":"https://www.exchangerate-api.com",
           "documentation":"https://www.exchangerate-api.com/docs/free",
           "terms_of_use":"https://www.exchangerate-api.com/terms",
           "time_last_update_unix":1722902551,
           "time_last_update_utc":"Tue, 06 Aug 2024 00:02:31 +0000",
           "time_next_update_unix":1722990461,
           "time_next_update_utc":"Wed, 07 Aug 2024 00:27:41 +0000",
           "time_eol_unix":0,
           "base_code":"EUR",
           "rates":{
              "EUR":1,
              "AED":4.02209,
              "AFN":77.349534,
              "ALL":100.265481,
              "AMD":424.441971,
              "ANG":1.960393,
              "AOA":987.254866,
              "ARS":1024.825318,
              "AUD":1.685003,
              "AWG":1.960393,
              "AZN":1.860656,
              "BAM":1.95583,
              "BBD":2.190383,
              "BDT":128.668931,
              "BGN":1.95583,
              "BHD":0.411792,
              "BIF":3149.688679,
              "BMD":1.095191,
              "BND":1.449519,
              "BOB":7.542737,
              "BRL":6.271377,
              "BSD":1.095191,
              "BTN":91.933282,
              "BWP":14.959854,
              "BYN":3.51839,
              "BZD":2.190383,
              "CAD":1.51405,
              "CDF":3120.252336,
              "CHF":0.934413,
              "CLP":1040.946521,
              "CNY":7.816779,
              "COP":4518.378964,
              "CRC":572.938104,
              "CUP":26.284593,
              "CVE":110.265,
              "CZK":25.30122,
              "DJF":194.638504,
              "DKK":7.459595,
              "DOP":64.786889,
              "DZD":147.09992,
              "EGP":53.853637,
              "ERN":16.42787,
              "ETB":89.254463,
              "FJD":2.475521,
              "FKP":0.857002,
              "FOK":7.459856,
              "GBP":0.857024,
              "GEL":2.95953,
              "GGP":0.857002,
              "GHS":17.207433,
              "GIP":0.857002,
              "GMD":76.325193,
              "GNF":9489.707224,
              "GTQ":8.481802,
              "GYD":228.832762,
              "HKD":8.529653,
              "HNL":27.114033,
              "HRK":7.5345,
              "HTG":144.343709,
              "HUF":397.24597,
              "IDR":17714.224764,
              "ILS":4.189427,
              "IMP":0.857002,
              "INR":91.931717,
              "IQD":1432.905579,
              "IRR":46504.047046,
              "ISK":150.555922,
              "JEP":0.857002,
              "JMD":170.69693,
              "JOD":0.776491,
              "JPY":157.940396,
              "KES":142.428351,
              "KGS":92.14127,
              "KHR":4511.716216,
              "KID":1.68634,
              "KMF":491.96775,
              "KRW":1494.006098,
              "KWD":0.334158,
              "KYD":0.912659,
              "KZT":525.424861,
              "LAK":25903.980664,
              "LBP":98019.626986,
              "LKR":331.125964,
              "LRD":218.640393,
              "LSL":20.269663,
              "LYD":5.282455,
              "MAD":10.768026,
              "MDL":19.348968,
              "MGA":4936.743666,
              "MKD":61.495,
              "MMK":2818.798703,
              "MNT":3742.044477,
              "MOP":8.784609,
              "MRU":43.528944,
              "MUR":50.786164,
              "MVR":16.857079,
              "MWK":1911.884149,
              "MXN":21.236476,
              "MYR":4.847335,
              "MZN":70.084052,
              "NAD":20.269663,
              "NGN":1744.398463,
              "NIO":40.293021,
              "NOK":12.065808,
              "NPR":147.093251,
              "NZD":1.842728,
              "OMR":0.421098,
              "PAB":1.095191,
              "PEN":4.082297,
              "PGK":4.280407,
              "PHP":63.347269,
              "PKR":305.28695,
              "PLN":4.299341,
              "PYG":8325.194377,
              "QAR":3.986497,
              "RON":4.976715,
              "RSD":117.026273,
              "RUB":93.268431,
              "RWF":1486.363876,
              "SAR":4.106968,
              "SBD":9.249794,
              "SCR":16.121659,
              "SDG":488.824305,
              "SEK":11.548064,
              "SGD":1.449549,
              "SHP":0.857002,
              "SLE":24.661996,
              "SLL":24666.528758,
              "SOS":625.219101,
              "SRD":31.736407,
              "SSP":2501.693395,
              "STN":24.5,
              "SYP":14066.632498,
              "SZL":20.269663,
              "THB":38.769108,
              "TJS":11.67246,
              "TMT":3.831676,
              "TND":3.386428,
              "TOP":2.56604,
              "TRY":36.572784,
              "TTD":7.771706,
              "TVD":1.68634,
              "TWD":35.74736,
              "TZS":2953.623218,
              "UAH":45.086815,
              "UGX":4080.74245,
              "USD":1.095182,
              "UYU":43.96527,
              "UZS":13784.316972,
              "VES":40.211677,
              "VND":27508.097685,
              "VUV":131.810921,
              "WST":2.99526,
              "XAF":655.957,
              "XCD":2.957017,
              "XDR":0.818711,
              "XOF":655.957,
              "XPF":119.332,
              "YER":273.925122,
              "ZAR":20.269624,
              "ZMW":28.404286,
              "ZWL":14.6681
           }
        }');

        $mock = new MockHandler([
            new Response(200, $header, '{
                "number":{
        
                },
                "scheme":"visa",
                "type":"debit",
                "brand":"Visa Classic",
                "country":{
                    "numeric":"208",
                    "alpha2":"DK",
                    "name":"Denmark",
                    "emoji":"🇩🇰",
                    "currency":"DKK",
                    "latitude":56,
                    "longitude":10
                },
                "bank":{
                    "name":"Jyske Bank A/S"
                }
            }'),//45717360
            $rateResponse,
            new Response(200, $header, '{
                "number":{
        
                },
                "scheme":"mastercard",
                "type":"debit",
                "brand":"Debit Mastercard",
                "country":{
                    "numeric":"440",
                    "alpha2":"LT",
                    "name":"Lithuania",
                    "emoji":"🇱🇹",
                    "currency":"EUR",
                    "latitude":56,
                    "longitude":24
                },
                "bank":{
                    "name":"Swedbank Ab"
                }
            }'),//516793
            $rateResponse,
            new Response(200, $header, '{
                "number":{
        
                },
                "scheme":"visa",
                "type":"credit",
                "brand":"Visa Classic",
                "country":{
                    "numeric":"392",
                    "alpha2":"JP",
                    "name":"Japan",
                    "emoji":"🇯🇵",
                    "currency":"JPY",
                    "latitude":36,
                    "longitude":138
                },
                "bank":{
                    "name":"Credit Saison Co., Ltd."
                }
            }'),//45417360
            $rateResponse,
            new Response(200, $header, '{
                "number": {},
                "scheme": "american express",
                "type": "credit",
                "country": {
                    "numeric": "840",
                    "alpha2": "US",
                    "name": "United States of America (the)",
                    "emoji": "🇺🇸",
                    "currency": "USD",
                    "latitude": 38,
                    "longitude": -97
                },
                "bank": {}
            }'),//41417360 - not working so used the bin number - 371270
            $rateResponse,
            new Response(200, $header, '{
                "number":{
        
                },
                "scheme":"visa",
                "type":"debit",
                "brand":"Visa Classic",
                "country":{
                    "numeric":"440",
                    "alpha2":"LT",
                    "name":"Lithuania",
                    "emoji":"🇱🇹",
                    "currency":"EUR",
                    "latitude":56,
                    "longitude":24
                },
                "bank":{
                    "name":"Uab Finansines Paslaugos Contis"
                }
            }'),//4745030
            $rateResponse,
        ]);

        $handlerStack = HandlerStack::create($mock);
        return new Client(['handler' => $handlerStack]);
    }
}
