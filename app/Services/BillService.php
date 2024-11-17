<?php

namespace App\Services;

use App\Models\SmsBill;
use Carbon\Carbon;
use App\Models\User;
use App\Models\SmsNotification;

class BillService
{
    public function generateSmsBillForUser()
    {
        $users = User::all();
        $ratePerSms = 0.20;

        foreach($users as $user) {
            for($year = 2023; $year <= 2024; $year++) {
                for($month = 1; $month <= 12; $month++) {
                    // Check if a bill already exists for the user for this month and year
                    $existingBill = SmsBill::where('user_id', $user->id)
                        ->whereMonth('created_at', $month)
                        ->whereYear('created_at', $year)
                        ->exists();

                    if ($existingBill) {
                        continue; // Skip this iteration if a bill already exists
                    }

                    // Get SMS count for the given user, month, and year
                    $smsCount = SmsNotification::where('user_id', $user->id)
                        ->whereMonth('sent_at', $month)
                        ->whereYear('sent_at', $year)
                        ->count();
                    
                    if($smsCount > 0) {
                        $totalSmsAmount = $smsCount * $ratePerSms;

                         // Calculate the due date (7 days after the end of the month)
                         //  $dueDate = Carbon::create($year, $month)->endOfMonth()->addDays(7);
                         //  $dueDate = Carbon::now()->addMonth();
                         $dueDate = Carbon::create($year, $month)->endOfMonth()->addMonth();
                
                        SmsBill::create([
                            'user_id' => $user->id,
                            'total_sms_amount' => $totalSmsAmount,
                            'status' => 'unpaid',
                            'invoice_number' => 'INV-' . strtoupper(uniqid()),
                            'due_date' => $dueDate,
                        ]);
                    }
                }
            }
        }
    }

    public function generateWhatsappBillForUser()
    {
        
    }
}
