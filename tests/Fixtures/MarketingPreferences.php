<?php

namespace Fixtures;

use Xttribute\Xttribute\Castables\Str;

class MarketingPreferences
{
    public function __construct(
        #[Str('//preferences/sms')]
        public readonly bool $sms,
        #[Str('//preferences/email')]
        public readonly bool $email,
    ) {
    }
}
