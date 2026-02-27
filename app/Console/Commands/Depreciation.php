<?php

namespace iteos\Console\Commands;

use Illuminate\Console\Command;
use iteos\Models\AssetManagements;
use iteos\Models\AssetDepreciation;
use iteos\Models\AccountStatement;
use iteos\Models\JournalEntry;
use iteos\Models\AssetCategory;
use Carbon\Carbon;

class Depreciation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'depreciation:month';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculate asset depreciation per month';

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
     * @return mixed
     */
    public function handle()
    {
        $assets = AssetManagements::where('status_id','81828ad9-fea7-41ff-b6d2-769fbc47c3fa')->get();
        foreach($assets as $asset) {
            $getCurRecord = AssetDepreciation::where('asset_id',$asset->id)->orderBy('updated_at','DESC')->first();
            $getCurItem = AssetManagements::where('id',$asset->id)->first();
            $getCategory = AssetCategory::where('id',$getCurItem->category_name)->first();
            
            if(($asset->method_id) == '1') {
                $yearValue = ($asset->purchase_price - $asset->residual_value)/$asset->estimate_time;
                $monthValue = $yearValue/12;

                if(isset($getCurRecord)) {
                    $depValue = AssetDepreciation::create([
                        'asset_id' => $asset->id,
                        'depreciate_period' => Carbon::now()->toDateTimeString(),
                        'opening_value' => $getCurRecord->closing_value,
                        'depreciate_value' => $monthValue,
                        'accumulate_value' =>$getCurRecord->depreciate_value + $monthValue,
                        'closing_value' => $getCurRecord->closing_value - $monthValue, 
                    ]);
                    $accStatement = AccountStatement::create([
                        'transaction_date' => $depValue->depreciate_period,
                        'status_id' => 'f6e41f5d-0f6e-4eca-a141-b6c7ce34cae6',
                    ]);
                    $journalDb = JournalEntry::create([
                        'account_statement_id' => $accStatement->id,
                        'transaction_date' => Carbon::now()->toDateTimeString(),
                        'item' => $getCurItem->name,
                        'quantity' => '1',
                        'unit_price' => $getCurItem->purchase_price,
                        'account_name' => $getCategory->chart_of_account_id,
                        'trans_type' => 'Debit',
                        'amount' => $monthValue,
                    ]);
                    $journalCr = JournalEntry::create([
                        'account_statement_id' => $accStatement->id,
                        'transaction_date' => Carbon::now()->toDateTimeString(),
                        'item' => $getCurItem->name,
                        'quantity' => '1',
                        'unit_price' => $getCurItem->purchase_price,
                        'account_name' => $getCategory->depreciation_account_id,
                        'trans_type' => 'Credit',
                        'amount' => $monthValue,
                    ]);

                    $bookVal = AssetManagements::where('id',$asset->id)->update([
                        'book_value' => $depValue->closing_value
                    ]);
                    
                    if(($depValue->closing_value) == '0') {
                        $update = AssetManagements::where('id',$asset->id)->update([
                            'status_id' => '99d1e6f4-51be-4fef-a82f-16b86ca9f086',
                        ]);
                    }
                } else {
                    $depValue = AssetDepreciation::create([
                        'asset_id' => $asset->id,
                        'depreciate_period' => Carbon::now()->toDateTimeString(),
                        'opening_value' => $asset->purchase_price - $asset->residual_value,
                        'depreciate_value' => $monthValue,
                        'accumulate_value' =>$monthValue,
                        'closing_value' => ($asset->purchase_price - $asset->residual_value) - $monthValue, 
                    ]);
                    $accStatement = AccountStatement::create([
                        'transaction_date' => $depValue->depreciate_period,
                        'status_id' => 'f6e41f5d-0f6e-4eca-a141-b6c7ce34cae6',
                    ]);
                    $journalDb = JournalEntry::create([
                        'account_statement_id' => $accStatement->id,
                        'transaction_date' => Carbon::now()->toDateTimeString(),
                        'item' => $getCurItem->name,
                        'quantity' => '1',
                        'unit_price' => $getCurItem->purchase_price,
                        'account_name' => $getCategory->chart_of_account_id,
                        'trans_type' => 'Debit',
                        'amount' => $monthValue,
                    ]);
                    $journalCr = JournalEntry::create([
                        'account_statement_id' => $accStatement->id,
                        'transaction_date' => Carbon::now()->toDateTimeString(),
                        'item' => $getCurItem->name,
                        'quantity' => '1',
                        'unit_price' => $getCurItem->purchase_price,
                        'account_name' => $getCategory->depreciation_account_id,
                        'trans_type' => 'Credit',
                        'amount' => $monthValue,
                    ]);

                    $bookVal = AssetManagements::where('id',$asset->id)->update([
                        'book_value' => $depValue->closing_value
                    ]);

                    if(($depValue->closing_value) == '0') {
                        $update = AssetManagements::where('id',$asset->id)->update([
                            'status_id' => '99d1e6f4-51be-4fef-a82f-16b86ca9f086',
                        ]);
                    }
                }   
            } elseif(($asset->method_id) == '3') {
                $yearPercent = 150 / $getCurItem->estimate_time;
                $yearValue = ($asset->purchase_price - $asset->residual_value) * ($yearPercent/100);
                $monthValue = $yearValue/12;

                if(isset($getCurRecord)) {
                    $depValue = AssetDepreciation::create([
                        'asset_id' => $asset->id,
                        'depreciate_period' => Carbon::now()->toDateTimeString(),
                        'opening_value' => $getCurRecord->closing_value,
                        'depreciate_value' => $monthValue,
                        'accumulate_value' =>$getCurRecord->depreciate_value + $monthValue,
                        'closing_value' => $getCurRecord->closing_value - $monthValue, 
                    ]);

                    $accStatement = AccountStatement::create([
                        'transaction_date' => $depValue->depreciate_period,
                        'status_id' => 'f6e41f5d-0f6e-4eca-a141-b6c7ce34cae6',
                    ]);
                    $journalDb = JournalEntry::create([
                        'account_statement_id' => $accStatement->id,
                        'transaction_date' => Carbon::now()->toDateTimeString(),
                        'item' => $getCurItem->name,
                        'quantity' => '1',
                        'unit_price' => $getCurItem->purchase_price,
                        'account_name' => $getCategory->chart_of_account_id,
                        'trans_type' => 'Debit',
                        'amount' => $monthValue,
                    ]);
                    $journalCr = JournalEntry::create([
                        'account_statement_id' => $accStatement->id,
                        'transaction_date' => Carbon::now()->toDateTimeString(),
                        'item' => $getCurItem->name,
                        'quantity' => '1',
                        'unit_price' => $getCurItem->purchase_price,
                        'account_name' => $getCategory->depreciation_account_id,
                        'trans_type' => 'Credit',
                        'amount' => $monthValue,
                    ]);

                    $bookVal = AssetManagements::where('id',$asset->id)->update([
                        'book_value' => $depValue->closing_value
                    ]);

                    if(($depValue->closing_value) == '0') {
                        $update = AssetManagements::where('id',$asset->id)->update([
                            'status_id' => '99d1e6f4-51be-4fef-a82f-16b86ca9f086',
                        ]);
                    }
                } else {
                    $depValue = AssetDepreciation::create([
                        'asset_id' => $asset->id,
                        'depreciate_period' => Carbon::now()->toDateTimeString(),
                        'opening_value' => $asset->purchase_price - $asset->residual_value,
                        'depreciate_value' => $monthValue,
                        'accumulate_value' =>$monthValue,
                        'closing_value' => ($asset->purchase_price - $asset->residual_value) - $monthValue, 
                    ]);
                    $accStatement = AccountStatement::create([
                        'transaction_date' => $depValue->depreciate_period,
                        'status_id' => 'f6e41f5d-0f6e-4eca-a141-b6c7ce34cae6',
                    ]);
                    $journalDb = JournalEntry::create([
                        'account_statement_id' => $accStatement->id,
                        'transaction_date' => Carbon::now()->toDateTimeString(),
                        'item' => $getCurItem->name,
                        'quantity' => '1',
                        'unit_price' => $getCurItem->purchase_price,
                        'account_name' => $getCategory->chart_of_account_id,
                        'trans_type' => 'Debit',
                        'amount' => $monthValue,
                    ]);
                    $journalCr = JournalEntry::create([
                        'account_statement_id' => $accStatement->id,
                        'transaction_date' => Carbon::now()->toDateTimeString(),
                        'item' => $getCurItem->name,
                        'quantity' => '1',
                        'unit_price' => $getCurItem->purchase_price,
                        'account_name' => $getCategory->depreciation_account_id,
                        'trans_type' => 'Credit',
                        'amount' => $monthValue,
                    ]);

                    $bookVal = AssetManagements::where('id',$asset->id)->update([
                        'book_value' => $depValue->closing_value
                    ]);

                    if(($depValue->closing_value) == '0') {
                        $update = AssetManagements::where('id',$asset->id)->update([
                            'status_id' => '99d1e6f4-51be-4fef-a82f-16b86ca9f086',
                        ]);
                    }
                }
            } elseif(($asset->method_id) == '4') {
                $yearPercent = 200 / $getCurItem->estimate_time;
                $yearValue = ($asset->purchase_price - $asset->residual_value) * ($yearPercent/100);
                $monthValue = $yearValue/12;

                if(isset($getCurRecord)) {
                    $depValue = AssetDepreciation::create([
                        'asset_id' => $asset->id,
                        'depreciate_period' => Carbon::now()->toDateTimeString(),
                        'opening_value' => $asset->purchase_price - $asset->residual_value,
                        'depreciate_value' => $monthValue,
                        'accumulate_value' =>$getCurRecord->depreciate_value + $monthValue,
                        'closing_value' => ($asset->purchase_price - $asset->residual_value) - $monthValue, 
                    ]);
                    $accStatement = AccountStatement::create([
                        'transaction_date' => $depValue->depreciate_period,
                        'status_id' => 'f6e41f5d-0f6e-4eca-a141-b6c7ce34cae6',
                    ]);
                    $journalDb = JournalEntry::create([
                        'account_statement_id' => $accStatement->id,
                        'transaction_date' => Carbon::now()->toDateTimeString(),
                        'item' => $getCurItem->name,
                        'quantity' => '1',
                        'unit_price' => $getCurItem->purchase_price,
                        'account_name' => $getCategory->chart_of_account_id,
                        'trans_type' => 'Debit',
                        'amount' => $monthValue,
                    ]);
                    $journalCr = JournalEntry::create([
                        'account_statement_id' => $accStatement->id,
                        'transaction_date' => Carbon::now()->toDateTimeString(),
                        'item' => $getCurItem->name,
                        'quantity' => '1',
                        'unit_price' => $getCurItem->purchase_price,
                        'account_name' => $getCategory->depreciation_account_id,
                        'trans_type' => 'Credit',
                        'amount' => $monthValue,
                    ]);

                    $bookVal = AssetManagements::where('id',$asset->id)->update([
                        'book_value' => $depValue->closing_value
                    ]);

                    if(($depValue->closing_value) == '0') {
                        $update = AssetManagements::where('id',$asset->id)->update([
                            'status_id' => '99d1e6f4-51be-4fef-a82f-16b86ca9f086',
                        ]);
                    }
                } else {
                    $depValue = AssetDepreciation::create([
                        'asset_id' => $asset->id,
                        'depreciate_period' => Carbon::now()->toDateTimeString(),
                        'opening_value' => $asset->purchase_price,
                        'depreciate_value' => $monthValue,
                        'accumulate_value' =>$monthValue,
                        'closing_value' => $asset->purchase_price - $monthValue, 
                    ]);
                    $accStatement = AccountStatement::create([
                        'transaction_date' => $depValue->depreciate_period,
                        'status_id' => 'f6e41f5d-0f6e-4eca-a141-b6c7ce34cae6',
                    ]);
                    $journalDb = JournalEntry::create([
                        'account_statement_id' => $accStatement->id,
                        'transaction_date' => Carbon::now()->toDateTimeString(),
                        'item' => $getCurItem->name,
                        'quantity' => '1',
                        'unit_price' => $getCurItem->purchase_price,
                        'account_name' => $getCategory->chart_of_account_id,
                        'trans_type' => 'Debit',
                        'amount' => $monthValue,
                    ]);
                    $journalCr = JournalEntry::create([
                        'account_statement_id' => $accStatement->id,
                        'transaction_date' => Carbon::now()->toDateTimeString(),
                        'item' => $getCurItem->name,
                        'quantity' => '1',
                        'unit_price' => $getCurItem->purchase_price,
                        'account_name' => $getCategory->depreciation_account_id,
                        'trans_type' => 'Credit',
                        'amount' => $monthValue,
                    ]);

                    $bookVal = AssetManagements::where('id',$asset->id)->update([
                        'book_value' => $depValue->closing_value
                    ]);

                    if(($depValue->closing_value) == '0') {
                        $update = AssetManagements::where('id',$asset->id)->update([
                            'status_id' => '99d1e6f4-51be-4fef-a82f-16b86ca9f086',
                        ]);
                    }
                }
            } elseif(($asset->method_id) == '5') {
                $depValue = AssetDepreciation::create([
                    'asset_id' => $asset->id,
                    'depreciate_period' => Carbon::now()->toDateTimeString(),
                    'opening_value' => $asset->purchase_price,
                    'depreciate_value' => $asset->purchase_price,
                    'accumulate_value' =>$asset->purchase_price,
                    'closing_value' => $asset->purchase_price - $asset->purchase_price, 
                ]);
                $accStatement = AccountStatement::create([
                        'transaction_date' => $depValue->depreciate_period,
                        'status_id' => 'f6e41f5d-0f6e-4eca-a141-b6c7ce34cae6',
                    ]);
                    $journalDb = JournalEntry::create([
                        'account_statement_id' => $accStatement->id,
                        'transaction_date' => Carbon::now()->toDateTimeString(),
                        'item' => $getCurItem->name,
                        'quantity' => '1',
                        'unit_price' => $getCurItem->purchase_price,
                        'account_name' => $getCategory->chart_of_account_id,
                        'trans_type' => 'Debit',
                        'amount' => $getCurRecord->purchase_price,
                    ]);
                    $journalCr = JournalEntry::create([
                        'account_statement_id' => $accStatement->id,
                        'transaction_date' => Carbon::now()->toDateTimeString(),
                        'item' => $getCurItem->name,
                        'quantity' => '1',
                        'unit_price' => $getCurItem->purchase_price,
                        'account_name' => $getCategory->depreciation_account_id,
                        'trans_type' => 'Credit',
                        'amount' => $getCurRecord->purchase_price,
                    ]);

                    $bookVal = AssetManagements::where('id',$asset->id)->update([
                        'book_value' => $depValue->closing_value
                    ]);

                $update = AssetManagements::where('id',$asset->id)->update([
                    'status_id' => '99d1e6f4-51be-4fef-a82f-16b86ca9f086',
                ]);
            }
        }
    }
}
