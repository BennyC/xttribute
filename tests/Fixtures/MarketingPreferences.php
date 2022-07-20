<?php

namespace Fixtures;

use Xttribute\Xttribute\Castables\PathValue;

class MarketingPreferences
{
    public function __construct(
        #[PathValue('//preferences/sms')]
        public readonly bool $sms,
        #[PathValue('//preferences/email')]
        public readonly bool $email,
    ) {
    }
}
