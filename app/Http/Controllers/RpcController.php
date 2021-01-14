<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use AvtoDev\JsonRpc\Requests\RequestInterface;
use AvtoDev\JsonRpc\Errors\InvalidParamsError;
use AvtoDev\JsonRpc\Errors\ServerError;
use Illuminate\Support\Facades\DB;

class RpcController extends BaseController
{

    /**
     * @return mixed[]
     */
    public function getByDate(RequestInterface $request): array {
        $params = $request->getParams();

        if (!property_exists($params, 'date') || !preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $params->date)) {
            throw new InvalidParamsError('Invalid params', -32602);
        }
        
        $result = DB::select('select * from history where date_at = ?', [$params->date]);

        if (count($result) > 0) {
            $response = current($result)->temp;
        } else {
            throw new ServerError('Not found', -32099);
        }
        
        return [
            'temp' => $response,
        ];
    }

    /**
     * @return mixed[]
     */
    public function getHistory(RequestInterface $request): array{
        $params = $request->getParams();

        if (!property_exists($params, 'lastDays') || !preg_match("/^[0-9]+$/", $params->lastDays)) {
            throw new InvalidParamsError('Invalid params', -32602);
        }

        $result = DB::select('select * from history order by date_at DESC LIMIT 0, ?', [$params->lastDays]);

        return [
            'items' => $result,
        ];
    }
}
