<?php

    return [
        'payment_status' =>[
            'pending' =>[
                'status' => 'Pending',
                'details' => 'Your Payment is currently pending'
            ],
            'partial' =>[
                'status' => 'Partial',
                'details' => 'Patially Paid'
            ],
            'approved' =>[
                'status' => 'Approved',
                'details' => 'Your payment is received'
            ],
            'rejected' =>[
                'status' => 'Rejected',
                'details' => 'Your payment is rejected'
            ],
        ]
    ];