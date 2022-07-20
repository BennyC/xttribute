<?php

namespace Fixtures;

use Xttribute\Xttribute\Castables\Caster;
use Xttribute\Xttribute\Castables\PathValue;

class Marketing
{
    public function __construct(
        #[PathValue('//marketing/id')]
        public readonly string $id,
        #[Caster('//marketing/preferences', MarketingPreferences::class)]
        public readonly MarketingPreferences $preferences,
    ) {
    }
}
