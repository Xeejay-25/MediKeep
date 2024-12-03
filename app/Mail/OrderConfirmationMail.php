<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $products;
    public $supplier;
    public $validatedData;

    public function __construct($order, $products, $supplier, $validatedData, $subject)
    {
        $this->order = $order;
        $this->products = $products;
        $this->supplier = $supplier;
        $this->validatedData = $validatedData;
        $this->subject = $subject;
    }

    public function build()
    {
        return $this
            ->subject($this->subject)
            ->view('emails.order_confirmation')
            ->with([
                'order' => $this->order,
                'products' => $this->products,
                'supplier' => $this->supplier,
                'validatedData' => $this->validatedData,
            ]);
    }

}
