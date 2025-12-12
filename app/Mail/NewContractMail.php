<?php

namespace App\Mail;

use App\Models\Contrato;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewContractMail extends Mailable
{
    use Queueable, SerializesModels;

    public $contract;
    public $trabajador;
    public $cliente;

    public function __construct(Contrato $contract)
    {
        $this->contract = $contract;
        $this->trabajador = $contract->trabajador;
        $this->cliente = $contract->user;
    }

    public function build()
    {
        return $this->subject('Nueva solicitud de contrato')
                    ->view('emails.new_contract')
                    ->with([
                        'contract' => $this->contract,
                        'trabajador' => $this->trabajador,
                        'cliente' => $this->cliente,
                    ]);
    }
}
