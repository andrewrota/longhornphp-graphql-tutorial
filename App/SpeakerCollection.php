<?php
namespace App;

use App\Data\DataSource;

class SpeakerCollection
{
    private static $ids = [];

    private static $loaded = false;

    private static $data = [];

    public static function add($obj) {
        self::$ids[] = $obj;
    }

    public static function get($confId) {
        if (!self::$loaded) {
            foreach (DataSource::selectSpeakers(self::$ids) as $speaker) {
                self::$data[$speaker->confId][] = $speaker;
            }
            self::$loaded = true;
        }

        return (self::$data[$confId] ?? []);
    }
}
