<?php

namespace App\Mail;

use App\Models\Commande;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FactureEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $commande;
    public $pdfContent;

    public function __construct(Commande $commande, $pdfContent)
    {
        $this->commande = $commande;
        $this->pdfContent = $pdfContent;
    }

    public function build()
    {
        return $this->view('emails.facture')
            ->subject('Votre facture pour la commande #' . $this->commande->id)
            ->attachData($this->pdfContent, 'facture.pdf', [
                'mime' => 'application/pdf',
            ]);
    }
}
