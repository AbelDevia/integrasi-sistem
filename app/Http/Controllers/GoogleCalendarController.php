<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Google\Client as GoogleClient;
use Google\Service\Calendar;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleCalendarController extends Controller
{
    public function addToGoogleCalendar($id)
    {
        // Ambil kegiatan berdasarkan ID
        $kegiatan = Kegiatan::findOrFail($id);
    
        // Ambil pengguna yang sedang login
        $user = Auth::user();
    
        // Ambil token dan refresh token dari database
        $token = $user->google_token;
        $refreshToken = $user->google_refresh_token;
    
        // Jika token tidak ada, arahkan ke halaman login Google
        if (!$token) {
            return redirect('/auth/google')->withErrors('Google token not found.');
        }
    
        // Membuat client Google
        $client = new \Google\Client();
    
        // Set token akses
        $client->setAccessToken($token);
    // dd($client);
        // Periksa jika token sudah kedaluwarsa
        if ($client->isAccessTokenExpired()) {
            // dd($client->isAccessTokenExpired());

            // Jika token sudah kadaluarsa, gunakan refresh token untuk mendapatkan token baru
            if ($refreshToken) {
                // dd($refreshToken);
                $client->fetchAccessTokenWithRefreshToken($refreshToken);
                $user->google_token = $client->getAccessToken(); // Simpan token baru ke database
                $user->save();
            } else {
                // Jika refresh token tidak ada, arahkan pengguna untuk login ulang
                return redirect('/kegiatan')->withErrors('Google refresh token not found.');
            }
        }
    
        // Membuat servis Google Calendar
        $service = new \Google\Service\Calendar($client);
    
        // Menyiapkan acara untuk ditambahkan ke Google Calendar
        $event = new \Google\Service\Calendar\Event([
            'summary' => $kegiatan->deskripsi,
            'start' => [
                'dateTime' => $kegiatan->tanggal . 'T09:00:00', // Sesuaikan waktu kegiatan
                'timeZone' => 'Asia/Jakarta',
            ],
            'end' => [
                'dateTime' => $kegiatan->tanggal . 'T10:00:00', // Durasi kegiatan
                'timeZone' => 'Asia/Jakarta',
            ],
        ]);
    
        // ID kalender utama pengguna
        $calendarId = 'primary';
    
        // Menambahkan acara ke Google Calendar
        $googleEvent = $service->events->insert($calendarId, $event);
    
        // Simpan ID acara Google ke database
        $kegiatan->google_event_id = $googleEvent->id;
        $kegiatan->save();
    
        // Redirect dengan pesan sukses
        return redirect()->route('kegiatan.index')->with('success', 'Kegiatan berhasil ditambahkan ke Google Calendar.');
    }
    

    public function listEvents()
    {
        $token = session('google_token');
$kegiatans = Kegiatan::all();
        if (!$token) {
            return redirect('/auth/google')->withErrors('Google token not found.');
        }

        $client = new GoogleClient();
        $client->setAccessToken($token);

        $service = new Calendar($client);
        $calendarId = 'primary'; // Kalender utama pengguna
        $events = $service->events->listEvents($calendarId);

<<<<<<< HEAD
        return view('dashboard.kegiatan.index', ['events' => $events->getItems()]);
=======
        return view('dashboard.kegiatan.index', ['kegiatans'=>$kegiatans,'events' => $events->getItems()]);
>>>>>>> b4e237756caa3f842cb15867a64b477a698f1e70
    }

    public function createEvent(Request $request)
    {
        $token = session('google_token');

        if (!$token) {
            return redirect('/auth/google')->withErrors('Google token not found.');
        }

        $client = new GoogleClient();
        $client->setAccessToken($token);

        $service = new Calendar($client);
        $event = new \Google\Service\Calendar\Event([
            'summary' => $request->input('summary'),
            'start' => [
                'dateTime' => $request->input('start'),
                'timeZone' => 'Asia/Jakarta',
            ],
            'end' => [
                'dateTime' => $request->input('end'),
                'timeZone' => 'Asia/Jakarta',
            ],
        ]);

        $calendarId = 'primary';
        $service->events->insert($calendarId, $event);

        return redirect('/google-calendar')->with('success', 'Event created successfully.');
    }
}
