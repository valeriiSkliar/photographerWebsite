<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetaTag extends Model
{
    use HasFactory;
    const PREDEFINED_NAMES = [
        'description',
        'keywords',
        'robots',
        'google-site-verification',
        'revisit-after',
        'generator',
        'googlebot',
        'mssmarttagspreventparsing',
        'no-cache',
        'google',
        'googlebot-news',
        'verify-v1',
        'rating',
        'department',
        'audience',
        'doc_status',
        'twitter:title',
        'twitter:site',
        'twitter:image',
        'twitter:image:alt',
        'twitter:description',
        'twitter:card',
        'twitter:url'
    ];
    const PREDEFINED_PROPERTY = [
        'og:title',
        'og:type',
        'og:image',
        'og:image:secure_url',
        'og:image:type',
        'og:image:width',
        'og:image:height',
        'og:url',
        'og:description',
        'og:site_name',
        'og:locale',
        'og:locale:alternate',
        'fb:admins',
        'fb:app_id',
        'fb:page_id',
    ];
}
