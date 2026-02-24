<?php
// includes/products_data.php

function getProducts(): array {
    return [
        'NH001' => [
            'name' => 'Moisturizing Shampoo',
            'description' => 'Gentle, sulfate-free shampoo for natural hair',
            'price' => 11.99
        ],
        'NH002' => [
            'name' => 'Hydrating Conditioner',
            'description' => 'Deep moisture conditioner for curls and coils',
            'price' => 12.49
        ],
        'NH003' => [
            'name' => 'Leave-In Conditioner',
            'description' => 'Lightweight leave-in to soften and detangle hair',
            'price' => 10.99
        ],
        'NH004' => [
            'name' => 'Curl Defining Cream',
            'description' => 'Enhances curl definition and reduces frizz',
            'price' => 13.99
        ],
        'NH005' => [
            'name' => 'Natural Hair Growth Oil',
            'description' => 'Nourishes scalp and supports healthy hair growth',
            'price' => 9.99
        ],
    ];
}
