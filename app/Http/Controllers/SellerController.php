<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use Illuminate\Http\Request;

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

    public static function editSeller(Request $request) {
        try {
            $seller = getSellerById($id);
            $seller[$request->columnToEdit] = $request->newValue;
            $seller->update();
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
}
