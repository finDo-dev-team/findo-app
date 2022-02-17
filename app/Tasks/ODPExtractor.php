<?php

namespace App\Tasks;

use App\Models\ODPEvent;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class ODPExtractor
{
    private static $queryNext2WeeksEvents = 'https://opendata.paris.fr/api/records/1.0/search/?dataset=que-faire-a-paris-&q=date_start+%3E+%23now()+AND+date_start+%3C%3D+%23now(weeks%3D%2B2)&rows=10000';
    private static $query2022 = 'https://opendata.paris.fr/api/records/1.0/search/?dataset=que-faire-a-paris-&q=date_start%3A[2021-12-31T23%3A00%3A00Z+TO+2022-12-31T22%3A59%3A59Z]&rows=10000';

    public function __invoke()
    {
        Log::info('ODPExtractor started running...');

        $records = array();

        $response = Http::get(self::$query2022);

        $records = $response['records'];

        foreach ($records as $record) {
            $this->createOrUpdateEventFromRecord($record);
        }

        Log::info('ODPExtractor successfully executed!');
    }

    private static function createOrUpdateEventFromRecord(array $record): void
    {
        $fields = $record['fields'];

        $odpEvent = ODPEvent::where('odpID', $fields['id'])->first();

        if($odpEvent == NULL) $odpEvent = new ODPEvent();

        $odpEvent->odpID = $fields['id'] ?? null;
        $odpEvent->url = $fields['url'] ?? null;
        $odpEvent->title = $fields['title'] ?? null;
        $odpEvent->lead_text = $fields['lead_text'] ?? null;
        $odpEvent->description = $fields['description'] ?? null;
        $odpEvent->date_start = $fields['date_start'] ?? null;
        $odpEvent->date_end = $fields['date_end'] ?? null;
        $odpEvent->occurrences = $fields['occurrences'] ?? null;
        $odpEvent->date_description = $fields['date_description'] ?? null;
        $odpEvent->cover_url = $fields['cover_url'] ?? null;
        $odpEvent->cover_alt = $fields['cover_alt'] ?? null;
        $odpEvent->cover_credit = $fields['cover_credit'] ?? null;
        $odpEvent->tags = $fields['tags'] ?? null;
        $odpEvent->address_name = $fields['address_name'] ?? null;
        $odpEvent->address_street = $fields['address_street'] ?? null;
        $odpEvent->address_zipcode = $fields['address_zipcode'] ?? null;
        $odpEvent->address_city = $fields['address_city'] ?? null;
        $odpEvent->latitude = $fields['lat_lon'][0] ?? null;
        $odpEvent->longitude = $fields['lat_lon'][1] ?? null;
        $odpEvent->pmr = $fields['pmr'] ?? null;
        $odpEvent->blind = $fields['blind'] ?? null;
        $odpEvent->deaf = $fields['deaf'] ?? null;
        $odpEvent->transport = $fields['transport'] ?? null;
        $odpEvent->contact_url = $fields['contact_url'] ?? null;
        $odpEvent->contact_phone = $fields['contact_phone'] ?? null;
        $odpEvent->contact_mail = $fields['contact_mail'] ?? null;
        $odpEvent->contact_facebook = $fields['contact_facebook'] ?? null;
        $odpEvent->contact_twitter = $fields['contact_twitter'] ?? null;
        $odpEvent->price_type = $fields['price_type'] ?? null;
        $odpEvent->price_detail = $fields['price_detail'] ?? null;
        $odpEvent->access_type = $fields['access_type'] ?? null;
        $odpEvent->odp_updated_at = $fields['updated_at'] ?? null;
        $odpEvent->programs = $fields['programs'] ?? null;
        $odpEvent->address_url = $fields['address_url'] ?? null;
        $odpEvent->title_event = $fields['title_event'] ?? null;

        $odpEvent->save();
    }

}
