<?php

namespace Fixtures;

use Xttribute\Xttribute\Castables\CastTo;
use Xttribute\Xttribute\Castables\Str;

class Marketing
{
    public function __construct(
        #[Str('//marketing/id')]
        public readonly string $id,
        #[CastTo('//marketing/preferences', MarketingPreferences::class)]
        public readonly MarketingPreferences $preferences,
    ) {
    }
}
