<?php

namespace App\Models\Concerns;

use Illuminate\Support\Str;

trait UsesUuidPrimaryKey
{
    public function initializeUsesUuidPrimaryKey(): void
    {
        $this->usesUniqueIds = true;
        $this->incrementing = false;
        $this->keyType = 'string';
    }

    public function newUniqueId(): string
    {
        return (string) Str::uuid();
    }

    public function uniqueIds(): array
    {
        return [$this->getKeyName()];
    }
}
