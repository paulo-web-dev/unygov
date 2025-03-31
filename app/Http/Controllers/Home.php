<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
class Home extends Controller
{
    public function breve(){
        return view('breve');
    }

    public function home(){

         return redirect('unyflex.com.br');
        return view('home');
    }


    public function embaixador(){
        return view('emabaixador');
    }

    public function emailMensagem(Request $request){
            
        Mail::send('emails.mensagem', [    
            'nome' => $request->nome,
            'email' => $request->email,
            'mensagem' => $request->mensagem,    
        ], function ($message)  {       
            $message->from('unyflex@unyflex.unipublicabrasil.com.br', 'Unyflex');
            $message->sender('unyflex@unyflex.unipublicabrasil.com.br', 'Unyflex');        
            $message->cc('paulosergioorfanelli@gmail.com', 'UNYFLEX')->subject('Mensagem de Texto Unygov');
            $message->cc('amanda.secretaria@unygov.com.br', 'UNYFLEX')->subject('Mensagem de Texto Unygov');
             $message->cc('coordenacao@unygov.com.br', 'UNYFLEX')->subject('Mensagem de Texto Unygov');
          
        });
       echo 'Email Enviado com Sucesso';

    }
}

