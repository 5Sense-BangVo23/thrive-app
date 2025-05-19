<?php

namespace App\Traits;

use App\Models\Publishable as PublishableModel;

use App\Models\MstPublished;
use App\Enums\PublishStatus;

trait Publishable
{
    public function publishStatus()
    {
        return $this->morphOne(MstPublished::class, 'publishable');
    }

    public function publish(PublishStatus $status = PublishStatus::Published): MstPublished
    {
        return MstPublished::updateOrCreate(
            [
                'publishable_type' => get_class($this),
                'publishable_id' => $this->getKey(),
            ],
            [
                'status' => $status->value,
            ]
        );
    }

    public function unpublish(): bool
    {
        return MstPublished::where('publishable_type', get_class($this))
            ->where('publishable_id', $this->getKey())
            ->delete();
    }

    public function getPublishStatus(): ?string
    {
        return optional($this->publishStatus)->status;
    }

    public function isPublished(): bool
    {
        return $this->getPublishStatus() === PublishStatus::Published->value;
    }
}
