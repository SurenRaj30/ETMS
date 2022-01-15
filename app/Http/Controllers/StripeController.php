<?php
    
namespace App\Http\Controllers;
    
use Illuminate\Http\Request;
use App\Models\Service;
use Notification;
use App\Models\Booking;
use App\Models\User;
use App\Notifications\PaymentConfirmNotification;
use Session;
use Stripe;
use Auth;
    
class StripeController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripe()
    {
        return view('paymentGate.stripe');
    }
   
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
    {
        $booking=new Booking();
        $user_id = Auth::user()->id;
        $user = User::find($user_id);

        $booking->s_name = $request->s_name;
        $booking->no_tourist = $request->no_tourist;
        $booking->depositPrice = $request->depositPrice;
        $booking->totalPrice = $request->totalPrice;
        $booking->start = $request->start;
        $booking->end = $request->end;
        $booking->tourist_id = $user_id;
        $booking->provider_id = $request->provider_id;
        $booking->title = $request->s_name;
        $booking->status = 1;
         
        $booking->save();
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create ([
                "amount" => 100*($request->depositPrice),
                "currency" => "myr",
                "source" => $request->stripeToken,
                "description" => "Booking for ".($request->s_name)." service"
        ]);
      
        $details = [
            'greeting' => 'Good Day',

            'body' => 'Payment for the '.$booking->s_name.' have been confirmed.',

            'thanks' => 'Thank you for booking our service',

            'actionText' => 'Click here',

            'actionURL' => url('/login'),

            'id' => $user->id
        ];
        Notification::send($user, new PaymentConfirmNotification($details));
        return redirect ('/tourist/list')->with('success', 'Payment successful and waiting for provider approval');
    }
}

