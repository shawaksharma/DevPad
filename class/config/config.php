<?php
    namespace Config;
/**
 * Generated by framework installer - Tue, 03 Nov 2020 19:51:25 +0100
*/
    class Config
    {
        public const BASEDNAME	= '/devpad';
        public const PUTORPATCH	= 'PATCH';
        public const SESSIONNAME	= 'PSIdevpad';
        public const DBTYPE	= 'mysql';
        public const DBHOST	= 'localhost';
        public const DB	= 'devpad';
        public const DBUSER	= 'test';
        public const DBPW	= 'test';
        public const SITENAME	= 'devpad';
        public const SITENOREPLY	= 'noreply@devpad.com';
        public const SYSADMIN	= 's.sharma@newcastle.ac.uk';
        public const DBRX	= FALSE;
        public const REGISTER	= FALSE;
        public const CONFEMAIL	= FALSE;
        public const UPUBLIC	= FALSE;
        public const UPRIVATE	= TRUE;
        public const RECAPTCHA	= 0;
        public const RECAPTCHAKEY	= 'devpad';
        public const RECAPTCHASECRET	= 'devpad';
        public const USEPHPM	= FALSE;
        public const SMTPHOST	= '';
        public const SMTPPORT	= '';
        public const PROTOCOL	= '';
        public const SMTPUSER	= '';
        public const SMTPPW	= '';

        public static function setup()
        {
            \Framework\Web\Web::getinstance()->addheader([
            'Date'                   => gmstrftime('%b %d %Y %H:%M:%S', time()),
            'Window-Target'          => '_top',      // deframes things
            'X-Frame-Options'	     => 'DENY',      // deframes things: SAMEORIGIN would allow this site to use frames
            'Content-Language'	     => 'en',
            'Vary'                   => 'Accept-Encoding',
            'X-Content-Type-Options' => 'nosniff',
            'X-XSS-Protection'       => '1; mode=block',
            ]);
        }


        public static $defaultCSP = [
                'connect-src' => ["'self'"],
                'default-src' => ["'self'"],
                'font-src' => ["'self'", "data:", "*.fontawesome.com"],
                'img-src' => ["'self'", "data:"],
                'script-src' => ["'self'", "stackpath.bootstrapcdn.com", "cdnjs.cloudflare.com", "code.jquery.com", "*.fontawesome.com"],
                'style-src' => ["'self'", "*.fontawesome.com", "stackpath.bootstrapcdn.com"],
        ];
    }

?>