<?php

namespace Fixtures;

use Xttribute\Xttribute\Caster;
use Xttribute\Xttribute\PathValue;

class Marketing
{
    public function __construct(
        #[PathValue('//marketing/id')]
        public readonly string $id,
        #[Caster('//marketing/preferences', MarketingPreferences::class)]
        public readonly MarketingPreferences $preferences,
    ) {}
}
