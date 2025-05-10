<?php

namespace App\Exceptions;

use Exception;

class NotEnoughSlotsException extends Exception
{
    /**
     * Create a new exception instance.
     *
     * @param  string  $message
     * @return void
     */
    public function __construct($message = 'Not enough slots available in this class.')
    {
        parent::__construct($message);
    }
}
