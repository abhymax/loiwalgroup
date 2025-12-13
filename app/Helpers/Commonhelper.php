<?php
namespace App\Helpers;

use Illuminate\Http\Request;
use App\Models\Homebanner;
use App\Models\ContentBlock;
use App\Models\Cms;
use App\Models\Banner;

class Commonhelper
{
    public static function upload_file(Request $request, $field_name, $destination_path, $size=array()){
        $file = $request->file($field_name);
        $time = time();
        $destinationPath = 'uploads/images/'.$destination_path;
        if (!file_exists(public_path().'/'.$destinationPath)) {
            mkdir(public_path().'/'.$destinationPath, 0777);
        }
        $file->move(public_path().'/'.$destinationPath, $time.'_'.$file->getClientOriginalName());
        $filepath = $destinationPath.'/'.$time.'_'.$file->getClientOriginalName();
        return $filepath;
    }
	public static function upload_documents($file, $destination_path, $size=array()){
        $time = time();
        $destinationPath = 'uploads/documents/'.$destination_path;
        if (!file_exists(public_path().'/'.$destinationPath)) {
            mkdir(public_path().'/'.$destinationPath, 0777);
        }
        $file->move(public_path().'/'.$destinationPath, $time.'_'.$file->getClientOriginalName());
        $filepath = $destinationPath.'/'.$time.'_'.$file->getClientOriginalName();
        return $filepath;
    }

    public static function getContent($block_code)
    {
        $blockinfo = ContentBlock::where('block_code',$block_code)->first();
        return $blockinfo->block_content;
    }
    public static function getTitle($block_code)
    {
        $blockinfo = ContentBlock::where('block_code',$block_code)->first();
        return $blockinfo->block_title;
    }

    public static function getPageinfo($cms_id, $field)
    {
        $pageinfo = Cms::findorfail($cms_id);
        return $pageinfo->$field;
            
    }

    public static function getInnerPageBanner($cms_id)
    {
        $banners = Banner::where('banner_active','Y')->where('banner_location',$cms_id)->first();
        return $banners;
    }

    public static function getMenu()
    {
        $menus = Cms::orderby('cms_order','ASC')->get();
        return $menus;
    }
	
	public static function calculate_storage_per_day($go_date,$cur_date,$storage_date,$weight,$storage_end_date,$customs_release){
		$go_sec = strtotime($go_date);
		$cur_sec = strtotime($cur_date);
		$flag = 1;
		if($go_sec<$cur_sec && $customs_release!='Y')
		{
			$flag = 2;
		}
		
		if($weight>2400.00)
		{
			if($flag == 2){
			  //$lb_val = 2*($weight/100);
			  $lb_val = 2*($weight*.025);
			}
			else{
			  //$lb_val = ($weight/100); 
			  $lb_val = ($weight*.025); 
			}
		}
		else
		{
			if($flag == 2)
			  $lb_val = 120;
			else
			  $lb_val = 60;  
		}
		return $lb_val;
		
	}
	
	public static function calculate_storage_due($go_date,$cur_date,$storage_date,$weight,$storage_end_date,$customs_release)
	{
		$go_sec = strtotime($go_date);
		$cur_sec = strtotime($cur_date);
		$flag = 1;
		if($go_sec<$cur_sec && $customs_release!='Y')
		{
			$flag = 2;
		}
		if($storage_date!='' || $weight>'1500.00')
		{
			if($storage_end_date!='' && $storage_end_date!='0000-00-00') 
			{
				$end_sec = strtotime($storage_end_date);
			}
			else
			{
				$end_sec = strtotime($cur_date);
			}
			if($weight>2400.00)
			{
				if($flag == 2){
				  //$lb_val = 2*($weight/100);
				  $lb_val = 2*($weight*.025);
				}
				else{
				  //$lb_val = ($weight/100); 
				  $lb_val = ($weight*.025); 
				}
			}
			else
			{
				if($flag == 2)
				  $lb_val = 120;
				else
				  $lb_val = 60;  
			}
			
			$storage_sec = strtotime($storage_date);
			
			$dd = $end_sec - $storage_sec;
			
			$dd_day = ($dd/86400)+1;
			
			$st_day_name = date('w',$storage_sec);
			//$st_day_name = date('a',$storage_sec);
			
			if($dd_day>0)
			{
				// ------ REMOVED Working day calculation 10/6/2021 ----------------------//

				   // $ww_days = workdays($st_day_name,floor($dd_day));
				$ww_days = floor($dd_day);
				$storage_due = round(floor($ww_days)*$lb_val,2);
						   // ------ REMOVED Working day calculation 10/6/2021 ----------------------//

				
			}
			else
			{
				$storage_due = 0;
			}
			
		}
		else
		{
			$storage_due = 0;
		}
		return $storage_due;
	} 
	
}

?>
