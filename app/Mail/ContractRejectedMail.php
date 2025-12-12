<?php

namespace App\Mail;

use App\Models\Contrato;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContractRejectedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $contract;
    public $user;

    public function __construct(User $user, Contrato $contract)
    {
        $this->user = $user;
        $this->contract = $contract;
    }

    public function build()
    {
        return $this->subject('Tu contrato ha sido rechazado')
                    ->view('emails.contract_rejected');
    }
}

