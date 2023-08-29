<?php

namespace Nexteam\Trivel\Transaction;

use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;
use Nexteam\Trivel\Dto\Transaction\ClosedTransactionRequest;
use Nexteam\Trivel\Exception\TrivelException;
use Nexteam\Trivel\Utils\TrivelUtils;

class TrivelClosedTransaction
{

    public static function make(ClosedTransactionRequest $request)
    {

        try {

            $url = sprintf('%s%s', config('trivel.base_url'), '/transaction/create');

            $response = Http::withBody(json_encode($request->toJson()))
                ->withToken(config('trivel.api_key'), 'Bearer')
                ->post($url);

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
