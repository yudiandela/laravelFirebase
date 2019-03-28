<?php

namespace App\Http\Controllers;

use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

class FirebaseController extends Controller
{
    public function __invoke()
    {
        $serviceAccount = ServiceAccount::fromJsonFile(__DIR__ . '/FirebaseKey.json');
        $firebase = (new Factory)->withServiceAccount($serviceAccount)->create();
        $database = $firebase->getDatabase();
        $ref = $database->getReference('Subjects');
        $key = $ref->push()->getKey();
        $ref->getChild($key)->set([
            'SubjectName' => Arr::random([
                'Vue', 'Html', 'Css', 'PHP'
            ])
        ]);
        return $key;
    }
}
