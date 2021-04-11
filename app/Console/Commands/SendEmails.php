<?php

namespace App\Console\Commands;

use App\Models\Emails;
use Illuminate\Console\Command;

class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Send:Emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Comando para envíar cola de emails creados';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //Tarea para envío de mails
        $this->info("Ejecutando envío de emails en cola");

        $emails = Emails::where('estado', 1)->orderBy('created_at','asc')->get();
        foreach ($emails as $email)
        {
            $this->info('Enviando Mail');
            try {
                \Mail::raw($email->mensaje, function($message) use ($email)
                {
                    $message->to($email->destinatario)->subject($email->asunto);
                });
                $email->estado = 2;
                $email->save();
                \Log::info("Email enviado correctamente");
            }catch (\Exception $e){
                $email->estado = 3;
                $email->save();
                \Log::info("Error al enviar email". json_encode($e));
            }


        }
        $this->info($emails.': Emails Enviados');

    }
}
