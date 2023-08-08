<?php

namespace App\Helpers;

class RevisionHelper
{
    public static function getRevision($currentRevision)
    {
        $revisions = [
            'Rev.0' => 'Rev.A',
            'Rev.A' => 'Rev.B',
            'Rev.B' => 'Rev.C',
            'Rev.C' => 'Rev.D',
            'Rev.D' => 'Rev.E',
            'Rev.E' => 'Rev.F',
            'Rev.F' => 'Rev.G',
            'Rev.G' => 'Rev.H',
            'Rev.H' => 'Rev.I',
            'Rev.I' => 'Rev.J',
            'Rev.J' => 'Rev.K',
            'Rev.K' => 'Rev.L',
            'Rev.L' => 'Rev.M',
            'Rev.M' => 'Rev.N',
        ];

        return $revisions[$currentRevision] ?? 'Rev.0';
    }
}
