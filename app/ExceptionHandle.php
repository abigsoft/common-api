<?php

namespace app;

use app\exception\BaseException;
use ErrorException;
use think\db\exception\DataNotFoundException;
use think\db\exception\ModelNotFoundException;
use think\exception\ClassNotFoundException;
use think\exception\FuncNotFoundException;
use think\exception\Handle;
use think\exception\HttpException;
use think\exception\HttpResponseException;
use think\exception\ValidateException;
use think\Response;
use think\template\exception\TemplateNotFoundException;
use Throwable;

/**
 * 应用异常处理类
 */
class ExceptionHandle extends Handle
{
    /**
     * 不需要记录信息（日志）的异常类列表
     * @var array
     */
    protected $ignoreReport = [
        HttpException::class,
        HttpResponseException::class,
        ModelNotFoundException::class,
        DataNotFoundException::class,
        ValidateException::class,
    ];

    /**
     * 记录异常信息（包括日志或者其它方式记录）
     *
     * @access public
     * @param Throwable $exception
     * @return void
     */
    public function report(Throwable $exception): void
    {
        // 使用内置的方式记录异常日志
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @access public
     * @param \think\Request $request
     * @param Throwable $e
     * @return Response
     */
    public function render($request, Throwable $e): Response
    {
        // 添加自定义异常处理机制
        //方法不存在
        if ($e instanceof FuncNotFoundException) {
            if ($request->isAjax()) {
                return json(['status' => config('my.errorCode'), 'msg' => $e->getFunc() . '方法不存在', 'data' => '']);
            } else {
                return response($e->getFunc() . '控制器不存在', 404);
            }
        }

        //控制器不存在
        if ($e instanceof ClassNotFoundException) {
            if ($request->isAjax()) {
                return json(['status' => config('my.errorCode'), 'msg' => $e->getClass() . '控制器不存在', 'data' => '']);
            } else {
                return response($e->getClass() . '控制器不存在', 404);
            }
        }

        //模板不存在
        if ($e instanceof TemplateNotFoundException) {
            return response($e->getTemplate() . '模板不存在', 404);
        }

        //验证器异常
        if ($e instanceof ValidateException) {
            return json(['status' => config('my.errorCode'), 'msg' => $e->getError(), 'data' => '']);
        }


        //error系统层面错误异常
        if ($e instanceof ErrorException) {
            return response($e->getMessage(), 500);
        }

        // 请求异常 多为自定义的请求异常
        if ($e instanceof HttpException) {
            return json(['status' => $e->getStatusCode(), 'msg' => $e->getMessage(), 'data' => '']);
        }

        if ($e instanceof BaseException) {
            return json(['status' => $e->getCode(), 'msg' => $e->getMessage(), 'data' => '']);
        }
        // 其他错误交给系统处理
        return parent::render($request, $e);
    }
}
