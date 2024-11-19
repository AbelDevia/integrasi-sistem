<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Google\Client as GoogleClient;
use Google\Service\Calendar;
use Laravel\Socialite\Facades\Socialite;

class GoogleCalendarController extends Controller
{
    public function addToGoogleCalendar($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
    
        $token = session('google_token');
        if (!$token) {
            return redirect('/auth/google')->withErrors('Google token not found.');
        }
    
        $client = new \Google\Client();
        $client->setAccessToken($token);
    
        $service = new \Google\Service\Calendar($client);
    
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
    
        $calendarId = 'primary';
        $googleEvent = $service->events->insert($calendarId, $event);
    
        // Simpan google_event_id ke database
        $kegiatan->google_event_id = $googleEvent->id;
        $kegiatan->save();
    
        return redirect()->route('kegiatan.index')->with('success', 'Kegiatan berhasil ditambahkan ke Google Calendar.');
    }
    

    public function redirectToGoogle()
    {
        return Socialite::driver('google')
            ->scopes(['https://www.googleapis.com/auth/calendar'])
            ->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();
            
            // Simpan token untuk digunakan nanti
            session(['google_token' => $googleUser->token]);

            return redirect('/google-calendar');
        } catch (\Exception $e) {
            return redirect('/login')->withErrors('Login with Google failed!');
        }
    }

    public function listEvents()
    {
        $token = session('google_token');

        if (!$token) {
            return redirect('/auth/google')->withErrors('Google token not found.');
        }

        $client = new GoogleClient();
        $client->setAccessToken($token);

        $service = new Calendar($client);
        $calendarId = 'primary'; // Kalender utama pengguna
        $events = $service->events->listEvents($calendarId);

        return view('dashboard.kegiatan.index', ['events' => $events->getItems()]);
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
