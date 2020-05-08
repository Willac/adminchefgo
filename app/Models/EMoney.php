<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Auth\User\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class EMoney extends Model
{
    protected $table = 'e_moneys';
    protected $fillable = ['amount', 'user_id', 'active','voucher'];

    public static function getAmount(){
        
        $user =  Auth::user();
        try{
            $amountEmoney = self::where('user_id', $user->id)->first();
            
            return response()->json([
                'success' => true,
                'payload' => $amountEmoney->amount,
            ]);
        }catch(Error $error){
            
            return response()->json([
                'success' => false,
                'payload' => 'No se han encontrado resultados.',
            ]);
        }
        
    }


    public static function updateAmount(Request $request){
        $user =  Auth::user();
        try{
            $amountEmoney = self::where('user_id', $user->id)->first();
            if ($amountEmoney->amount >= $request->price){
                $amountEmoney->amount  = $amountEmoney->amount - $request->price;
                $amountEmoney->save();
                return self::responseJSON( $amountEmoney->amount);
            }else{
                return self::responseJSON('No cuentas con fondos suficientes para realizar esta acción.', false);
            }         
        }catch(Error $error){
            return self::responseJSON("Pago no puede ser procesado.", false);
        }
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    private static function responseJSON($payload=[],$success=true)
    {
        return response()->json([
            'success' => $success,
            'payload' => $payload,
            ]);
    }
}
