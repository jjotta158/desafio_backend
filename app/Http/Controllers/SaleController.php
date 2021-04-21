<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;

class SaleController extends Controller
{
    public static function addSale($id_seller, $value) {
        try {
            $sale = new Sale();
            $sale->seller_id = $id_seller;
            $sale->value = $value;
            $sale->comission = $value * 0.085;
            $sale->save();
            return $sale;
        } catch (Exception $e) {
            return $e;
        }
    }

    public static function editSale($id, $columnsToChange, $values) {
        try {
            $sale = self::getSaleById($id);
            $updater = array();

            foreach($columnsToChange as $index => $column) {
                if($values[$index]) {
                    $updater[$column] = $values[$index];
                }
            }
        
            $sale->update($updater);
            return $sale;
        } catch (Exception $e) {
            return $e;
        }
    }

    public static function getAllSales() {
        try{
            return Sale::all();
        } catch(Exception $e) {
            return $e;
        }
    }

    public static function getSaleById($id) {
        try {
            $sale = Sale::where("id", $id)->first();
            return $sale;
        }catch(Exception $e) {
            return $e;
        }
    }

    public static function deleteSale($id) {
        try {
            $sale = Sale::where("id", $id);
            $sale->delete();
            return true;
        } catch(Exception $e) {
            return $e;
        }
    }

    public static function getSaleBySellerId($id) {
        try {
            $sale = Sale::where("seller_id", $id)->get();
    
            return $sale;
        } catch(Exception $e) {
            return $e;
        }
    }
}
