<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Expense;
use App\Models\DailyReport;
use App\Models\Transaction;
use Illuminate\Console\Command;

class GenerateDailyReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-daily-report';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate daily report automatically if not created';


    public function __construct()
    {
        parent::__construct();
    }


    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today = Carbon::today();
        $reportExists = DailyReport::where('date', $today)->exists();

        if ($reportExists) {
            $this->info("Laporan harian untuk tanggal {$today->toDateString()} sudah ada.");
            return;
        }

        // Ambil data total income dan outcome hari ini
        $totalIncome = Transaction::whereDate('created_at', $today)->sum('total_price');; // Hitung berdasarkan transaksi
        $totalOutcome = Expense::whereDate('created_at', $today)->sum('amount');
        $savings = 0; // Default atau berdasarkan aturan user
        $balanceYesterday = DailyReport::where('report_date', $today->copy()->subDay())->value('balance') ?? 0;

        $totalOutcome += $savings;
        $balance = $balanceYesterday - $totalOutcome + $totalIncome;

        // Simpan laporan baru
        DailyReport::create([
            'report_date' => $today,
            'total_income' => $totalIncome,
            'total_outcome' => $totalOutcome,
            'savings' => $savings,
            'balance' => $balance,
            'notes' => 'Generated automatically by the system.',
        ]);

        $this->info("Laporan harian untuk tanggal {$today->toDateString()} berhasil digenerate.");
    }
}
