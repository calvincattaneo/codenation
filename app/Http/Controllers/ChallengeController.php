<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Challenge;

class ChallengeController extends Controller
{
    /**
     * Retrieve the challenge for the given ID.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        try {
            $challenge = Challenge::findOrFail($id);
            $lc = str_split($challenge->cifrado);
            $i = 0;
            $stringCyphered = "";
            while ($i < 48) {
                $charCode = ord($lc[$i]);
                $finalCode = $charCode - 8;
      
                $isLetter = $charCode >= 97 && $charCode <= 122; // ASCII: a = 97, z = 122
                if (!$isLetter) { // is a symbol or number, not a letter
                    $stringCyphered .= chr($charCode);
                } else if ($finalCode >= 97 && $finalCode <= 122) { // ASCII: a = 97, z = 122
                    $stringCyphered .= chr($finalCode);
                } else if ($finalCode <= 97) { // Go back to z after crossing past letter a
                    $stringCyphered .= chr(122 - (97 - $finalCode) + 1);
                } else if ($finalCode >= 122) { // Go back to a after crossing past letter z
                    $stringCyphered .= chr(97 + ($finalCode - 122) - 1);
                }

                $i++;
            }
            $challenge->decifrado = $stringCyphered;

            return $challenge;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    /**
     * Create a new challenge instance.
     *
     * @param  Request  $request
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'token'    => 'required|min:3|max:100',
        ]);

        $challenge = new Challenge();
        $challenge->token = $request->input('token');
        $challenge->numero_casas = $request->input('numero_casas');
        $challenge->cifrado = $request->input('cifrado');
        $challenge->save();
        return $challenge;
    }
    /**
     * Update the challenge for the given ID.
     *
     * @param  Request  $request
     * @param  int  $id
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'token'    => 'required|min:3|max:100',
        ]);

        $challenge = Challenge::find($id);
        $challenge->token = $request->input('token');
        $challenge->numero_casas = $request->input('numero_casas');
        $challenge->cifrado = $request->input('cifrado');
        $challenge->decifrado = $request->input('decifrado');
        $challenge->resumo_criptografico = $request->input('resumo_criptografico');
    
        $challenge->save();
        
        return $challenge;
    }
    /**
     * Delete the challenge for the given ID.
     *
     * @param  int  $id
     */
    public function delete($id)
    {
        $challenge = Challenge::find($id);
        return response()->json($challenge->delete());
    }
    /**
     * List all available challenges.
     *
     * @return Response
     */
    public function lists()
    {
        return Challenge::all();
    }

    /**
     * Decifre challenge.
     *
     * @return Response
     */
    /*public function decifres($id)
    {
        return Challenge::all();
    }*/
}
