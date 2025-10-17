<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string|max:2000',
            'contact_reason' => 'required|in:general,support,partnership,custom_project,other'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Salvar mensagem no banco de dados
        Message::create([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
            'contact_reason' => $request->contact_reason
        ]);

        // Aqui você pode implementar o envio do email
        // Mail::to('contato@gejasystems.com')->send(new ContactMail($request->all()));

        return redirect()->back()->with('success', 'Mensagem enviada com sucesso! ✅');
    }
}
