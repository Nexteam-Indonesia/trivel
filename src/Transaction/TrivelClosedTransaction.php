<?php

namespace Nexteam\Trivel\Transaction;

use Exception;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;
use Nexteam\Trivel\Dto\Transaction\ClosedTransactionRequest;
use Nexteam\Trivel\Exception\TrivelException;
use Nexteam\Trivel\Utils\TrivelUtils;

class TrivelClosedTransaction
{

    /**
     * @throws TrivelException
     */
    public static function make(ClosedTransactionRequest $request, $retry = 1, $timeoutRetry = 500)
    {

        try {

            $url = sprintf('%s%s', config('trivel.base_url'), '/transaction/create');

            $response = Http::retry($retry, $timeoutRetry, function ($exception, $request) {
                return $exception instanceof ConnectionException;
            }
            )->withBody(json_encode($request->toJson()))
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
