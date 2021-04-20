<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;

class SaleController extends Controller
{
    public static function addSale($id_seller, $value) {
        try {
            $sale = new Sale();
            $sale->id_seller = $id_seller;
            $sale->value = $value;
            $sale->comission = $value * 0.85;
            $sale->save();
            return $sale;
        } catch (Exception $e) {
            return $e;
        }
    }

    public static function editSale($id, $columnToEdit, $newValue) {
        try {
            $sale = Self::getSaleById($id);
            $sale->update([$columnToEdit => $newValue]);
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
}
