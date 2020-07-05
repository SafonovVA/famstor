<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $url_data = [
            [
                'title' => 'Safonov',
                'url' => 'famstor.test',
            ],
            [
                'title' => 'Inessa',
                'url' => 'love.you',
            ]
        ];

        return view('start', [
            'url_data' => $url_data
        ]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \string[][]
     */
    public function getJson()
    {
        return [
            [
                'title' => 'Google',
                'url' => 'http://google.ru'
            ],
            [
                'title' => 'Yandex',
                'url' => 'http://ya.ru'
            ]
        ];
    }
}
