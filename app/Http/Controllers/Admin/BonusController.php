<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TransactionBonus;
use Illuminate\Http\Request;

class BonusController extends Controller
{
    public function index()
    {
        $pageTitle = 'Transaction Bonuses';
        $bonuses = TransactionBonus::all();
        return view('admin.bonus.index', compact('pageTitle', 'bonuses'));
    }

    public function update(Request $request)
    {

        $request->validate([
            'bonuses' => 'required|array',
            'bonuses.*.id' => 'required|exists:transaction_bonuses,id',
            'bonuses.*.bonus_percentage' => 'required|numeric|min:0|max:100',
            'bonuses.*.bonus_amount' => 'required|numeric',
            'bonuses.*.bonus_type' => 'sometimes|boolean',
            'bonuses.*.is_active' => 'sometimes|boolean'
        ]);

        foreach ($request->bonuses as $bonusData) {
            $bonus = TransactionBonus::find($bonusData['id']);
            $bonus->update([
                'bonus_percentage' => $bonusData['bonus_percentage'],
                'is_active' => $bonusData['is_active'] ?? false,
                'bonus_amount' => $bonusData['bonus_amount'],
                'bonus_type' => $bonusData['bonus_type']
            ]);
        }

        $notify[] = ['success', 'Bonus settings updated successfully'];
        return back()->withNotify($notify);
    }
}
