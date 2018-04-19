<?php
/**
 * Created by PhpStorm.
 * User: zhengchaohua
 * Date: 2018/4/14
 * Time: 上午9:12
 */
namespace App\Http\Controllers\Api\V1\Common;

use App\Http\Controllers\Controller;
use Dingo\Api\Http\Response;

class ImageController extends BaseController
{
    public function test()
    {
        return $this->response->error('错误123信息',404);
    }
}