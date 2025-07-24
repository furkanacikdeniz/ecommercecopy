<?php

namespace App\Http\Controllers\Frontend;


use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;

class CheckoutController extends Controller
{
    /**
     * Shows the payment form
     *
     * @return View
     */
    public function showCheckoutForm(): View
    {
        return view("frontend.card.checkout_form");
    }
}
