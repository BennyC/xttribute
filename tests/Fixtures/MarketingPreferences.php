<?php

namespace Fixtures;

use Xttribute\Xttribute\PathValue;

class MarketingPreferences
{
    public function __construct(
        #[PathValue('//preferences/sms')]
        public readonly bool $sms,
        #[PathValue('//preferences/email')]
        public readonly bool $email,
    ) {}
}
