<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Tests\Integration\Pricing\V1\Voice;

use Twilio\Exceptions\DeserializeException;
use Twilio\Exceptions\TwilioException;
use Twilio\Http\Response;
use Twilio\Tests\HolodeckTestCase;
use Twilio\Tests\Request;

class NumberTest extends HolodeckTestCase {
    public function testFetchRequest() {
        $this->holodeck->mock(new Response(500, ''));
        
        try {
            $this->twilio->pricing->v1->voice
                                      ->numbers("+987654321")->fetch();
        } catch (DeserializeException $e) {}
          catch (TwilioException $e) {}
        
        $this->assertRequest(new Request(
            'get',
            'https://pricing.twilio.com/v1/Voice/Numbers/%2B987654321'
        ));
    }

    public function testFetchResponse() {
        $this->holodeck->mock(new Response(
            200,
            '
            {
                "country": "United States",
                "inbound_call_price": {
                    "base_price": null,
                    "current_price": null,
                    "number_type": null
                },
                "iso_country": "US",
                "number": "+987654321",
                "outbound_call_price": {
                    "base_price": "0.015",
                    "current_price": "0.015"
                },
                "price_unit": "USD",
                "url": "https://pricing.twilio.com/v1/Voice/Numbers/+987654321"
            }
            '
        ));
        
        $actual = $this->twilio->pricing->v1->voice
                                            ->numbers("+987654321")->fetch();
        
        $this->assertNotNull($actual);
    }
}