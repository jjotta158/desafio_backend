<?php

namespace App\Http\Controllers;

use Mail;
use App\Models\Seller;
use Illuminate\Http\Request;
use App\Http\Controllers\SaleController;

class SellerController extends Controller
{
    public static function addSeller($name, $email) {
        try {
            $seller = new Seller();
            $seller->name = $name;
            $seller->email = $email;
            $seller->save();
            return $seller;
        } catch (Exception $e) {
            return $e;
        }
    }

    public static function editSeller($id, $columnsToChange, $values) {
        try {
            $seller = self::getSellerById($id);
            $updater = array();

            foreach($columnsToChange as $index => $column) {
                if($values[$index]) {
                    $updater[$column] = $values[$index];
                }
            }
        
            $seller->update($updater);
            return $seller;
        } catch (Exception $e) {
            return $e;
        }
    }

    public static function getAllSellers() {
        return Seller::all();
    }

    public static function getSellerById($id) {
        try {
            $seller = Seller::where("id", $id)->first();
            return $seller;
        }catch(Exception $e) {
            return $e;
        }
    }

    public static function deleteSeller($id) {
        try {
            $seller = Seller::where("id", $id);
            $seller->delete();
            return true;
        } catch(Exception $e) {
            return $e;
        }
    }

    public static function sendDailyEmail() {
        try {
            $sellers = self::getAllSellers();

            foreach ($sellers as $index => $seller) {
                $sales = SaleController::getSaleBySellerId($seller->id);
                $totalSale = 0;
                $today = date("m.d.y");
                
                foreach ($sales as $sale) {
                    $saleDate = date("m.d.y", strtotime($sale->created_at));
                    if($today == $saleDate) {
                        $totalSale = $totalSale + $sale->value;
                    }
                }           
                Mail::send('mail.totalSales', ['seller' => $seller, 'totalSale' => $totalSale], function ($m) use($seller) {
                    $m->from('teste@gmail.com', 'Atualização diária de vendas');

                    $m->to($seller->email);
                });
            }
        } catch (Exception $e) {
            return $e;
        }           
    }
}
