<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Order;
use Carbon\Carbon;

class ExpireOrders extends Command
{
    protected $signature = 'orders:expire';
    protected $description = 'Expire unpaid orders';

    public function handle()
    {
        $expiredOrders = Order::where('status', 'pending')
            ->where('expires_at', '<', Carbon::now())
            ->get();

        foreach ($expiredOrders as $order) {
            $order->update([
                'status' => 'expired',
            ]);

            if ($order->payment) {
                $order->payment->update([
                    'status' => 'rejected',
                ]);
            }
        }

        $this->info("Expired {$expiredOrders->count()} orders.");
    }
}
