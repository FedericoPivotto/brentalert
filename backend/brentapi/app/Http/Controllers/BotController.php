<?php
/*
 * Copyright (C) 2021 ITIS "E. Fermi", Bassano del Grappa (VI) Italy
 * Please refer to the AUTHORS file for more information.
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 * You should have received a copy of the GNU Affero General Public License
 * along with this program. If not, see <https://www.gnu.org/licenses/>.
 */
 
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BotController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Telegram message function
     */
    protected function telegramMessage($chatID, $message)
    {
        $url = "https://api.telegram.org/bot" . env('BOT_TOKEN') . "/sendMessage?chat_id=" . $chatID;
        $url = $url . "&text=" . urlencode($message) . "&parse_mode=html";
        $ch = curl_init();
        $optArray = array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true
        );
        curl_setopt_array($ch, $optArray);
        $result = curl_exec($ch);
        if(curl_error($ch))
            return json_encode(['ok' => false, 'error' => curl_error($ch), 'error_code' => 400]);
        curl_close($ch);

        return $result;
    }

    /**
     * Create message
     */
    protected function createMessage($name, $idroDate, $idroLevel, $idroMaxLevel)
    {
        $idroData = "Data ultimo rilevamento: " . date("<b>d/m/Y</b>", strtotime($idroDate)) . "\nOra ultimo rilevamento: " . date("<b>H:i</b>", strtotime($idroDate)) . " - <b>Ora solare</b>";
        if($idroLevel <= $idroMaxLevel) {
            $message = "Livello attuale del fiume Brenta: <b>" . $idroLevel . " m</b>\n" . $idroData;
        } else {
            $message = "<b>Allerta, chiamata " . $name . "!</b>\n\nIl livello del fiume Brenta supera quello consentito di " . $idroMaxLevel . " m\n\nLivello attuale: <b>" . $idroLevel . " m</b>\n" . $idroData;
        }

        return $message;
    }

    /**
     * Telegram message status
     */
    protected function telegramMessageStatus($result)
    {
        $decodedResult = json_decode($result);
        if($decodedResult->ok == false) {
            return $decodedResult->error_code;
        } else {
            return 200;
        }
    }

    /**
     * Send message function
     */
    public function sendMessage(Request $request)
    {
        // validate incoming request
        $this->validate($request, [
            'name'         => 'required|string',
            'chatID'       => 'required|string',
            'idroDate'     => 'required|date',
            'idroLevel'    => 'required|numeric',
            'idroMaxLevel' => 'required|numeric',
        ]);
        
        $name         = $request->input('name');
        $chatID       = $request->input('chatID');
        $idroDate     = $request->input('idroDate');
        $idroLevel    = $request->input('idroLevel');
        $idroMaxLevel = $request->input('idroMaxLevel');

        // create message
        $message = $this->createMessage($name, $idroDate, $idroLevel, $idroMaxLevel);

        // get json telegram message
        $result = $this->telegramMessage($chatID, $message);
        $status = $this->telegramMessageStatus($result);

        return response()->json(json_decode($result), $status);
    }
}
