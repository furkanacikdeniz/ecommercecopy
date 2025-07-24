<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CardDetails;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Card;
use Illuminate\Support\Str;


class CardController extends Controller
{
    public function index()
{
    $card = $this->getOrCreateCard();

    // ilişkileri eager-load et:
    $card->load('details.product.images'); // varsa images

    return view('frontend.card.index', ['card' => $card]);
}

    private function getOrCreateCard()
    {
        $user= Auth::user();
        $card= Card::firstOrCreate(
            ["user_id"=> $user->user_id],
            ['code' =>Str::random(8)]
        );
        return $card;
    }
    public function add(Product $product,int $quantity = 1)
    {
                $card = $this->getOrCreateCard();
                $details = new CardDetails([
                    'card_id'=>$card->card_id,
                    'product_id' => $product->product_id,
                    'quantity' => $quantity,
                ]);
                $details->save();
                return redirect('/sepetim');

    }

    public function remove(CardDetails $cardDetails){
        $cardDetails->delete();
        return redirect('/sepetim');
    }
}
