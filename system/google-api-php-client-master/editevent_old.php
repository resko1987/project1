<?php

require __DIR__ . '/vendor/autoload.php';
//echo "g: " . __DIR__;
/*

  610380269026-fik8jmj273e2hccjseng17cj7ltpmobv.apps.googleusercontent.com
 * 
 * JaRfJ5Xy_9C4epysp3QAsQue
 *  */
//if (php_sapi_name() != 'cli') {
//    throw new Exception('This application must be run on the command line.');
//}

/**
 * Returns an authorized API client.
 * @return Google_Client the authorized client object
 */
function getClient() {
    $client = new Google_Client();
    $client->setApplicationName('Google Calendar API PHP Quickstart');
    $client->setScopes(Google_Service_Calendar::CALENDAR);
    $client->setAuthConfig(__DIR__ . '/credentials.json');
    $client->setAccessType('offline');
    $client->setPrompt('select_account consent');

    // Load previously authorized token from a file, if it exists.
    // The file token.json stores the user's access and refresh tokens, and is
    // created automatically when the authorization flow completes for the first
    // time.
    // Мой токен, для нового человека нужен новый токен генерировать
    $tokenPath = __DIR__ . '/token2.json';
    if (file_exists($tokenPath)) {
        $accessToken = json_decode(file_get_contents($tokenPath), true);
        $client->setAccessToken($accessToken);
    }

    // If there is no previous token or it's expired.
    if ($client->isAccessTokenExpired()) {
        // Refresh the token if possible, else fetch a new one.
        if ($client->getRefreshToken()) {
            $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
        } else {
            // Request authorization from the user.
            $authUrl = $client->createAuthUrl();
            if (isset($_GET['show'])) {
                printf("Open the following link in your browser:\n%s\n", $authUrl);
                print 'Enter verification code: ';
            }
            $authCode = trim(fgets(STDIN));

            // Exchange authorization code for an access token.
            $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
            $client->setAccessToken($accessToken);

            // Check to see if there was an error.
            if (array_key_exists('error', $accessToken)) {
                throw new Exception(join(', ', $accessToken));
            }
        }
        // Save the token to a file.
        if (!file_exists(dirname($tokenPath))) {
            mkdir(dirname($tokenPath), 0700, true);
        }
        file_put_contents($tokenPath, json_encode($client->getAccessToken()));
    }
    return $client;
}

// Get the API client and construct the service object.
$client = getClient();
$service = new Google_Service_Calendar($client);

// Print the next 10 events on the user's calendar.
$calendarId = 'primary';
$optParams = array(
    'maxResults' => 31,
    'orderBy' => 'startTime',
    'singleEvents' => true,
    'timeMin' => date('c'),
);
/*
 * Отобразить информацию о ближайших событиях
 *  */
$results = $service->events->listEvents($calendarId, $optParams);
$events = $results->getItems();


// 1e48eedioshqloo4ad19almab7


$event_id = '638okoej53t0s0ndoc49m1v5er';
if (isset($_POST['event_id'])) {
    $event_id = $_POST['event_id'];
    $summary = $_POST['summary'];
    $description = $_POST['description'];
    $date_start = $_POST['date_start'];
    $date_time_start = $_POST['date_time_start'];
    $date_end = $_POST['date_end'];
    $date_time_end = $_POST['date_time_end'];
    $attendees_email = $_POST['attendees_email'];
}


//print_r($events);
$event_data = array();
foreach ($events as $event_datas) {
    if ($event_datas->id == $event_id) {
        $event_data = $event_datas;
        //echo $event_data->summary;
    }
}
if (!isset($_POST)) {
    print_r($event_data);
}

$event_data->summary = 'Событие для обновлений 1';
if (isset($_POST['event_id'])) {
    $event_id = $_POST['event_id'];
    $event_data->summary = $_POST['summary'];
    $event_data->description = $_POST['description'];
    /*
    $date_start = $_POST['date_start'];
    $date_time_start = $_POST['date_time_start'];
    $date_end = $_POST['date_end'];
    $date_time_end = $_POST['date_time_end'];
*/
    $event_data->attendees = array(
    array('email' => $attendees_email),
    );
}

// First retrieve the event from the API.
$event = $service->events->get('primary', $event_id);

//$event->setSummary('Событие для обновлений 1');

$updatedEvent = $service->events->update('primary', $event->getId(), $event_data);

// Print the updated date.
if (!isset($_POST)) {
    echo $updatedEvent->getUpdated();
}
$data = $updatedEvent->getUpdated();

/*
Resurse 
 {
  "kind": "calendar#event",
  "etag": etag,
  "id": string,
  "status": string,
  "htmlLink": string,
  "created": datetime,
  "updated": datetime,
  "summary": string,
  "description": string,
  "location": string,
  "colorId": string,
  "creator": {
    "id": string,
    "email": string,
    "displayName": string,
    "self": boolean
  },
  "organizer": {
    "id": string,
    "email": string,
    "displayName": string,
    "self": boolean
  },
  "start": {
    "date": date,
    "dateTime": datetime,
    "timeZone": string
  },
  "end": {
    "date": date,
    "dateTime": datetime,
    "timeZone": string
  },
  "endTimeUnspecified": boolean,
  "recurrence": [
    string
  ],
  "recurringEventId": string,
  "originalStartTime": {
    "date": date,
    "dateTime": datetime,
    "timeZone": string
  },
  "transparency": string,
  "visibility": string,
  "iCalUID": string,
  "sequence": integer,
  "attendees": [
    {
      "id": string,
      "email": string,
      "displayName": string,
      "organizer": boolean,
      "self": boolean,
      "resource": boolean,
      "optional": boolean,
      "responseStatus": string,
      "comment": string,
      "additionalGuests": integer
    }
  ],
  "attendeesOmitted": boolean,
  "extendedProperties": {
    "private": {
      (key): string
    },
    "shared": {
      (key): string
    }
  },
  "hangoutLink": string,
  "conferenceData": {
    "createRequest": {
      "requestId": string,
      "conferenceSolutionKey": {
        "type": string
      },
      "status": {
        "statusCode": string
      }
    },
    "entryPoints": [
      {
        "entryPointType": string,
        "uri": string,
        "label": string,
        "pin": string,
        "accessCode": string,
        "meetingCode": string,
        "passcode": string,
        "password": string
      }
    ],
    "conferenceSolution": {
      "key": {
        "type": string
      },
      "name": string,
      "iconUri": string
    },
    "conferenceId": string,
    "signature": string,
    "notes": string,
  },
  "gadget": {
    "type": string,
    "title": string,
    "link": string,
    "iconLink": string,
    "width": integer,
    "height": integer,
    "display": string,
    "preferences": {
      (key): string
    }
  },
  "anyoneCanAddSelf": boolean,
  "guestsCanInviteOthers": boolean,
  "guestsCanModify": boolean,
  "guestsCanSeeOtherGuests": boolean,
  "privateCopy": boolean,
  "locked": boolean,
  "reminders": {
    "useDefault": boolean,
    "overrides": [
      {
        "method": string,
        "minutes": integer
      }
    ]
  },
  "source": {
    "url": string,
    "title": string
  },
  "attachments": [
    {
      "fileUrl": string,
      "title": string,
      "mimeType": string,
      "iconLink": string,
      "fileId": string
    }
  ]
}
 * 
 */
