<?php

namespace App\Tasks;

use App\Models\ODPEvent;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class ODPExtractor
{
    private static $queryNext2WeeksEvents = 'https://opendata.paris.fr/api/records/1.0/search/?dataset=que-faire-a-paris-&q=date_start+%3E+%23now()+AND+date_start+%3C%3D+%23now(weeks%3D%2B2)&rows=1000';

    private array $records;

    public function __invoke()
    {
        Log::info('ODPExtractor started runing...');

        $this->records = array();

        $response = Http::get(ODPExtractor::$queryNext2WeeksEvents);

        $this->records = $response['records'];

        foreach ($this->records as $record) {
            $this->createOrUpdateEventFromRecord($record);
        }

        Log::info('ODPExtractor terminated!');
    }

    private function createOrUpdateEventFromRecord(array $record): void
    {
        $fields = $record['fields'];

        $odpEvent = ODPEvent::where('odpID', $fields['id'])->first();

        if($odpEvent == NULL) $odpEvent = new ODPEvent();

        $odpEvent->odpID = $fields['id'];
        $odpEvent->url = $fields['url'];
        $odpEvent->title = $fields['title'];
        $odpEvent->lead_text = $fields['lead_text'];
        $odpEvent->description = $fields['description'];
        $odpEvent->date_start = $fields['date_start'];
        $odpEvent->date_end = $fields['date_end'];
        $odpEvent->occurrences = $fields['occurrences'];
        $odpEvent->date_description = $fields['date_description'];
        $odpEvent->cover_url = $fields['cover_url'];
        $odpEvent->cover_alt = $fields['cover_alt'];
        $odpEvent->cover_credit = $fields['cover_credit'];
        $odpEvent->tags = $fields['tags'];
        $odpEvent->address_name = $fields['address_name'];
        $odpEvent->address_street = $fields['address_street'];
        $odpEvent->address_zipcode = $fields['address_zipcode'];
        $odpEvent->address_city = $fields['address_city'];
        $odpEvent->latitude = $fields['lat_lon'][0];
        $odpEvent->longitude = $fields['lat_lon'][1];
        $odpEvent->pmr = $fields['pmr'];
        $odpEvent->blind = $fields['blind'];
        $odpEvent->deaf = $fields['deaf'];
        $odpEvent->transport = $fields['transport'];
        $odpEvent->contact_url = $fields['contact_url'];
        $odpEvent->contact_phone = $fields['contact_phone'];
        $odpEvent->contact_mail = $fields['contact_mail'];
        $odpEvent->contact_facebook = $fields['contact_facebook'];
        $odpEvent->contact_twitter = $fields['contact_twitter'];
        $odpEvent->price_type = $fields['price_type'];
        $odpEvent->price_detail = $fields['price_detail'];
        $odpEvent->access_type = $fields['access_type'];
        $odpEvent->odp_updated_at = $fields['updated_at'];
        $odpEvent->programs = $fields['programs'];
        $odpEvent->address_url = $fields['address_url'];
        $odpEvent->title_event = $fields['title_event'];
        $odpEvent->save();
    }

}
