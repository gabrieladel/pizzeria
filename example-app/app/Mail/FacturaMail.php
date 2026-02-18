<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class FacturaMail extends Mailable
{
    use Queueable, SerializesModels;

    public $pedido;
    public $pdfPath;

    /**
     * El constructor recibe el pedido y la ruta donde se guardó el PDF
     */
    public function __construct($pedido, $pdfPath)
    {
        $this->pedido = $pedido;
        $this->pdfPath = $pdfPath;
    }

    /**
     * Configura el asunto del correo
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Comprobante de Pago - Pedido #' . $this->pedido->id,
        );
    }

    /**
     * Define qué vista se usará como cuerpo del mensaje
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.factura_cliente', // Debes crear esta vista
        );
    }

    /**
     * Adjunta el archivo PDF generado
     */
    public function attachments(): array
    {
        return [
            Attachment::fromPath($this->pdfPath)
                ->as('Factura-' . $this->pedido->id . '.pdf')
                ->withMime('application/pdf'),
        ];
    }
}