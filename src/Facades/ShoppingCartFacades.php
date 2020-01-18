<?php

namespace NguyenBo\ShoppingCart\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class ShoppingCartFacades
 *
 * @package NguyenBo\ShoppingCart
 */
class ShoppingCartFacade extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'shoppingcart';
    }
}
