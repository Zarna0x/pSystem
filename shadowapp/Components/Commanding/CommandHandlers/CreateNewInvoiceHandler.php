<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Shadowapp\Components\Commanding\CommandHandlers;

use Shadowapp\Sys\Commanding\Interfaces\CommandInterface;
use Shadowapp\Sys\Commanding\Interfaces\CommandHandlerInterface;

class CreateNewInvoiceHandler implements CommandHandlerInterface
{
    public function handle(CommandInterface $command )
    {
        // handle some data
        
        Event::raise();
        Event::fire();
        Event::fireRaisedEvents();
        Event::fireFromRaised();
        
    }
}
