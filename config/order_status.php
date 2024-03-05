<?php

    return [
        'order_status' =>[
            'pending' =>[
                'status' => 'Pending',
                'details' => 'Your order is currently pending'
            ],
            'processing' =>[
                'status' => 'Processing',
                'details' => 'Your order is currently processing'
            ],
            'on hold' =>[
                'status' => 'On Hold',
                'details' => 'Your order is currently on hold'
            ],
            'delivered' =>[
                'status' => 'Delivered',
                'details' => 'Your product is delivered'
            ],
            'completed' =>[
                'status' => 'Completed',
                'details' => 'Your order is completed'
            ],
            'cancelled' =>[
                'status' => 'Cancelled',
                'details' => 'Your order is cancelled'
            ],
            'refunded' =>[
                'status' => 'Refunded',
                'details' => 'Your order is refunded'
            ],
            'failed' =>[
                'status' => 'Failed',
                'details' => 'Your order processing failed'
            ],
            'returned' =>[
                'status' => 'Returned',
                'details' => 'The product is returned'
            ],
        ]
    ];