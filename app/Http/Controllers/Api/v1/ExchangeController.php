<?php

namespace App\Http\Controllers\Api\v1;

use App\Facades\CurrencyConventor;
use App\Http\Controllers\Controller;
use App\Servicies\CurrencyConventor\IExchange;
use App\Servicies\CurrencyConventor\InvalidRateException;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use InvalidArgumentException;

class ExchangeController extends Controller
{

    public function change(Request $request, IExchange $exchange) {

        try {

            $request->validate([
                'from'   => 'required|string|min:3|max:3',
                'to'     => 'required|string|min:3|max:3',
                'amount' => 'required|numeric|gt:0',
                'is_floor' => 'boolean',
                'is_format' => 'boolean',
            ]);

            $amount = CurrencyConventor::setExchange($exchange)
            ->from($request->from)
            ->to($request->to)
            ->amount($request->amount)
            ->conver();

            $success = true;

        } catch (ValidationException  $e) {
            $success = false;
            $errCode = 406;
            $errMsg = $e->getMessage();

        } catch (InvalidRateException $e) {
            $success = false;
            $code = 404;
            $errMsg = $e->getMessage();
        } catch (InvalidArgumentException $e) {
            $success = false;
            $errCode = 422;
            $errMsg = $e->getMessage();
        } catch (\Throwable $e) {
            $errCode = 400;
            $errMsg = $e->getMessage();
        }

        $success = $success?? false;
        $from    = $request->from ?? '';
        $to      = $request->to ?? '';
        $rate    = $success ? CurrencyConventor::getRate() : 99999;
        $amount  = $amount ?? 99999;
        $code    = $code ?? 200;
        $errMsg  = $errMsg ?? '';
        $errCode = $errCode ?? 0;

        return response()->json([
            'success' => $success,
            'params'  => [
                'from' => $from,
                'to'   => $to
            ],
            'rate'   => $rate,
            'err_msg' => $errMsg,
            'err_code' => $errCode,
            'result' => $amount
        ]
        , $code);


    }


}
