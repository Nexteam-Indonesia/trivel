<?php

namespace Nexteam\Trivel\Payment;

use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;
use Nexteam\Trivel\Dto\Payment\InstructionPaymentRequest;
use Nexteam\Trivel\Exception\TrivelException;

class TrivelPayment
{

    /**
     * @throws TrivelException
     */
    public static function instruction(InstructionPaymentRequest $request)
    {
        try {

            $url = sprintf('%s%s', config('trivel.base_url'), '/payment/instruction');

            $response = Http::withBody(json_encode($request->toJson()))
                ->withToken(config('trivel.api_key'), 'Bearer')
                ->get($url);

            $response->throw();

            $body = json_decode($response->body(), true);

            return $body['data'];
        } catch (RequestException $exception) {
            throw  TrivelException::process($exception->response->json()['message']);
        } catch (\Exception $exception) {
            throw  TrivelException::process($exception->getMessage());
        }

    }

}
