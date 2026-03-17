<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class MailController extends Controller
{
    public function sendMail(Request $request)
    {
        
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'mobileno' => 'required|string',
            'message' => 'required|string',
        ]);

        $mail = new PHPMailer(true);
       
        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host = env('MAIL_HOST');
            $mail->SMTPAuth = true;
            $mail->Username = env('MAIL_USERNAME');
            $mail->Password = env('MAIL_PASSWORD');
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // or PHPMailer::ENCRYPTION_SMTPS for SSL
            $mail->Port = env('MAIL_PORT');
            
            
            
            // Recipients
            $mail->setFrom(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
            $mail->addAddress(env('MAIL_FROM_ADDRESS')); // The recipient's email
            
            // Content
            $mail->isHTML(true);
            
            $mail->Subject = 'Query from Website';
            $mail->Body = '<strong>Name:</strong> ' . htmlspecialchars($validatedData['name']) . '<br>'
                . '<strong>Email:</strong> ' . htmlspecialchars($validatedData['email']) . '<br>'
                . '<strong>Mobile No:</strong> ' . htmlspecialchars($validatedData['mobileno']) . '<br>'
                . '<strong>Subject:</strong> ' . htmlspecialchars($request->subject) . '<br>'
                . '<strong>Message:</strong> ' . nl2br(htmlspecialchars($validatedData['message']));
                
            $mail->send();
            
            return response()->json(['message' => 'Message sent successfully']);
        } catch (Exception $e) {
            return response()->json(['message' => 'Failed Sending EMail', 'error' => $mail->ErrorInfo], 500);
        }
    }
}
