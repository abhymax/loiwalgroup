<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\Shipment;
use App\Helpers\Commonhelper;

class DemoCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'demo:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';
	
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
     */
    public function handle()
    {
        //
		$cur_date = date("Y-m-d");
		$shipments = Shipment::all();
        foreach ($shipments as $shipment) {
			$storage_per_day = Commonhelper::calculate_storage_per_day($shipment->go_date,$cur_date,$shipment->storage_date,
			$shipment->weight,$shipment->storage_end_date,$shipment->customs_release);
			  
			if($shipment->storage_override == 'Y')
				$storage_due = $shipment->storage_due;
			else
			{
				$storage_due = Commonhelper::calculate_storage_due($shipment->go_date,$cur_date,$shipment->storage_date,
				$shipment->weight,$shipment->storage_end_date,$shipment->customs_release);
			}
			$total =  $shipment->handling_due+$shipment->import_service_fee+$shipment->documentation_fee+$shipment->surcharge+
			$shipment->pallets+$storage_due+$shipment->delivery_charge;
			$grand_total = $total;
			
			$shipmentdtl = Shipment::findOrFail($shipment->shipment_id);
			$inputs['total_charge'] =  $grand_total;
			$inputs['storage_per_day'] = $storage_per_day;
			$inputs['storage_due'] = $storage_due;
			 
			$shipmentdtl->update($inputs);
		}
		
		\Log::info("Cron is working fine!");
    }
}
