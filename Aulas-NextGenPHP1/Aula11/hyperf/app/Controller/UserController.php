<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\User;
use Hyperf\Coroutine\WaitGroup;
use Hyperf\HttpServer\Annotation\AutoController;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\GetMapping;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;
use Psr\Http\Message\ResponseInterface as PSRResponseInterface;
use function Hyperf\Coroutine\go;

class UserController
{
    public function index(RequestInterface $request, ResponseInterface $response): PSRResponseInterface
    {
        $wg = new WaitGroup();
        for ($i = 1; $i <= 100; $i++) {
            go(function () use ($i, $wg) {
                $wg->add();
                $user = new User([
                    'name' => "Hyperf-$i",
                    'email' => "hyperf-$i@hyperf.com",
                    'password' => password_hash("hyperf-test", PASSWORD_BCRYPT)
                ]);
                $user->save();
                $wg->done();
            });
        }
        $wg->wait();
        return $response->withStatus(200)
                         ->json(['message' => 'user created successfully']);
    }
}
