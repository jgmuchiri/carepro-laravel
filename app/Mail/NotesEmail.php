<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Notes\Note;

class NotesEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The note instance.
     *
     * @var Order
     */
    protected $note;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Note $note)
    {
        $this->note = $note;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.notesEmail')
                    ->with([
                        'note' => $this->note,
                    ]);
    }
}
