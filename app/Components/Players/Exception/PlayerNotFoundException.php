<?php

namespace App\Components\Players\Exception;

use Exception;

class PlayerNotFoundException extends Exception
{
    protected $message = 'Player not found';
}
