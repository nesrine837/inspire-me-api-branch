<?php

namespace App\Http\Controllers\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Services\v1\QuotesService;

class QuotesController extends Controller
{
    protected $quotes;

    public function __construct(QuotesService $service)
    {
        $this->quotes = $service;
    }

    public function index()
    {
        $parameter = request()->input();
        return $this->quotes->getQuotes();
    }
}
